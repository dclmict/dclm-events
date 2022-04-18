<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get-countries', [ApiController::class, 'getCountries']);
Route::get('/get-states', [ApiController::class, 'getStates']);
Route::get('/get-regions', [ApiController::class, 'getRegions']);
Route::get('/get-groups', [ApiController::class, 'getGroups']);

Route::get('/get-country/{country}', [ApiController::class, 'getCountryById']);
Route::get('/get-state/{state}', [ApiController::class, 'getStateById']);
Route::get('/get-region/{region}', [ApiController::class, 'getRegionById']);
Route::get('/get-group/{group}', [ApiController::class, 'getGroupById']);

Route::post('/create-country', [ApiController::class, 'createCountry']);
Route::post('/create-state/{foreign_key}', [ApiController::class, 'createState'])->whereNumber('foreign_key');
Route::post('/create-region/{foreign_key}', [ApiController::class, 'createGroup'])->whereNumber('foreign_key');
Route::post('/create-group/{foreign_key}', [ApiController::class, 'createRegion'])->whereNumber('foreign_key');

Route::post('/process-registration-form', [ApiController::class, 'processRegistrationForm']);
