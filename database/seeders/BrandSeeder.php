<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            [
                'slug' => 'luxpower',
                'name' => ['vi' => 'LUXPOWER', 'en' => 'LUXPOWER'],
                'description' => ['vi' => 'Thương hiệu Inverter Hybrid thông minh hàng đầu.', 'en' => 'Leading Smart Hybrid Inverter Brand.'],
                'image_url' => 'assets/images/logos/luxpower_logo.png',
                'sort_order' => 1,
            ],
            [
                'slug' => 'deye',
                'name' => ['vi' => 'Deye Solar', 'en' => 'Deye Solar'],
                'description' => ['vi' => 'Giải pháp Biến tần & Pin lưu trữ năng lượng Smart Hybrid.', 'en' => 'Smart Hybrid Inverter & ESS Solutions.'],
                'image_url' => 'assets/images/logos/deye_logo.png',
                'sort_order' => 2,
            ],
            [
                'slug' => 'solis',
                'name' => ['vi' => 'Solis (Ginlong)', 'en' => 'Solis (Ginlong)'],
                'description' => ['vi' => 'Biến tần năng lượng mặt trời công nghệ Ginlong.', 'en' => 'Ginlong Solar Inverters.'],
                'image_url' => 'assets/images/logos/solis_logo.webp',
                'sort_order' => 3,
            ],
            [
                'slug' => 'goodwe',
                'name' => ['vi' => 'GoodWe', 'en' => 'GoodWe'],
                'description' => ['vi' => 'Giải pháp biến tần hòa lưới và lưu trữ cao cấp.', 'en' => 'Premium On-grid & Energy Storage Solutions.'],
                'image_url' => 'assets/images/logos/goodwe_logo.png',
                'sort_order' => 4,
            ],
            [
                'slug' => 'lumentree',
                'name' => ['vi' => 'Lumentree', 'en' => 'Lumentree'],
                'description' => ['vi' => 'Biến tần hòa lưới bám tải hiệu suất cao.', 'en' => 'High efficiency zero-export grid-tie inverters.'],
                'image_url' => 'assets/images/logos/lumentree_logo.avif',
                'sort_order' => 5,
            ],
            [
                'slug' => 'bastions',
                'name' => ['vi' => 'Bastions Energy', 'en' => 'Bastions Energy'],
                'description' => ['vi' => 'Tấm pin mặt trời & pin lưu trữ công nghệ N-Type TOPCon.', 'en' => 'N-Type TOPCon solar panels & storage.'],
                'image_url' => 'assets/images/logos/bastionsenergy_logo.png',
                'sort_order' => 6,
            ],
            [
                'slug' => 'longi',
                'name' => ['vi' => 'LONGi Solar', 'en' => 'LONGi Solar'],
                'description' => ['vi' => 'Tập đoàn sản xuất tấm pin quang điện hàng đầu thế giới.', 'en' => 'World leading solar module manufacturer.'],
                'image_url' => 'assets/images/logos/longi_logo.png',
                'sort_order' => 7,
            ],
            [
                'slug' => 'vsun',
                'name' => ['vi' => 'VSUN Solar', 'en' => 'VSUN Solar'],
                'description' => ['vi' => 'Tấm pin năng lượng mặt trời công nghệ Nhật Bản.', 'en' => 'Japanese technology solar modules.'],
                'image_url' => 'assets/images/logos/vsun_logo.png',
                'sort_order' => 8,
            ],
            [
                'slug' => 'aesolar',
                'name' => ['vi' => 'AE Solar', 'en' => 'AE Solar'],
                'description' => ['vi' => 'Tấm pin năng lượng mặt trời chuẩn chất lượng Đức.', 'en' => 'German quality solar PV modules.'],
                'image_url' => 'assets/images/logos/aesolar_logo.png',
                'sort_order' => 9,
            ],
            [
                'slug' => 'worldenergy',
                'name' => ['vi' => 'World Energy', 'en' => 'World Energy'],
                'description' => ['vi' => 'Thiết bị điện mặt trời & biến tần bơm chuyên dụng.', 'en' => 'Solar equipment & solar pump inverters.'],
                'image_url' => 'assets/images/logos/worldenergy_logo.png',
                'sort_order' => 10,
            ],
            [
                'slug' => 'jinko',
                'name' => ['vi' => 'JinKO Solar', 'en' => 'JinKO Solar'],
                'description' => ['vi' => 'Thương hiệu tấm pin mặt trời số 1 thế giới.', 'en' => 'World Tier 1 solar panel manufacturer.'],
                'image_url' => 'assets/images/logos/jinko_logo.webp',
                'sort_order' => 11,
            ],
            [
                'slug' => 'xinpz',
                'name' => ['vi' => 'Xinpz Energy', 'en' => 'Xinpz Energy'],
                'description' => ['vi' => 'Pin lưu trữ Lithium LiFePO4 & phụ kiện điện mặt trời.', 'en' => 'LiFePO4 Lithium batteries & solar accessories.'],
                'image_url' => 'assets/images/logos/xinpz_logo.jpg',
                'sort_order' => 12,
            ],
        ];

        foreach ($brands as $data) {
            Brand::query()->updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'image_url' => $data['image_url'],
                    'sort_order' => $data['sort_order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
