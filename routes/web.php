<?php
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome'); 
});
// Route::get('/',[StudentController::class,'index']);


Route::get("home",[HomeController::class,'index']);
Route::get('country-state',[CountryController::class, 'getState'])->name('country-state'); 
Route::resource("country",CountryController::class);
Route::resource("state",StateController::class);
Route::resource("city",CityController::class);
// Route::get("trash",'StudentController@trash')->name("trash");
Route::resource("student",StudentController::class);
 