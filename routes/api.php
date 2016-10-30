<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'game'], function() {
  Route::post('/', 'GameController@getGame');
  Route::post('/all', 'GameController@getGames');
});

Route::group(['middleware' => 'auth:api'], function() {
  Route::group(['prefix' => '/user'], function() {
    Route::get('/', 'UserController@getAuthUser');
    Route::post('/notifications', 'UserController@getUserNotifications');
  });

  Route::group(['prefix' => 'room'], function() {
    Route::post('/', 'RoomManagerController@createRoom');
    Route::put('/join', 'RoomManagerController@joinRoom');
  });

  Route::group(['prefix' => 'friendship'], function() {
    Route::post('/', 'FriendshipController@searchFriend');
    Route::post('/all', 'FriendshipController@getAllFriends');
    Route::post('/request', 'FriendshipController@getFriendRequests');
    Route::put('/accept', 'FriendshipController@acceptFriendRequest');
    Route::put('/deny', 'FriendshipController@denyFriendRequest');
  });
});
