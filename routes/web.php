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

<<<<<<< Updated upstream
use App\Events\TestEvent;

Route::get('/', function () {
    event(new TestEvent());
});
=======
Route::get('/app/{vue_capture?}', function () {
    return view('index');
})->where('vue_capture', '[\/\w\.-]*');
>>>>>>> Stashed changes

Auth::routes();
