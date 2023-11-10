<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DpmakerFormRequest;
use Illuminate\Support\Facades\Validator;
// use Intervention\Image\ImageManagerStatic as Image;
use File;
use Image;
// use Validator;

// use Intervention\Image;

class DpMakerController extends Controller
{
    public function index(Request $request)
    {
        $colors = [
            '#ff8200' => 'Default Color',
            '#2798D4' => 'Picton Blue',
            '#71A6D2' => 'Iceberg',
            '#E32636' => 'Alizarin',
            '#FF8C00' => 'Dark Orange',
            '#002E63' => 'Cool Black',
            '#FFBF00' => 'Amber',
            '#8DB600' => 'Apple Green',
            '#000000' => 'Black',
            '#C32148' => 'Bright Maroon',
            '#00009C' => 'Duke Blue',
        ];
        if (request()->isMethod('get')) {
            return view('pages.dpmaker', compact('colors'));
        }

        if (request()->isMethod('post')) {
            try {
                $rules = [
                    'fullname' => 'required|string',
                    'district' => 'required|string',
                    'file' => 'required|image|mimes:jpg,jpeg,png,gif,bmp|max:2048',
                ];
                $messages = [
                    '*.required'  => 'The :attribute field is required',
                    'file.mimes' => 'Require valid image types are: jpg, jpeg, png, gif, bmp.',
                    'file.max' => 'The image size should not exceed 2MB.',
                ];
                // Create a validator instance
                $validator = Validator::make($request->all(), $rules, $messages);
                // Perform the validation
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                define('FONT_PATH', public_path('assets/fonts/'));

                $image = Image::make($request->file);
                $image->orientate();
                $image->encode('jpg');
                // $cachePath = public_path('cache/temp/');
                //$cachePath = 'cache/temp/_my-dp.jpg';
                // $save_path = storage_path().'/app/public/dpcache/';
                $save_path = public_path('/cache/temp/');
                $save_name = time().'_my-dp.jpg';
                // attempt to create cache directory
                File::makeDirectory($save_path, $mode = 0755, true, true);
                $cachePath = $save_path.$save_name;

                // Set Image Size
                $image->fit(320, 320);

                // create empty canvas
                $width = $image->getWidth();
                $height = $image->getHeight();
                $mask = Image::canvas($width, $height);

                // draw a white circle
                $mask->circle($width, $width / 2, $height / 2, function ($draw) {
                    $draw->background('fff');
                });

                $image->mask($mask, false);
                /***********************/

                $dpfont  = FONT_PATH . 'Raleway-ExtraBold.ttf';
                $color      =  $request->color?? "#C32148";
                $userName   =  $request->fullname ?? "Wonderful Person";
                //circle($cx, $cy, $r, $color, $filled=false)
                $user = [
                    'text'   => substr($userName, 0, 28),
                    'x'      => 540,
                    'y'      => 575,
                    'size'   => 22,
                    'angle'  => 0,
                    'color'  => $color ?? "#C32148",
                    'pos'    => "center",
                ];

                $distName = $request->district ?? "Deeper Life Bible Chuch - Close to you";
                $dist = [
                    'text'   => "@ " . substr($distName, 0, 70), //substr() use to limit address character lenght
                    'x'      => 610,
                    'y'      => 986,
                    'size'   => 13,
                    'angle'  => 0,
                    'color'  => $color ?? "#C32148",
                    'pos'    => "center",
                ];

                $myDP = Image::make( public_path('assets/img/event-img/zambia_banner.jpg') );

                // $myDP->insert($image, 'top-left', 336, 203);

                //Write Name Text Shadow
                // $myDP->text($user['text'], $user['x']+2, $user['y']+2, function($font) use($color) {
                //     $font->file("fonts/KaushanScript-Regular.ttf");
                //     $font->size(36);
                //     $font->color('#000' /*$color*/);
                //     $font->align('center');
                //     $font->valign('middle');
                //     $font->angle(0);
                // });

                //Write Name
                $myDP->text($user['text'], $user['x'], $user['y'], function ($font) use ($color) {
                    $font->file(FONT_PATH . "KaushanScript-Regular.ttf");
                    $font->size(34);
                    $font->color($color);
                    $font->align('center');
                    $font->valign('middle');
                    $font->angle(0);
                });

                //Write Location
                $myDP->text($dist['text'], $dist['x'], $dist['y'], function ($font) use ($color) {
                    $font->file(FONT_PATH . "Raleway-ExtraBold.ttf");
                    $font->size(15);
                    $font->color($color);
                    $font->align('center');
                    $font->valign('middle');
                    $font->angle(0);
                });

                //Add Image
                $myDP->insert($image, 'top-left', 385, 202); // x, y
                $quality  = $request->quality ?? 70;
                $myDP->save($cachePath, $quality, 'jpg');
                // dump($myDP->dirname);
                // dump($myDP->basename);
                // dd($myDP);

                // print "<img src='$myDP->dirname/$myDP->basename' >";

                return redirect()->back()->with('myDPfile', $myDP->basename);
                return view('pages.dp-download');
            } catch (\Exception $e) {
                dd($e);
                return redirect()->back()->with(['error'=> 'Error Generating DP, please try again']);
            }

        }
    }
}
