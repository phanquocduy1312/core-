<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$page = \App\Models\Page::find(4);
if (!$page) {
    echo "Page ID 4 not found!\n";
    exit(1);
}

$css = <<<'CSS'
.elementor-12382,
.elementor-12382 *,
.elementor-12382 .elementor-element.elementor-element-c57d41d,
.elementor-12382 .hero-projects-content {
    box-sizing: border-box;
    border: none !important;
    outline: none !important;
}
.elementor-12382 .elementor-element.elementor-element-c57d41d {
    background: linear-gradient(rgba(11, 21, 35, 0.72), rgba(11, 21, 35, 0.72)), url('/wp-content/uploads/2021/12/Marina-One@2x.jpg') center/cover no-repeat !important;
    min-height: 380px !important;
    height: auto !important;
    position: relative !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 70px 20px 60px 20px !important;
    margin: 0 !important;
    overflow: hidden !important;
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
}
.elementor-12382 .elementor-element.elementor-element-c57d41d > .elementor-container {
    min-height: 0 !important;
    height: auto !important;
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    width: 100% !important;
}
.elementor-12382 .hero-projects-content {
    max-width: 860px !important;
    margin: 0 auto !important;
    text-align: center !important;
    position: relative !important;
    z-index: 2 !important;
}
.elementor-12382 .hero-projects-content h1 {
    font-family: 'ACaslonPro', serif, sans-serif !important;
    font-size: 38px !important;
    font-weight: 300 !important;
    line-height: 48px !important;
    letter-spacing: -0.2px !important;
    color: #FFFFFF !important;
    margin: 0 auto !important;
    max-width: 820px !important;
    text-shadow: 0 2px 10px rgba(0,0,0,0.5) !important;
}
.elementor-12382 .hero-projects-content p.quote {
    font-family: 'Din', sans-serif !important;
    font-size: 15px !important;
    font-weight: 300 !important;
    color: rgba(255, 255, 255, 0.85) !important;
    margin-top: 18px !important;
    margin-bottom: 4px !important;
    letter-spacing: 0.3px !important;
}
.elementor-12382 .hero-projects-content p.author {
    font-family: 'Din', sans-serif !important;
    font-size: 14px !important;
    font-weight: 300 !important;
    color: rgba(255, 255, 255, 0.65) !important;
    margin-top: 4px !important;
}

/* Section 2: Our Projects 3D Carousel */
.elementor-12382 .sliderSection {
    background-color: #FFFFFF !important;
    padding: 50px 0 80px 0 !important;
}
.elementor-12382 .lux-carousel h2 {
    font-family: 'ACaslonPro', serif, sans-serif !important;
    font-size: 42px !important;
    font-weight: 400 !important;
    color: #0B1523 !important;
    text-align: center !important;
    margin-bottom: 30px !important;
}
.elementor-12382 .app {
    position: relative !important;
    width: 100% !important;
    min-height: 600px !important;
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    overflow: hidden !important;
}
.elementor-12382 .cardList__btn {
    background-color: transparent !important;
    border: none !important;
    cursor: pointer !important;
    z-index: 10 !important;
    padding: 10px !important;
    outline: none !important;
    transition: transform 0.3s ease !important;
}
.elementor-12382 .cardList__btn:hover {
    transform: translateY(-50%) scale(0.35) !important;
}
@media only screen and (max-width: 767px) {
    .elementor-12382 .hero-projects-content h1 {
        font-size: 22px !important;
        line-height: 30px !important;
    }
    .elementor-12382 .elementor-element.elementor-element-c57d41d {
        min-height: 280px !important;
        padding: 40px 15px !important;
    }
}
CSS;

$html = $page->published_html;
$html = str_replace("{{ route('projects.hospitality') }}", '/hospitality-lighting-projects', $html);
$html = str_replace("{{ route('projects.residential') }}", '/residential-lighting-projects', $html);
$html = str_replace("{{ route('projects.commercial') }}", '/commercial-lighting-projects', $html);

$page->published_css = $css;
$page->published_html = $html;
$page->save();

echo "Page ID 4 updated successfully! published_css length: " . strlen($page->published_css) . "\n";
