<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $feature_event = Program::latest()->first();

        // Split the string by comma to separate the date part
        $date = explode(',', $feature_event ->event_date);
        // dd($date);

        $image_path = route('getImageFile',['events','full-redemption-through-christ.jpg']);
        $title_len = strlen($feature_event->name).'px';
        $banner = (object)[
            'title_1' => $feature_event->name,
            'title_1_css' => '',//"font-size: calc(90px - $title_len)",
            'title_2' => 'Join over 3,000,000 Global Audience for a refreshing moment with God.',
            'date_1' => str_replace(" ", "", $date[1]),
            'date_2' => "$date[0] $date[2]",
            'count_down' => "$feature_event->event_countdown",
            // 'count_down' => "2023/11/23 16:00:00",
            // 'image_path' => $image_path,
            // 'style' => 'background: #060024 url('.  $image_path .') no-repeat center center / cover; min-height:600px',
            'image_path' => 'assets/img/banner-01.jpg',
            'style' => 'background: #060024 url( /assets/img/generic/banner-01.jpg ) no-repeat center center / cover; min-height:600px',
            'route' => 'page.register',
        ];
        $res = config('dclm.resources');
        $testimonies = config('dclm.testimonies');

        $sch = Program::where('is_active', true)->get();
        return view('pages.index', [
            'banner'=> $banner,
            'res'=> $res,
            'testimonies'=> $testimonies,
            'sch' => $sch,
            // 'sch' => json_decode(json_encode($sch, JSON_FORCE_OBJECT)),
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

    public function getImageFile($dir, $img)  {
        $path = storage_path($dir) .'/'. $img;
        if (file_exists($path)) {
            return response()->file($path);
        }
        abort(404);
    }

}
