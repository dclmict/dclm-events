<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DpmakerFormRequest;
use Illuminate\Support\Facades\Validator;


class DpMakerController extends Controller
{
    public function index(Request $request) {
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
            // dd($request->all());
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




        }
    }
}
