<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Product;
use App\Models\Project;
use App\Models\Review;

use DOMDocument;
use DOMElement;
use DOMXPath;
use Illuminate\Support\Str;

class PageBlockRenderer
{
    private const MAX_PARTIAL_DEPTH = 3;

    public function __construct(private readonly LocalizedSlugService $localizedSlugs)
    {
    }

    /**
     * @param  array<int, int>  $visitedPartialIds  Partial page ids already being rendered in this
     *                                               call chain — guards against a shared block that
     *                                               references itself (directly or through another
     *                                               shared block), which would otherwise recurse forever.
     */
    public function render(string $html, string $locale, array $visitedPartialIds = []): string
    {
        if ($html === '' || ! str_contains($html, 'data-page-block=')) {
            return $html;
        }

        $document = new DOMDocument('1.0', 'UTF-8');
        $previous = libxml_use_internal_errors(true);
        $document->loadHTML(
            '<?xml encoding="utf-8" ?><div id="page-block-root">'.$html.'</div>',
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD,
        );
        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        $xpath = new DOMXPath($document);

        foreach (iterator_to_array($xpath->query('//*[@data-page-block="product-grid"]') ?: []) as $node) {
            if ($node instanceof DOMElement) {
                $this->replacePlaceholderOrChildren($document, $node, $this->renderProductGrid($node, $locale));
            }
        }

        foreach (iterator_to_array($xpath->query('//*[@data-page-block="product-tabs"]') ?: []) as $node) {
            if ($node instanceof DOMElement) {
                $this->renderProductTabs($node, $locale);
            }
        }

        foreach (iterator_to_array($xpath->query('//*[@data-page-block="post-list"]') ?: []) as $node) {
            if ($node instanceof DOMElement) {
                $this->replacePlaceholderOrChildren($document, $node, $this->renderPostList($node, $locale));
            }
        }

        foreach (iterator_to_array($xpath->query('//*[@data-page-block="project-grid"]') ?: []) as $node) {
            if ($node instanceof DOMElement) {
                $this->replacePlaceholderOrChildren($document, $node, $this->renderProjectGrid($node, $locale));
            }
        }


        foreach (iterator_to_array($xpath->query('//*[@data-page-block="category-grid"]') ?: []) as $node) {
            if ($node instanceof DOMElement) {
                $this->replacePlaceholderOrChildren($document, $node, $this->renderCategoryGrid($node, $locale));
            }
        }

        foreach (iterator_to_array($xpath->query('//*[@data-page-block="latest-reviews"]') ?: []) as $node) {
            if ($node instanceof DOMElement) {
                $this->replacePlaceholderOrChildren($document, $node, $this->renderLatestReviews($node, $locale));
            }
        }

        foreach (iterator_to_array($xpath->query('//*[@data-page-block="contact-form"]') ?: []) as $node) {
            if ($node instanceof DOMElement) {
                $this->replacePlaceholderOrChildren($document, $node, $this->renderContactForm());
            }
        }

        foreach (iterator_to_array($xpath->query('//*[@data-page-block="partial"]') ?: []) as $node) {
            if ($node instanceof DOMElement) {
                $this->replaceChildren($document, $node, $this->renderPartial($node, $locale, $visitedPartialIds));
            }
        }

        $root = $document->getElementById('page-block-root');
        if (! $root) {
            return $html;
        }

        $output = '';
        foreach ($root->childNodes as $child) {
            $output .= $document->saveHTML($child);
        }

        return $output;
    }

    private function alignment(DOMElement $node, string $fallback): string
    {
        $align = trim($node->getAttribute('data-align'));

        return in_array($align, ['left', 'center', 'right'], true) ? $align : $fallback;
    }

    private function renderPartial(DOMElement $node, string $locale, array $visitedPartialIds): string
    {
        $partialId = (int) $node->getAttribute('data-partial-id');
        if ($partialId <= 0) {
            return '';
        }

        if (in_array($partialId, $visitedPartialIds, true) || count($visitedPartialIds) >= self::MAX_PARTIAL_DEPTH) {
            return $this->emptyState('Khối dùng chung tham chiếu vòng lặp, đã bỏ qua.');
        }

        $partial = Page::query()->partials()->where('is_active', true)->find($partialId);
        if (! $partial) {
            return '';
        }

        $html = (string) $partial->getTranslation('published_html', $locale, false);

        return '<style data-partial-css="'.$partialId.'">'.$partial->getTranslation('published_css', $locale, false).'</style>'
            .$this->render($html, $locale, [...$visitedPartialIds, $partialId]);
    }

    private function renderProductGrid(DOMElement $node, string $locale): string
    {
        $categorySlug = trim($node->getAttribute('data-category'));
        $limit = max(1, min(24, (int) ($node->getAttribute('data-limit') ?: 8)));
        $queryType = trim($node->getAttribute('data-query')) ?: 'latest';

        // Custom layout attributes
        $columns = max(1, min(10, (int) ($node->getAttribute('data-columns') ?: 4)));
        $gap = max(0, min(100, (int) ($node->getAttribute('data-gap') ?: 24)));
        $align = $this->alignment($node, 'left');

        $textAlign = $align;
        $justifyContent = ($align === 'left') ? 'flex-start' : (($align === 'right') ? 'flex-end' : 'center');
        $priceWrapperStyle = ($align === 'left')
            ? 'display:flex; justify-content:space-between; align-items:center; margin-top:8px;'
            : 'display:flex; justify-content:'.$justifyContent.'; align-items:center; gap:12px; margin-top:8px;';

        $query = Product::query()->where('is_active', true);

        if ($categorySlug !== '') {
            $category = $this->localizedSlugs->find(Category::class, $categorySlug, $locale);
            if (! $category) {
                return $this->emptyState('Không tìm thấy danh mục sản phẩm.');
            }
            $query->where('category_id', $category->id);
        }

        if ($queryType === 'featured') {
            $query->where('is_featured', true);
        }

        $products = $query->latest('id')->limit($limit)->get();
        if ($products->isEmpty()) {
            return $this->emptyState($queryType === 'featured'
                ? 'Chưa có sản phẩm nổi bật để hiển thị.'
                : 'Chưa có sản phẩm để hiển thị.');
        }

        $cards = $products->map(function (Product $product) use ($locale, $textAlign, $priceWrapperStyle) {
            $name = e($product->getTranslation('name', $locale, false));
            $image = e($product->image_url ?: 'https://placehold.co/400x300');
            $price = number_format((float) $product->price, 0, ',', '.').'đ';
            $categoryName = $product->category ? e($product->category->getTranslation('name', $locale, false)) : 'Sản phẩm';

            return '<div class="premium-product-card" style="background:#ffffff; border:1px solid #e2e8f0; border-radius:16px; overflow:hidden; transition:all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow:0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -1px rgba(0,0,0,0.01); display:flex; flex-direction:column; justify-content:space-between; height:100%; text-align:'.$textAlign.';">'
                .'<div style="position:relative; overflow:hidden; padding-bottom:85%; background:#f8fafc;">'
                .'<img src="'.$image.'" alt="'.$name.'" style="position:absolute; top:0; left:0; width:100%; height:100%; object-fit:cover; transition:transform 0.5s ease;" class="product-card-img">'
                .'<span style="position:absolute; top:12px; left:12px; background:rgba(255,255,255,0.9); backdrop-filter:blur(4px); color:#475569; font-size:11px; font-weight:700; padding:4px 10px; border-radius:9999px; font-family:\'Quicksand\',sans-serif; text-transform:uppercase; letter-spacing:0.5px; box-shadow:0 2px 4px rgba(0,0,0,0.02)">'.$categoryName.'</span>'
                .'<span style="position:absolute; bottom:8px; right:8px; background:rgba(15,23,42,0.6); backdrop-filter:blur(4px); color:#ffffff; font-size:10px; font-weight:700; padding:2px 6px; border-radius:4px; font-family:\'Quicksand\',sans-serif; z-index:3;">Tỷ lệ: 3:4 / 4:5</span>'
                .'</div>'
                .'<div style="padding:16px; flex-grow:1; display:flex; flex-direction:column; justify-content:space-between; font-family:\'Quicksand\',sans-serif;">'
                .'<div>'
                .'<h4 style="font-size:15px; font-weight:700; color:#0f172a; margin:0 0 8px 0; line-height:1.4; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; height:42px; text-align:'.$textAlign.';">'.$name.'</h4>'
                .'</div>'
                .'<div style="'.$priceWrapperStyle.'">'
                .'<span style="font-size:16px; font-weight:800; color:#5d87ff;">'.$price.'</span>'
                .'<button style="border:none; background:#ecf2ff; color:#5d87ff; width:36px; height:36px; border-radius:10px; display:flex; align-items:center; justify-content:center; cursor:pointer; transition:all 0.2s ease;" class="product-card-btn" title="Thêm vào giỏ">'
                .'<iconify-icon icon="solar:cart-large-2-linear" style="font-size:18px"></iconify-icon>'
                .'</button>'
                .'</div>'
                .'</div>'
                .'</div>';
        })->implode('');

        $gridId = 'grid-' . Str::random(8);
        $style = '<style>'
            .'#'.$gridId.' { display:grid; grid-template-columns:repeat(auto-fill, minmax(220px, 1fr)); gap:'.$gap.'px; padding:8px 0; }'
            .'@media (min-width: 768px) { #'.$gridId.' { grid-template-columns:repeat('.$columns.', 1fr); } }'
            .'.premium-product-card:hover { transform: translateY(-6px); box-shadow: 0 20px 25px -5px rgba(0,0,0,0.06), 0 10px 10px -5px rgba(0,0,0,0.03) !important; border-color: #d1d5db !important; }'
            .'.premium-product-card:hover .product-card-img { transform: scale(1.06) !important; }'
            .'.product-card-btn:hover { background: #5d87ff !important; color: #ffffff !important; }'
            .'</style>';

        $grid = '<div id="'.$gridId.'">'.$cards.'</div>';

        return $style . $grid;
    }

    private function renderProductTabs(DOMElement $node, string $locale): void
    {
        $limit = max(1, min(48, (int) ($node->getAttribute('data-limit') ?: 16)));

        // Custom layout attributes
        $columns = max(1, min(10, (int) ($node->getAttribute('data-columns') ?: 4)));
        $gap = max(0, min(100, (int) ($node->getAttribute('data-gap') ?: 24)));
        $align = $this->alignment($node, 'left');

        $textAlign = $align;
        $justifyContent = ($align === 'left') ? 'flex-start' : (($align === 'right') ? 'flex-end' : 'center');
        $priceWrapperStyle = ($align === 'left')
            ? 'display:flex; justify-content:space-between; align-items:center; margin-top:8px;'
            : 'display:flex; justify-content:'.$justifyContent.'; align-items:center; gap:12px; margin-top:8px;';

        // Query active categories that have products
        $categories = Category::query()->where('is_active', true)->whereHas('products')->get();

        // Query products
        $products = Product::query()->where('is_active', true)->with('category')->latest('id')->limit($limit)->get();
        if ($products->isEmpty()) {
            return;
        }

        // Generate product cards HTML
        $cards = $products->map(function (Product $product) use ($locale, $textAlign, $priceWrapperStyle) {
            $name = e($product->getTranslation('name', $locale, false));
            $image = e($product->image_url ?: 'https://placehold.co/400x300');
            $price = number_format((float) $product->price, 0, ',', '.').'đ';
            $categoryName = $product->category ? e($product->category->getTranslation('name', $locale, false)) : 'Sản phẩm';
            $categorySlug = $product->category ? $product->category->slug : 'all';

            return '<div class="premium-product-card" data-cat="'.$categorySlug.'" style="background:#ffffff; border:1px solid #e2e8f0; border-radius:16px; overflow:hidden; transition:all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow:0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -1px rgba(0,0,0,0.01); display:flex; flex-direction:column; justify-content:space-between; height:100%; text-align:'.$textAlign.';">'
                .'<div style="position:relative; overflow:hidden; padding-bottom:85%; background:#f8fafc;">'
                .'<img src="'.$image.'" alt="'.$name.'" style="position:absolute; top:0; left:0; width:100%; height:100%; object-fit:cover; transition:transform 0.5s ease;" class="product-card-img">'
                .'<span style="position:absolute; top:12px; left:12px; background:rgba(255,255,255,0.9); backdrop-filter:blur(4px); color:#475569; font-size:11px; font-weight:700; padding:4px 10px; border-radius:9999px; font-family:\'Quicksand\',sans-serif; text-transform:uppercase; letter-spacing:0.5px; box-shadow:0 2px 4px rgba(0,0,0,0.02)">'.$categoryName.'</span>'
                .'<span style="position:absolute; bottom:8px; right:8px; background:rgba(15,23,42,0.6); backdrop-filter:blur(4px); color:#ffffff; font-size:10px; font-weight:700; padding:2px 6px; border-radius:4px; font-family:\'Quicksand\',sans-serif; z-index:3;">Tỷ lệ: 3:4 / 4:5</span>'
                .'</div>'
                .'<div style="padding:16px; flex-grow:1; display:flex; flex-direction:column; justify-content:space-between; font-family:\'Quicksand\',sans-serif;">'
                .'<div>'
                .'<h4 style="font-size:15px; font-weight:700; color:#0f172a; margin:0 0 8px 0; line-height:1.4; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; height:42px; text-align:'.$textAlign.';">'.$name.'</h4>'
                .'</div>'
                .'<div style="'.$priceWrapperStyle.'">'
                .'<span style="font-size:16px; font-weight:800; color:#5d87ff;">'.$price.'</span>'
                .'<button style="border:none; background:#ecf2ff; color:#5d87ff; width:36px; height:36px; border-radius:10px; display:flex; align-items:center; justify-content:center; cursor:pointer; transition:all 0.2s ease;" class="product-card-btn" title="Thêm vào giỏ">'
                .'<iconify-icon icon="solar:cart-large-2-linear" style="font-size:18px"></iconify-icon>'
                .'</button>'
                .'</div>'
                .'</div>'
                .'</div>';
        })->implode('');

        $gridId = 'grid-' . Str::random(8);
        $style = '<style>'
            .'#'.$gridId.' { display:grid; grid-template-columns:repeat(auto-fill, minmax(220px, 1fr)); gap:'.$gap.'px; padding:8px 0; }'
            .'@media (min-width: 768px) { #'.$gridId.' { grid-template-columns:repeat('.$columns.', 1fr); } }'
            .'.premium-product-card:hover { transform: translateY(-6px); box-shadow: 0 20px 25px -5px rgba(0,0,0,0.06), 0 10px 10px -5px rgba(0,0,0,0.03) !important; border-color: #d1d5db !important; }'
            .'.premium-product-card:hover .product-card-img { transform: scale(1.06) !important; }'
            .'.product-card-btn:hover { background: #5d87ff !important; color: #ffffff !important; }'
            .'</style>';

        $xpath = new DOMXPath($node->ownerDocument);
        $tabBars = $xpath->query('.//*[contains(@class, "product-tabs-bar")]', $node);
        $placeholders = $xpath->query('.//*[contains(@class, "-placeholder")]', $node);

        if ($tabBars && $tabBars->length > 0 && $placeholders && $placeholders->length > 0) {
            $tabBar = $tabBars->item(0);
            if ($tabBar instanceof DOMElement) {
                while ($tabBar->hasChildNodes()) {
                    $tabBar->removeChild($tabBar->firstChild);
                }
                $allBtn = $node->ownerDocument->createElement('button', 'Tất cả');
                $allBtn->setAttribute('class', 'tab-btn active');
                $allBtn->setAttribute('data-tab', 'all');
                $tabBar->appendChild($allBtn);
                foreach ($categories as $cat) {
                    $catName = $cat->getTranslation('name', $locale, false);
                    $catBtn = $node->ownerDocument->createElement('button', e($catName));
                    $catBtn->setAttribute('class', 'tab-btn');
                    $catBtn->setAttribute('data-tab', $cat->slug);
                    $tabBar->appendChild($catBtn);
                }
            }
            $gridTarget = $placeholders->item(0);
            if ($gridTarget instanceof DOMElement) {
                $this->replaceNodeWithHtml($node->ownerDocument, $gridTarget, $style . $cards);
                $gridTarget->setAttribute('id', $gridId);
            }
        } else {
            $tabBtns = '<button class="tab-btn active" data-tab="all" style="padding:8px 18px;border-radius:9999px;border:none;background:#5d87ff;color:#ffffff;font-weight:700;cursor:pointer;font-family:\'Quicksand\',sans-serif;font-size:14px;transition:all 0.2s;">Tất cả</button>';
            foreach ($categories as $cat) {
                $catName = $cat->getTranslation('name', $locale, false);
                $tabBtns .= '<button class="tab-btn" data-tab="'.$cat->slug.'" style="padding:8px 18px;border-radius:9999px;border:1px solid #e2e8f0;background:#ffffff;color:#475569;font-weight:700;cursor:pointer;font-family:\'Quicksand\',sans-serif;font-size:14px;transition:all 0.2s;">'.e($catName).'</button>';
            }
            $tabBarHtml = '<div class="product-tabs-bar" style="display:flex;gap:10px;margin-bottom:24px;overflow-x:auto;padding-bottom:6px;">'.$tabBtns.'</div>';
            $fullHtml = $tabBarHtml . $style . '<div id="'.$gridId.'">'.$cards.'</div>';
            $this->replaceChildren($node->ownerDocument, $node, $fullHtml);
        }
    }

    private function renderPostList(DOMElement $node, string $locale): string
    {
        $limit = max(1, min(12, (int) ($node->getAttribute('data-limit') ?: 3)));
        $categorySlug = trim($node->getAttribute('data-category'));

        // Custom layout attributes
        $columns = max(1, min(6, (int) ($node->getAttribute('data-columns') ?: 3)));
        $gap = max(0, min(100, (int) ($node->getAttribute('data-gap') ?: 24)));
        $align = $this->alignment($node, 'left');

        $textAlign = $align;

        $query = Post::query()
            ->where('is_active', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());

        if ($categorySlug !== '') {
            $category = $this->localizedSlugs->find(PostCategory::class, $categorySlug, $locale);
            if (! $category) {
                return $this->emptyState('Không tìm thấy danh mục bài viết.');
            }
            $query->where('category_id', $category->id);
        }

        $posts = $query->latest('published_at')->limit($limit)->get();
        if ($posts->isEmpty()) {
            return $this->emptyState('Chưa có bài viết để hiển thị.');
        }

        $cards = $posts->map(function (Post $post) use ($locale, $textAlign) {
            $title = e($post->getTranslation('title', $locale, false));
            $summary = e(Str::limit(trim(strip_tags((string) $post->getTranslation('summary', $locale, false))), 120));
            $image = e($post->image_url ?: 'https://placehold.co/400x300');
            $date = $post->published_at ? $post->published_at->format('d/m/Y') : '';

            return '<a href="#" class="premium-post-card" style="display:block; text-decoration:none; color:inherit; background:#ffffff; border:1px solid #e2e8f0; border-radius:16px; overflow:hidden; transition:all 0.3s ease; box-shadow:0 4px 6px -1px rgba(0,0,0,0.02); height:100%; text-align:'.$textAlign.';">'
                .'<div style="position:relative; overflow:hidden; padding-bottom:60%; background:#f8fafc;">'
                .'<img src="'.$image.'" alt="'.$title.'" style="position:absolute; top:0; left:0; width:100%; height:100%; object-fit:cover; transition:transform 0.4s ease;" class="post-card-img">'
                .'<span style="position:absolute; bottom:8px; right:8px; background:rgba(15,23,42,0.6); backdrop-filter:blur(4px); color:#ffffff; font-size:10px; font-weight:700; padding:2px 6px; border-radius:4px; font-family:\'Quicksand\',sans-serif; z-index:3;">Tỷ lệ: 16:9 / 3:2</span>'
                .'</div>'
                .'<div style="padding:16px; font-family:\'Quicksand\',sans-serif;">'
                .($date !== '' ? '<div style="font-size:12px; color:#64748b; margin-bottom:8px; font-weight:600;">'.$date.'</div>' : '')
                .'<h4 style="font-size:16px; font-weight:700; color:#0f172a; margin:0 0 8px 0; line-height:1.4; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; height:44px; text-align:'.$textAlign.';">'.$title.'</h4>'
                .'<p style="color:#64748b; font-size:13px; margin:0; line-height:1.6; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; text-align:'.$textAlign.';">'.$summary.'</p>'
                .'</div></a>';
        })->implode('');

        $gridId = 'grid-' . Str::random(8);
        $style = '<style>'
            .'#'.$gridId.' { display:grid; grid-template-columns:repeat(auto-fill, minmax(280px, 1fr)); gap:'.$gap.'px; padding:8px 0; }'
            .'@media (min-width: 768px) { #'.$gridId.' { grid-template-columns:repeat('.$columns.', 1fr); } }'
            .'.premium-post-card:hover { transform: translateY(-6px); box-shadow: 0 20px 25px -5px rgba(0,0,0,0.06) !important; border-color: #d1d5db !important; }'
            .'.premium-post-card:hover .post-card-img { transform: scale(1.06) !important; }'
            .'</style>';

        $grid = '<div id="'.$gridId.'">'.$cards.'</div>';

        return $style . $grid;
    }

    private function renderProjectGrid(DOMElement $node, string $locale): string
    {
        $limit = max(1, min(24, (int) ($node->getAttribute('data-limit') ?: 6)));
        $category = trim($node->getAttribute('data-category'));

        $columns = max(1, min(6, (int) ($node->getAttribute('data-columns') ?: 3)));
        $gap = max(0, min(100, (int) ($node->getAttribute('data-gap') ?: 24)));
        $align = $this->alignment($node, 'left');

        $query = Project::query()->where('is_active', true);
        if ($category !== '') {
            $query->where('category', $category);
        }

        $projects = $query->orderBy('sort_order')->latest('id')->limit($limit)->get();
        if ($projects->isEmpty()) {
            return $this->emptyState('Chưa có dự án nào để hiển thị.');
        }

        $gridId = 'project-grid-'.Str::random(8);

        $style = '<style>'
            .'#'.$gridId.' { display: grid; grid-template-columns: repeat('.$columns.', minmax(0, 1fr)); gap: '.$gap.'px; padding: 8px 0; }'
            .'@media(max-width: 1024px) { #'.$gridId.' { grid-template-columns: repeat('.min(2, $columns).', minmax(0, 1fr)); } }'
            .'@media(max-width: 640px) { #'.$gridId.' { grid-template-columns: 1fr; } }'
            .'.premium-project-card:hover { transform: translateY(-5px); box-shadow: 0 16px 24px -4px rgba(0,0,0,0.08) !important; border-color: #cbd5e1 !important; }'
            .'.premium-project-card:hover .project-card-img { transform: scale(1.06) !important; }'
            .'</style>';

        $cards = $projects->map(function (Project $project) use ($locale, $align) {
            $title = e($project->getTranslation('title', $locale, false) ?: $project->getTranslation('title', 'en', false));
            $location = e($project->getTranslation('location', $locale, false) ?: $project->getTranslation('location', 'en', false));
            $image = e($project->image_url ?: '/wp-content/uploads/2021/12/Costance-Lemuria-Praslin_599x599.jpg');
            $url = url('/projects/' . ($project->slug ?: $project->id));
            $categoryLabel = e($project->categoryLabel($locale));

            return '<a href="'.$url.'" class="premium-project-card" style="display:flex; flex-direction:column; text-decoration:none; color:inherit; background:#ffffff; border:1px solid #e2e8f0; border-radius:12px; overflow:hidden; transition:all 0.3s ease; box-shadow:0 4px 6px -1px rgba(0,0,0,0.02); height:100%; text-align:'.$align.';">'
                .'<div style="position:relative; overflow:hidden; padding-bottom:65%; background:#f8fafc;">'
                .'<img src="'.$image.'" alt="'.$title.'" style="position:absolute; top:0; left:0; width:100%; height:100%; object-fit:cover; transition:transform 0.5s ease;" class="project-card-img" loading="lazy">'
                .'<span style="position:absolute; top:12px; left:12px; background:rgba(15,23,42,0.75); backdrop-filter:blur(4px); color:#ffffff; font-size:11px; font-weight:700; padding:4px 10px; border-radius:9999px; text-transform:uppercase; letter-spacing:0.5px;">'.$categoryLabel.'</span>'
                .'</div>'
                .'<div style="padding:18px; flex-grow:1; display:flex; flex-direction:column; justify-content:space-between;">'
                .'<div>'
                .'<h4 style="font-size:16px; font-weight:700; color:#0f172a; margin:0 0 6px 0; line-height:1.35; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">'.$title.'</h4>'
                .($location !== '' ? '<div style="font-size:13px; color:#64748b; font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">'.$location.'</div>' : '')
                .'</div>'
                .'<div style="margin-top:14px; font-size:13px; font-weight:700; color:#172033; display:inline-flex; align-items:center; gap:4px;">'
                .'<span>Xem dự án</span> <i class="ti ti-arrow-right"></i>'
                .'</div>'
                .'</div>'
                .'</a>';
        })->implode('');

        return $style . '<div id="'.$gridId.'">'.$cards.'</div>';
    }

    private function renderCategoryGrid(DOMElement $node, string $locale): string

    {
        $limit = max(1, min(24, (int) ($node->getAttribute('data-limit') ?: 8)));

        // Custom layout attributes
        $columns = max(1, min(12, (int) ($node->getAttribute('data-columns') ?: 4)));
        $gap = max(0, min(100, (int) ($node->getAttribute('data-gap') ?: 24)));
        $align = $this->alignment($node, 'center');

        $textAlign = $align;

        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->limit($limit)
            ->get();

        if ($categories->isEmpty()) {
            return $this->emptyState('Chưa có danh mục để hiển thị.');
        }

        $cards = $categories->map(function (Category $category) use ($locale, $textAlign) {
            $name = e($category->getTranslation('name', $locale, false));
            $image = e($category->image_url ?: 'https://placehold.co/400x300');

            return '<a href="#" class="premium-category-card" style="display:block; text-align:'.$textAlign.'; text-decoration:none; color:inherit; transition:all 0.3s ease; height:100%;">'
                .'<div style="overflow:hidden; border-radius:16px; margin-bottom:12px; background:#f8fafc; border:1px solid #e2e8f0; position:relative; padding-bottom:80%;">'
                .'<img src="'.$image.'" alt="'.$name.'" style="position:absolute; top:0; left:0; width:100%; height:100%; object-fit:cover; transition:transform 0.4s ease;" class="category-card-img">'
                .'<span style="position:absolute; bottom:8px; right:8px; background:rgba(15,23,42,0.6); backdrop-filter:blur(4px); color:#ffffff; font-size:10px; font-weight:700; padding:2px 6px; border-radius:4px; font-family:\'Quicksand\',sans-serif; z-index:3;">Tỷ lệ: 1:1 / 4:3</span>'
                .'</div>'
                .'<div style="font-weight:700; color:#1e293b; font-family:\'Quicksand\',sans-serif; font-size:15px; text-align:'.$textAlign.';">'.$name.'</div>'
                .'</a>';
        })->implode('');

        $gridId = 'grid-' . Str::random(8);
        $style = '<style>'
            .'#'.$gridId.' { display:grid; grid-template-columns:repeat(auto-fill, minmax(140px, 1fr)); gap:'.$gap.'px; padding:8px 0; }'
            .'@media (min-width: 768px) { #'.$gridId.' { grid-template-columns:repeat('.$columns.', 1fr); } }'
            .'.premium-category-card:hover .category-card-img { transform: scale(1.08) !important; }'
            .'.premium-category-card:hover div { color: #5d87ff !important; }'
            .'</style>';

        $grid = '<div id="'.$gridId.'">'.$cards.'</div>';

        return $style . $grid;
    }

    private function renderLatestReviews(DOMElement $node, string $locale): string
    {
        $limit = max(1, min(12, (int) ($node->getAttribute('data-limit') ?: 4)));

        // Custom layout attributes
        $columns = max(1, min(6, (int) ($node->getAttribute('data-columns') ?: 4)));
        $gap = max(0, min(100, (int) ($node->getAttribute('data-gap') ?: 24)));

        $reviews = Review::query()
            ->where('is_visible', true)
            ->with('product')
            ->latest('id')
            ->limit($limit)
            ->get();

        if ($reviews->isEmpty()) {
            return $this->emptyState('Chưa có đánh giá để hiển thị.');
        }

        $cards = $reviews->map(function (Review $review) use ($locale) {
            $stars = str_repeat('★', max(0, min(5, (int) $review->rating))).str_repeat('☆', 5 - max(0, min(5, (int) $review->rating)));
            $comment = e(Str::limit(trim((string) $review->comment), 160));
            $name = e($review->customer_name ?: 'Khách hàng');
            $productName = $review->product ? e($review->product->getTranslation('name', $locale, false)) : '';

            return '<div style="padding:20px; border:1px solid #e2e8f0; border-radius:16px; background:#ffffff; box-shadow:0 4px 6px -1px rgba(0,0,0,0.02); font-family:\'Quicksand\',sans-serif; height:100%; display:flex; flex-direction:column; justify-content:space-between;">'
                .'<div>'
                .'<div style="color:#f59f00; letter-spacing:2px; font-size:16px; margin-bottom:12px;">'.$stars.'</div>'
                .'<p style="margin:0 0 16px 0; color:#334155; font-size:14px; line-height:1.6; font-style:italic;">"'.$comment.'"</p>'
                .'</div>'
                .'<div>'
                .'<div style="font-weight:700; color:#0f172a; font-size:14px;">'.$name.'</div>'
                .($productName !== '' ? '<div style="color:#64748b; font-size:12px; margin-top:4px; font-weight:600;">'.$productName.'</div>' : '')
                .'</div>'
                .'</div>';
        })->implode('');

        $gridId = 'grid-' . Str::random(8);
        $style = '<style>'
            .'#'.$gridId.' { display:grid; grid-template-columns:repeat(auto-fill, minmax(260px, 1fr)); gap:'.$gap.'px; padding:8px 0; }'
            .'@media (min-width: 768px) { #'.$gridId.' { grid-template-columns:repeat('.$columns.', 1fr); } }'
            .'</style>';

        $grid = '<div id="'.$gridId.'">'.$cards.'</div>';

        return $style . $grid;
    }

    private function renderContactForm(): string
    {
        $actionUrl = e(url('/api/public/contact'));
        $formId = 'cf-'.Str::random(8);

        return '<form id="'.$formId.'" style="display:flex;flex-direction:column;gap:16px;max-width:500px;margin:0 auto;font-family:\'Quicksand\',sans-serif;">'
            .'<input type="text" name="name" placeholder="Họ tên" required style="padding:12px 14px;border:1px solid #cbd5e1;border-radius:8px;font-size:14px;outline:none;font-family:inherit;transition:all 0.2s;" onfocus="this.style.borderColor=\'#5d87ff\'" onblur="this.style.borderColor=\'#cbd5e1\'">'
            .'<input type="text" name="phone" placeholder="Số điện thoại" required style="padding:12px 14px;border:1px solid #cbd5e1;border-radius:8px;font-size:14px;outline:none;font-family:inherit;transition:all 0.2s;" onfocus="this.style.borderColor=\'#5d87ff\'" onblur="this.style.borderColor=\'#cbd5e1\'">'
            .'<input type="email" name="email" placeholder="Email (không bắt buộc)" style="padding:12px 14px;border:1px solid #cbd5e1;border-radius:8px;font-size:14px;outline:none;font-family:inherit;transition:all 0.2s;" onfocus="this.style.borderColor=\'#5d87ff\'" onblur="this.style.borderColor=\'#cbd5e1\'">'
            .'<textarea name="message" placeholder="Nội dung liên hệ..." required rows="4" style="padding:12px 14px;border:1px solid #cbd5e1;border-radius:8px;font-size:14px;outline:none;font-family:inherit;transition:all 0.2s;" onfocus="this.style.borderColor=\'#5d87ff\'" onblur="this.style.borderColor=\'#cbd5e1\'"></textarea>'
            .'<button type="submit" style="padding:12px 24px;background:#5d87ff;color:#fff;border:0;border-radius:8px;cursor:pointer;font-weight:700;font-size:14px;transition:background 0.2s;" onmouseover="this.style.background=\'#4b73e0\'" onmouseout="this.style.background=\'#5d87ff\'">Gửi yêu cầu</button>'
            .'<div class="cf-message" style="font-size:14px;font-weight:600;margin-top:8px;text-align:center;"></div></form>'
            .'<script>(function(){var form=document.getElementById('.json_encode($formId).');if(!form)return;'
            .'form.addEventListener("submit",function(e){e.preventDefault();var msg=form.querySelector(".cf-message");'
            .'msg.style.color="";msg.textContent="Đang gửi…";'
            .'var data={name:form.name.value,phone:form.phone.value,email:form.email.value,message:form.message.value};'
            .'fetch('.json_encode($actionUrl).',{method:"POST",headers:{"Content-Type":"application/json",Accept:"application/json"},body:JSON.stringify(data)})'
            .'.then(function(r){return r.json().then(function(j){return {ok:r.ok,body:j};});})'
            .'.then(function(res){msg.style.color=res.ok?"#087f5b":"#c92a2a";msg.textContent=res.body.message||(res.ok?"Đã gửi.":"Có lỗi xảy ra.");if(res.ok)form.reset();})'
            .'.catch(function(){msg.style.color="#c92a2a";msg.textContent="Không thể gửi. Vui lòng thử lại.";});});})();</script>';
    }

    private function emptyState(string $message): string
    {
        return '<div style="padding:24px;text-align:center;color:#64748b;border:1px dashed #d9e0e8;border-radius:8px;font-family:\'Quicksand\',sans-serif;">'.e($message).'</div>';
    }

    private function replacePlaceholderOrChildren(DOMDocument $document, DOMElement $node, string $innerHtml): void
    {
        $xpath = new DOMXPath($document);
        $placeholders = $xpath->query(
            './/*[contains(@class, "-placeholder")] | ' .
            './/*[contains(text(), "render") or contains(text(), "tự động") or contains(text(), "Storefront") or contains(text(), "danh sách")]',
            $node
        );

        if ($placeholders && $placeholders->length > 0) {
            $target = $placeholders->item(0);
            if ($target instanceof DOMElement) {
                $this->replaceNodeWithHtml($document, $target, $innerHtml);
                return;
            }
        }

        $this->replaceChildren($document, $node, $innerHtml);
    }

    private function replaceNodeWithHtml(DOMDocument $document, DOMElement $target, string $innerHtml): void
    {
        $fragment = new DOMDocument('1.0', 'UTF-8');
        $previous = libxml_use_internal_errors(true);
        $fragment->loadHTML(
            '<?xml encoding="utf-8" ?><div id="frag">'.$innerHtml.'</div>',
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD,
        );
        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        $fragRoot = $fragment->getElementById('frag');
        if (! $fragRoot) {
            return;
        }

        $parent = $target->parentNode;
        if (! $parent) {
            return;
        }

        foreach ($fragRoot->childNodes as $child) {
            $parent->insertBefore($document->importNode($child, true), $target);
        }

        $parent->removeChild($target);
    }

    private function replaceChildren(DOMDocument $document, DOMElement $node, string $innerHtml): void
    {
        while ($node->firstChild) {
            $node->removeChild($node->firstChild);
        }

        $fragment = new DOMDocument('1.0', 'UTF-8');
        $previous = libxml_use_internal_errors(true);
        $fragment->loadHTML(
            '<?xml encoding="utf-8" ?><div id="frag">'.$innerHtml.'</div>',
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD,
        );
        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        $fragRoot = $fragment->getElementById('frag');
        if (! $fragRoot) {
            return;
        }

        foreach ($fragRoot->childNodes as $child) {
            $node->appendChild($document->importNode($child, true));
        }
    }
}
