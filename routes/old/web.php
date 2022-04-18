<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ContinentController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProgramController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', [IndexController::class, 'index']);
Route::get('/register/{slug}', [IndexController::class, 'index'])->name("home");

Route::prefix('admin')->middleware("auth")->group(function () {
    Route::resource('/programs', ProgramController::class);
    Route::get('/programs/toggle/{program}', [ProgramController::class, 'toggleProgramStatus'])->name('programs.toggle');
    Route::get('/registration-data', [IndexController::class, 'registrationData'])->name('admin.registration-data');
    Route::get('/registration-data/{program}/{slug?}', [IndexController::class, 'programRegistrationData'])->name('programs.registration-data');
    Route::get('/countries', [IndexController::class, 'countries'])->name('admin.countries');
    Route::get('/country/{id}/states', [IndexController::class, 'states'])->name('admin.states')->whereNumber('id');
    Route::get('/state/{id}/regions', [IndexController::class, 'regions'])->name('admin.regions')->whereNumber('id');
    Route::get('/region/{id}/groups', [IndexController::class, 'groups'])->name('admin.groups')->whereNumber('id');
    
    Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegister'])->name('admin.auth.register');
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'handleRegister'])->name('admin.handleRegister');


    Route::resource('/countries', CountryController::class);
    Route::resource('/continents', ContinentController::class);
    Route::resource('/states', StateController::class);
    Route::resource('/regions', RegionController::class);
    Route::resource('/groups', GroupController::class);
});


// Route::get('/debug', function () {
//     return dd(Auth::routes());
// });

Auth::routes([

    'register' => false, // Register Routes...
  
    'reset' => false, // Reset Password Routes...
  
    'verify' => false, // Email Verification Routes...
  
  ]);

// Route::get('/admin/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('admin.login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin');
