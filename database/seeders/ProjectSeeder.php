<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Services\LocalizedSlugService;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            // 1. Hospitality
            [
                'slug' => 'constance-lemuria-praslin',
                'category' => 'hospitality',
                'title_vi' => 'Constance Lemuria Praslin, Seychelles',
                'title_en' => 'Constance Lemuria Praslin, Seychelles',
                'location_vi' => 'Seychelles',
                'location_en' => 'Seychelles',
                'client' => 'Constance Hotels & Resorts',
                'completion_year' => 'Project Completion in 2016',
                'summary_vi' => 'Khu nghỉ dưỡng 5 sao sang trọng được bao quanh bởi 3 bãi cát trắng mịn màng và thảm thực vật nhiệt đới tươi tốt.',
                'summary_en' => '5-star Hotel surrounded by 3 white-sand beaches and lush vegetation.',
                'content_vi' => 'Toàn bộ đèn trang trí cao cấp trong các phòng nghỉ dưỡng của khách.',
                'content_en' => 'All Decorative Lighting in guest rooms.',
                'image_url' => '/wp-content/uploads/2021/12/Costance-Lemuria-Praslin_599x599.jpg',
                'banner_url' => '/wp-content/uploads/2021/12/Costance-Lemuria-Praslin_599x599.jpg',
                'gallery' => [
                    '/wp-content/uploads/elementor/thumbs/Costance_1280x800-pisiv22qefp2qxth4g5bxfnsqsxl2ite687b0eqtaw.jpg',
                    '/wp-content/uploads/elementor/thumbs/Costance_965x603-pisiv4w8yxsxprpdnzd7mwy6iyjopm4l6m5rg8mms8.jpg',
                    '/wp-content/uploads/elementor/thumbs/Constance-Lemuria-Praslin-Seychelles-Slide-63@3x-scaled-pisiv5u35ru81do0ihru7epn4cf1xb8biqt8xil8m0.jpg',
                    '/wp-content/uploads/elementor/thumbs/Constance-Lemuria-Praslin-Seychelles-Slide-66@5x-scaled-pisiv5u35ru81do0ihru7epn4cf1xb8biqt8xil8m0.jpg',
                ],
                'sort_order' => 1,
            ],
            [
                'slug' => 'dusit-thani-laguna',
                'category' => 'hospitality',
                'title_vi' => 'Dusit Thani Laguna, Singapore',
                'title_en' => 'Dusit Thani Laguna, Singapore',
                'location_vi' => 'Singapore',
                'location_en' => 'Singapore',
                'client' => 'Dusit Thani Group',
                'completion_year' => 'Project Completion in 2020',
                'summary_vi' => 'Khu nghỉ dưỡng phong cách resort đô thị cao cấp nằm ngay trong khuôn viên Laguna National Golf & Country Club.',
                'summary_en' => 'Luxury urban golf resort hotel located within the grounds of the Laguna National Golf & Country Club.',
                'content_vi' => 'Cung cấp đèn kiến trúc và đèn trang trí khu sảnh chính, nhà hàng và phòng nghỉ.',
                'content_en' => 'Architectural and decorative lighting for main lobby, restaurants and guest rooms.',
                'image_url' => '/wp-content/uploads/2021/12/Dusit-Thani-Laguna_599x599.jpg',
                'banner_url' => '/wp-content/uploads/2021/12/Dusit-Thani-Laguna_599x599.jpg',
                'gallery' => [
                    '/wp-content/uploads/2021/12/Dusit-Thani-Laguna_599x599.jpg',
                ],
                'sort_order' => 2,
            ],
            [
                'slug' => 'artyzen-cuscaden-hotel',
                'category' => 'hospitality',
                'title_vi' => 'Artyzen Cuscaden Hotel, Singapore',
                'title_en' => 'Artyzen Cuscaden Hotel, Singapore',
                'location_vi' => 'Singapore',
                'location_en' => 'Singapore',
                'client' => 'Shun Tak Holdings',
                'completion_year' => 'Project Completion in 2023',
                'summary_vi' => 'Khách sạn phong cách boutique sang trọng tọa lạc tại đại lộ Orchard đẳng cấp của Singapore.',
                'summary_en' => 'Modern boutique luxury hotel nestled in the heart of Singapore Orchard district.',
                'content_vi' => 'Hệ thống đèn chùm trang trí sảnh, đèn phòng ngủ và giải pháp chiếu sáng cảnh quan mặt tiền.',
                'content_en' => 'Custom decorative chandeliers, guest room lighting and exterior facade illumination.',
                'image_url' => '/wp-content/uploads/2021/12/Artyzen-Cuscaden_599x599.jpg',
                'banner_url' => '/wp-content/uploads/2021/12/Artyzen-Cuscaden_599x599.jpg',
                'gallery' => [
                    '/wp-content/uploads/2021/12/Artyzen-Cuscaden_599x599.jpg',
                ],
                'sort_order' => 3,
            ],
            [
                'slug' => 'intercontinental-dhaka',
                'category' => 'hospitality',
                'title_vi' => 'InterContinental Dhaka, Bangladesh',
                'title_en' => 'InterContinental Dhaka, Bangladesh',
                'location_vi' => 'Dhaka, Bangladesh',
                'location_en' => 'Dhaka, Bangladesh',
                'client' => 'IHG Hotels & Resorts',
                'completion_year' => 'Project Completion in 2018',
                'summary_vi' => 'Khách sạn 5 sao danh tiếng bậc nhất với phong cách kiến trúc di sản uy nghi tại thủ đô Dhaka.',
                'summary_en' => 'Iconic 5-star luxury heritage hotel in the heart of Dhaka.',
                'content_vi' => 'Chiếu sáng tổng thể hội trường đại yến, phòng tổng thống và hệ thống đèn trang trí.',
                'content_en' => 'Comprehensive ballroom, presidential suite and bespoke public area decorative lighting.',
                'image_url' => '/wp-content/uploads/2021/12/Intercontinental-Dhaka_599x599.jpg',
                'banner_url' => '/wp-content/uploads/2021/12/Intercontinental-Dhaka_599x599.jpg',
                'gallery' => [
                    '/wp-content/uploads/2021/12/Intercontinental-Dhaka_599x599.jpg',
                ],
                'sort_order' => 4,
            ],
            [
                'slug' => 'w-singapore',
                'category' => 'hospitality',
                'title_vi' => 'W Singapore - Sentosa Cove',
                'title_en' => 'W Singapore - Sentosa Cove',
                'location_vi' => 'Sentosa Cove, Singapore',
                'location_en' => 'Sentosa Cove, Singapore',
                'client' => 'Marriott International',
                'completion_year' => 'Project Completion in 2012',
                'summary_vi' => 'Ốc đảo nghỉ dưỡng sống động phong cách thời thượng tại khu Sentosa Cove thượng lưu.',
                'summary_en' => 'Vibrant luxury lifestyle oasis nestled within the exclusive Sentosa Cove resort enclave.',
                'content_vi' => 'Giải pháp chiếu sáng nghệ thuật và đèn trang trí chuyên biệt cho khu vực công cộng và quầy bar WOOBAR.',
                'content_en' => 'Custom artistic ambient lighting for public areas and the famous WOOBAR.',
                'image_url' => '/wp-content/uploads/2021/12/W-Singapore_599x599.jpg',
                'banner_url' => '/wp-content/uploads/2021/12/W-Singapore_599x599.jpg',
                'gallery' => [
                    '/wp-content/uploads/2021/12/W-Singapore_599x599.jpg',
                ],
                'sort_order' => 5,
            ],

            // 2. Residential
            [
                'slug' => 'residential-lighting-amber-pa',
                'category' => 'residential',
                'title_vi' => 'Amber Park, Singapore',
                'title_en' => 'Amber Park, Singapore',
                'location_vi' => 'East Coast, Singapore',
                'location_en' => 'East Coast, Singapore',
                'client' => 'City Developments Limited (CDL)',
                'completion_year' => 'Project Completion in 2023',
                'summary_vi' => 'Khu căn hộ phức hợp hạng sang với tầng thượng ngắm biển Stratosphere độc nhất vô nhị.',
                'summary_en' => 'Iconic luxury condominium featuring the signature Stratosphere rooftop deck.',
                'content_vi' => 'Hệ thống đèn trần, đèn led thanh nhôm và đèn trang trí căn hộ mẫu và sảnh đón sang trọng.',
                'content_en' => 'Architectural recessed downlights, linear profiles and luxury show-suite luminaires.',
                'image_url' => '/wp-content/uploads/2021/12/Amber-Park_599x599.jpg',
                'banner_url' => '/wp-content/uploads/2021/12/Amber-Park_599x599.jpg',
                'gallery' => [
                    '/wp-content/uploads/2021/12/Amber-Park_599x599.jpg',
                ],
                'sort_order' => 10,
            ],
            [
                'slug' => 'twentyone-angullia-park-singapore',
                'category' => 'residential',
                'title_vi' => 'TwentyOne Angullia Park, Singapore',
                'title_en' => 'TwentyOne Angullia Park, Singapore',
                'location_vi' => 'Orchard, Singapore',
                'location_en' => 'Orchard, Singapore',
                'client' => 'CS Land',
                'completion_year' => 'Project Completion in 2014',
                'summary_vi' => 'Tòa tháp căn hộ siêu sang 36 tầng đối diện khu mua sắm Wheelock Place và ION Orchard.',
                'summary_en' => 'Ultra-luxurious 36-storey residential tower opposite ION Orchard.',
                'content_vi' => 'Đèn trang trí nội thất căn hộ penthouse và đèn rọi điểm bảo tàng nghệ thuật.',
                'content_en' => 'Penthouse interior decorative fixtures and museum-grade accent lighting.',
                'image_url' => '/wp-content/uploads/2021/12/21-Angullia-Park_599x599.jpg',
                'banner_url' => '/wp-content/uploads/2021/12/21-Angullia-Park_599x599.jpg',
                'gallery' => [
                    '/wp-content/uploads/2021/12/21-Angullia-Park_599x599.jpg',
                ],
                'sort_order' => 11,
            ],
            [
                'slug' => 'private-house',
                'category' => 'residential',
                'title_vi' => 'Biệt thự Đảo Sentosa Cove Private House',
                'title_en' => 'Sentosa Cove Private Residence',
                'location_vi' => 'Sentosa, Singapore',
                'location_en' => 'Sentosa, Singapore',
                'client' => 'Private Client',
                'completion_year' => 'Project Completion in 2021',
                'summary_vi' => 'Biệt thự nghỉ dưỡng tư nhân nhìn ra bến du thuyền với thiết kế ánh sáng ấm áp, đẳng cấp.',
                'summary_en' => 'Private waterfront villa overlooking the marina with bespoke warm architectural lighting.',
                'content_vi' => 'Toàn bộ giải pháp chiếu sáng thông minh điều khiển theo ngữ cảnh và đèn sân vườn hồ bơi.',
                'content_en' => 'Smart mood lighting control systems, garden and underwater pool illumination.',
                'image_url' => '/wp-content/uploads/2021/12/Private-House_599x599.jpg',
                'banner_url' => '/wp-content/uploads/2021/12/Private-House_599x599.jpg',
                'gallery' => [
                    '/wp-content/uploads/2021/12/Private-House_599x599.jpg',
                ],
                'sort_order' => 12,
            ],

            // 3. Commercial
            [
                'slug' => 'commercial-lighting-cloudstreet',
                'category' => 'commercial',
                'title_vi' => 'Nhà hàng Cloudstreet 2 Sao Michelin',
                'title_en' => 'Cloudstreet Restaurant (2 Michelin Stars)',
                'location_vi' => 'Amoy Street, Singapore',
                'location_en' => 'Amoy Street, Singapore',
                'client' => 'Chef Rishi Naleendra',
                'completion_year' => 'Project Completion in 2019',
                'summary_vi' => 'Không gian ẩm thực đỉnh cao với quầy bếp mở và phong cách chiếu sáng ấm cúng, tinh tế.',
                'summary_en' => 'World-class 2-Michelin starred dining venue centered around an intimate chef counter.',
                'content_vi' => 'Hệ thống đèn rọi bàn ăn chuyên dụng chuẩn màu sắc cao CRI>95 làm nổi bật sắc thái từng món ăn.',
                'content_en' => 'Specialized high-CRI > 95 focal spotlights designed to enhance culinary visual presentation.',
                'image_url' => '/wp-content/uploads/2021/12/Cloudstreet_599x599.jpg',
                'banner_url' => '/wp-content/uploads/2021/12/Cloudstreet_599x599.jpg',
                'gallery' => [
                    '/wp-content/uploads/2021/12/Cloudstreet_599x599.jpg',
                ],
                'sort_order' => 20,
            ],
            [
                'slug' => 'commercial-lighting-the-clubroom',
                'category' => 'commercial',
                'title_vi' => 'The Clubroom, Singapore',
                'title_en' => 'The Clubroom, Singapore',
                'location_vi' => 'Robinson Road, Singapore',
                'location_en' => 'Robinson Road, Singapore',
                'client' => 'The Work Project',
                'completion_year' => 'Project Completion in 2021',
                'summary_vi' => 'Không gian làm việc và câu lạc bộ doanh nhân tư nhân mang âm hưởng khách sạn 5 sao cao cấp.',
                'summary_en' => 'Premium business private members club with five-star hospitality design language.',
                'content_vi' => 'Đèn tường nghệ thuật, đèn chùm kim loại vàng đồng và hệ đèn ray định hình không gian.',
                'content_en' => 'Artistic brass wall sconces, custom chandeliers and recessed magnetic track systems.',
                'image_url' => '/wp-content/uploads/2021/12/The-Clubroom_599x599.jpg',
                'banner_url' => '/wp-content/uploads/2021/12/The-Clubroom_599x599.jpg',
                'gallery' => [
                    '/wp-content/uploads/2021/12/The-Clubroom_599x599.jpg',
                ],
                'sort_order' => 21,
            ],
            [
                'slug' => 'funan-mall-singapore',
                'category' => 'commercial',
                'title_vi' => 'Funan Mall, Singapore',
                'title_en' => 'Funan Mall, Singapore',
                'location_vi' => 'Civic District, Singapore',
                'location_en' => 'Civic District, Singapore',
                'client' => 'CapitaLand',
                'completion_year' => 'Project Completion in 2019',
                'summary_vi' => 'Trung tâm thương mại tích hợp công nghệ và trải nghiệm sáng tạo hàng đầu khu trung tâm Singapore.',
                'summary_en' => 'Creative lifestyle and retail technological mall in the Singapore Civic District.',
                'content_vi' => 'Chiếu sáng khu vực sảnh thông tầng Kinetic Wall và đường dẫn trong nhà.',
                'content_en' => 'Dynamic lighting for kinetic installations and atrium experiential zones.',
                'image_url' => '/wp-content/uploads/2021/12/Funan-Mall_599x599.jpg',
                'banner_url' => '/wp-content/uploads/2021/12/Funan-Mall_599x599.jpg',
                'gallery' => [
                    '/wp-content/uploads/2021/12/Funan-Mall_599x599.jpg',
                ],
                'sort_order' => 22,
            ],

            // 4. Other
            [
                'slug' => 'church-of-the-blessed-sacrament',
                'category' => 'other',
                'title_vi' => 'Church of the Blessed Sacrament, Singapore',
                'title_en' => 'Church of the Blessed Sacrament, Singapore',
                'location_vi' => 'Queenstown, Singapore',
                'location_en' => 'Queenstown, Singapore',
                'client' => 'Catholic Archdiocese of Singapore',
                'completion_year' => 'Project Completion in 2020',
                'summary_vi' => 'Di tích lịch sử công trình tôn giáo với mái vòm lợp ngói hình nón nổi tiếng của Singapore.',
                'summary_en' => 'Iconic gazetted national monument Catholic church with a distinctive tent-like blue roof.',
                'content_vi' => 'Giải pháp chiếu sáng thánh đường tôn nghiêm, bảo tồn cấu trúc mái cổ kính với nhiệt độ màu chuẩn 3000K.',
                'content_en' => 'Reverent sanctuary lighting preserving architectural heritage with precise 3000K color tone.',
                'image_url' => '/wp-content/uploads/2021/12/Church-of-the-Blessed-Sacrament_599x599.jpg',
                'banner_url' => '/wp-content/uploads/2021/12/Church-of-the-Blessed-Sacrament_599x599.jpg',
                'gallery' => [
                    '/wp-content/uploads/2021/12/Church-of-the-Blessed-Sacrament_599x599.jpg',
                ],
                'sort_order' => 30,
            ],
            [
                'slug' => 'the-enabling-village-singapore',
                'category' => 'other',
                'title_vi' => 'The Enabling Village, Singapore',
                'title_en' => 'The Enabling Village, Singapore',
                'location_vi' => 'Lengkok Bahru, Singapore',
                'location_en' => 'Lengkok Bahru, Singapore',
                'client' => 'SG Enable',
                'completion_year' => 'Project Completion in 2016',
                'summary_vi' => 'Khuôn viên cộng đồng hòa nhập xã hội đạt giải thưởng kiến trúc bền vững hàng đầu của Singapore.',
                'summary_en' => 'Award-winning inclusive community village and sustainability architectural hub.',
                'content_vi' => 'Hệ thống đèn chiếu sáng lối đi không chói mắt (anti-glare) đạt tiêu chuẩn tiếp cận phổ quát (Universal Design).',
                'content_en' => 'Anti-glare pathway and landscape luminaires tailored for Universal Design accessibility.',
                'image_url' => '/wp-content/uploads/2021/12/The-Enabling-Village_599x599.jpg',
                'banner_url' => '/wp-content/uploads/2021/12/The-Enabling-Village_599x599.jpg',
                'gallery' => [
                    '/wp-content/uploads/2021/12/The-Enabling-Village_599x599.jpg',
                ],
                'sort_order' => 31,
            ],
        ];

        $slugService = app(LocalizedSlugService::class);

        foreach ($projects as $item) {
            if (Project::query()->where('slug', $item['slug'])->exists()) {
                continue;
            }

            $project = Project::query()->create([
                'title' => [
                    'vi' => $item['title_vi'],
                    'en' => $item['title_en'],
                    'ko' => $item['title_en'],
                ],
                'slug' => $item['slug'],
                'category' => $item['category'],
                'location' => [
                    'vi' => $item['location_vi'],
                    'en' => $item['location_en'],
                    'ko' => $item['location_en'],
                ],
                'client' => $item['client'],
                'completion_year' => $item['completion_year'],
                'summary' => [
                    'vi' => $item['summary_vi'],
                    'en' => $item['summary_en'],
                    'ko' => $item['summary_en'],
                ],
                'content' => [
                    'vi' => $item['content_vi'],
                    'en' => $item['content_en'],
                    'ko' => $item['content_en'],
                ],
                'image_url' => $item['image_url'],
                'banner_url' => $item['banner_url'],
                'gallery' => $item['gallery'],
                'sort_order' => $item['sort_order'],
                'is_active' => true,
                'is_featured' => true,
            ]);

            $slugService->sync($project, [
                'vi' => $item['slug'],
                'en' => $item['slug'],
                'ko' => $item['slug'],
            ]);
        }
    }
}
