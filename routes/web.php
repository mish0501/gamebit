<?php

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
use App\Notifications\InviteFriendNotification;

Route::get('/', function () {
    return view('index');
});

Route::get('/app/{vue_capture?}', function () {
    return view('index');
})->where('vue_capture', '[\/\w\.-]*');

Auth::routes();
