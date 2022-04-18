<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationDataRequest;
use App\Http\Requests\GeoRequest;
use App\Models\Country;
use App\Models\RegistrationData;
use App\Models\Program;
use App\Traits\ApiResponse;

// use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    use ApiResponse;

    public function getCountries()
    {
        $countries = [
            'countries' => Country::with('states', 'regions')->get()->all()
        ];
        return $this->success($countries, 'Success', 200);
    }

    public function getCountryById(Country $country)
    {
        return $this->success($country->with('states')->get(), 'Success', 200);
    }


    public function processRegistrationForm(RegistrationDataRequest $request)
    {
        $validateData = $request->post();
        // $searchPhone = RegistrationData::where('phone_number', $validateData["phone_number"])->where('program_id', $validateData["program_id"])->get();
        // if ($searchPhone->count() > 0) {
        //     return $this->error("Error", 200, [
        //                 "phone_number" => "Sorry, You can't use the same number to register for a program twice."
        //             ]);
        // }

        // $searchName = RegistrationData::where('fullname', $validateData["fullname"])->where('program_id', $validateData["program_id"])->get();
        // if ($searchName->count() > 0) {
        //     return $this->error("Error", 200, [
        //                 "fullname" => "Sorry, You can't register for a program twice."
        //             ]);
        // }

        if (empty($validateData['country_id'])) {
            return $this->error("Error", 200, [
                        "country_id" => "Please select your country"
                    ]);
        }


//        if (empty($validateData['new_comer'])) {
//            $errors['new_comer'] = 'Please answer the "Are you a new comer?" question';
//        }

        try {

            $regData = new RegistrationData();
            $regData->fullname = $validateData["fullname"];
            $regData->email = $validateData["email"];
            $regData->gender = $validateData["gender"];
            $regData->phone_number = $validateData["phone_number"];
            $regData->whatsapp_number = $validateData["whatsapp_number"];
            // $regData->address = $validateData["address"];
            // $regData->age = $validateData["age"];
            // $regData->facebook_username = $validateData["facebook_username"];
            // $regData->new_comer = $validateData["new_comer"];
            $regData->program_id = $validateData["program_id"];
            $regData->country_id = $validateData["country_id"];
            $regData->state = $validateData["state"];
            $regData->lga = $validateData["lga"];

            // $regData->bus_stop = $validateData["bus_stop"];
            // $regData->church = $validateData["church"];
            // $regData->location_church = $validateData["location_church"];
            // $regData->region_id = $validateData["region_id"];
            // $regData->group_id = $validateData["group_id"];
            // $regData->fullname = $validateData["fullname"];
            // $regData->church_member = $validateData["church_member"];

            $regData->save();
            return $this->success("Registration Successful", "Success");

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), "Error");
        }


    }

    public function createCountry(GeoRequest $request)
    {
        $reqData = $request->post();
        $model = new Country();
        $model->country = $reqData["name"];
        $model->save();
        $model->status = "Success";
        return $this->success($model, "Data Creation Successful");
    }


    public function createProgram($name)
    {
        $model = new Program();
        $model->name = $name;
        $model->save();
        $model->status = "Success";
        return $this->success($model, "Program Created Successfully");
    }

    public function toggleProgram(Program $program)
    {
        $program->update(
            [
                "is_ative" => $program->is_active
            ]
        );
        $program->status = "Success";
        return $this->success($program, "Program Created Successfully");
    }
}
