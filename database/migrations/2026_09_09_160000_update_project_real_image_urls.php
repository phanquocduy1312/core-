<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $map = [
            'constance-lemuria-praslin' => [
                'image' => '/wp-content/uploads/2021/12/Costance-Lemuria-Praslin_599x599.jpg',
                'banner' => '/wp-content/uploads/2021/12/Costance-Lemuria-Praslin_599x599.jpg',
            ],
            'dusit-thani-laguna' => [
                'image' => '/wp-content/uploads/2021/12/Dusit-Thani-Laguna@05x.jpg',
                'banner' => '/wp-content/uploads/2021/12/Dusit-Thani-Laguna@05x.jpg',
            ],
            'artyzen-cuscaden-hotel' => [
                'image' => '/wp-content/uploads/2024/01/Artyzen-Square.jpg',
                'banner' => '/wp-content/uploads/2024/01/Artyzen-Square.jpg',
            ],
            'intercontinental-dhaka' => [
                'image' => '/wp-content/uploads/2021/12/InterContinental-Dhaka@15x.jpg',
                'banner' => '/wp-content/uploads/2021/12/InterContinental-Dhaka@15x.jpg',
            ],
            'w-singapore' => [
                'image' => '/wp-content/uploads/2021/12/W-Hotel@125x.jpg',
                'banner' => '/wp-content/uploads/2021/12/W-Hotel@125x.jpg',
            ],
            'residential-lighting-amber-pa' => [
                'image' => '/wp-content/uploads/2021/12/Residential_663x854.jpg',
                'banner' => '/wp-content/uploads/2021/12/Residential_2000x2577-scaled.jpg',
            ],
            'twentyone-angullia-park-singapore' => [
                'image' => '/wp-content/uploads/2021/12/TwentyOneAngullia065@3x-scaled.jpg',
                'banner' => '/wp-content/uploads/2021/12/TwentyOneAngullia065@3x-scaled.jpg',
            ],
            'private-house' => [
                'image' => '/wp-content/uploads/2021/12/Chancery-Lane_1000x1000.jpg',
                'banner' => '/wp-content/uploads/2021/12/Chancery-Lane_1000x1000.jpg',
            ],
            'commercial-lighting-cloudstreet' => [
                'image' => '/wp-content/uploads/2021/12/Commercial_384x495.jpg',
                'banner' => '/wp-content/uploads/2021/12/Commercial_384x495.jpg',
            ],
            'commercial-lighting-the-clubroom' => [
                'image' => '/wp-content/uploads/2021/12/The-Work-Project_03@03x.jpg',
                'banner' => '/wp-content/uploads/2021/12/The-Work-Project_03@03x.jpg',
            ],
            'funan-mall-singapore' => [
                'image' => '/wp-content/uploads/2021/12/Funan-Mall_900x900.jpg',
                'banner' => '/wp-content/uploads/2021/12/Funan-Mall_900x900.jpg',
            ],
            'church-of-the-blessed-sacrament' => [
                'image' => '/wp-content/uploads/2024/05/Church-of-Blessed-Sacrament-Website.jpg',
                'banner' => '/wp-content/uploads/2024/05/Church-of-Blessed-Sacrament-Website.jpg',
            ],
            'the-enabling-village-singapore' => [
                'image' => '/wp-content/uploads/2021/12/The-Enabling-Village@25x.jpg',
                'banner' => '/wp-content/uploads/2021/12/The-Enabling-Village@25x.jpg',
            ],
        ];

        foreach ($map as $slug => $urls) {
            DB::table('projects')
                ->where('slug', $slug)
                ->update([
                    'image_url' => $urls['image'],
                    'banner_url' => $urls['banner'],
                ]);
        }
    }

    public function down(): void
    {
        // No-op
    }
};
