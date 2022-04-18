<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Program;
use App\Models\RegistrationData;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //

    public function index($slug)
    {
        $program = Program::where('slug', $slug)->where('is_active', true)->firstOrFail();
        

        $countries = Country::get(['id', 'name'])->all();
        // dd($program);
        return view('index', compact('program', 'countries'));
    }

    public function registrationData()
    {
        //    ->with('program', 'country', 'state', 'region', 'group')
        $allData = RegistrationData::with('program', 'country')->get();

        // $newData = RegistrationData::with('program', 'country')->where('new_comer', 'Yes')->get();

        // dd($programs);
        return view('admin.data', compact('allData'));
    }


    public function programRegistrationData($program)
    {
        //    ->with('program', 'country', 'state', 'region', 'group')
        $allData = RegistrationData::with('program', 'country')->where("program_id", $program)->get();
        // dd($programs);
        return view('admin.data', compact('allData'));
    }

    public function countries()
    {
        //    ->with('program', 'country', 'state', 'region', 'group')
        $countries = Country::all();
        // dd($programs);
        return view('admin.countries', compact('countries'));
    }
    
}
