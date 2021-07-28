<?php

use App\Models\Meeting;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeetingController;

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
    return view('content');
});
Route::get('/welcome', function(){
    return view('welcome');
});
Route::apiResource('meetings',MeetingController::class);

Route::get('/test', function(){
    $test = Meeting::with('schedule')->get();
    dd($test->toJson());
});