<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            dd($request->all());
        }
    }
}
