<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('pages.san-pham.index');
    }

    public function show($slug = 'infinisolar-10kw')
    {
        $cleanSlug = preg_replace('/\.html$/i', '', $slug);

        $categoryRoutes = [
            'tam-pin-mat-troi' => 'products.solar-panel',
            'inverter' => 'products.inverter',
            'pin-luu-tru' => 'products.battery',
            'bien-tan-bom' => 'products.pump',
            'phu-kien-solar' => 'products.accessories',
        ];

        if (isset($categoryRoutes[$cleanSlug])) {
            return redirect()->route($categoryRoutes[$cleanSlug]);
        }

        return view('pages.san-pham.show', [
            'slug' => $slug,
            'cleanSlug' => $cleanSlug,
        ]);
    }

    public function inverter()
    {
        return redirect()->route('products.index', ['filter' => 'inverter']);
    }

    public function battery()
    {
        return redirect()->route('products.index', ['filter' => 'battery']);
    }

    public function pump()
    {
        return redirect()->route('products.index', ['filter' => 'pump']);
    }

    public function solarPanel()
    {
        return redirect()->route('products.index', ['filter' => 'panel']);
    }

    public function accessories()
    {
        return redirect()->route('products.index', ['filter' => 'accessories']);
    }
}
