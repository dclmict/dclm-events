<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Continent;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::latest()->paginate(5);

        return view('admin.countries.index', compact('countries'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $continents = Continent::get(['id', 'name'])->all();

        return view('admin.countries.create', compact('continents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'continent_id' => 'required|integer',
        ]);

        Country::create($request->all());

        return redirect()->route('countries.index')
                        ->with('success', 'Country created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        // $country = Country::get()->with('continent:name')->all();
        return view('admin.countries.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {

        // $countryData = Country::where('id', $country)->with('continent')->get(['id', 'name']);
        // dd($country);
        // dd($countryData);

        $continents = Continent::get(['id', 'name'])->all();

        return view('admin.countries.edit', compact('country', 'continents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => 'required|string',
            'continent_id' => 'required|integer',
        ]);

        $country->update($request->all());

        return redirect()->route('countries.index')
                        ->with('success', 'Country updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()->route('countries.index')
                        ->with('success', 'Country deleted successfully');
    }
}
