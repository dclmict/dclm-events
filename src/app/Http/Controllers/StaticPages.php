<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPages extends Controller
{
    public function index()
    {
        $navbar_class = 'navbar-detached';
        $data = [
            'navbar_class' => $navbar_class,
        ];

        $banner = (object)[
            'title_1' => 'Glorious Visitation from Christ',
            'title_2' => 'Join over 3,000,000 Global Audience for a refreshing moment with God.',
            'date_1' => '20-25',
            'date_2' => 'APRIL 2023',
            'count_down' => '20 Aprl 2023',
            'image_path' => 'assets/img/banner-01.jpg',
            'style' => 'background: #060024 url( /assets/img/banner-01.jpg ) no-repeat center center / cover; min-height:600px'

        ];
        // dump((object) $banner);dd($banner);
        return view('pages.index', [
            'banner'=> $banner,
        ]);
    }
}
