<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Program;
use Illuminate\Http\Request;

class StaticPages extends Controller
{
    public function index()
    {
        $navbar_class = 'navbar-detached shadow-none';
        $data = [
            'navbar_class' => $navbar_class,
        ];

        $banner = (object)[
            'title_1' => 'LOOSE HIM, <br> LET HIM GO',
            'title_2' => 'Join over 3,000,000 Global Audience for a refreshing moment with God.',
            'date_1' => '26-31',
            'date_2' => 'OCT 2023',
            'count_down' => '2023/10/26 16:00:00',
            // 'count_down' => '22 June 2023',
            'image_path' => 'assets/img/banner-01.jpg',
            'style' => 'background: #060024 url( /assets/img/generic/banner-01.jpg ) no-repeat center center / cover; min-height:600px',
            'route' => 'page.register',
        ];
        $res = config('dclm.resources');
        $sch = config('dclm.schedules');
        // $sch = json_decode(json_encode( config('dclm.schedules'), JSON_FORCE_OBJECT)) ;
        $testimonies = config('dclm.testimonies');

        return view('pages.index', [
            'banner'=> $banner,
            'res'=> $res,
            'testimonies'=> $testimonies,
            'sch' => json_decode(json_encode($sch, JSON_FORCE_OBJECT)),
        ]);
    }

    public function register(Request $request){
        if (request()->isMethod('get')) {
            $countries = Country::all();
            $programs = Program::where('is_active', 1)->select('id','name','image_location','event_days')->get(3);
            return view('pages.register', compact('countries','programs'));
        }

        // if (request()->isMethod('post')) {
        //     dd($request->all());
        //     $validated = $request->validate([

        //     ]);
        // }
    }
}
