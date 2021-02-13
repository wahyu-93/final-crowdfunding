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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'middleware'=> 'api',
    'prefix'    => 'auth',
],function(){
    Route::post('/register', 'LoginController@register');
    Route::post('/verification', 'LoginController@verification');
    Route::post('/generate-otp', 'LoginController@generateOtp');
    Route::post('/update-password', 'LoginController@updatePassword');
    Route::post('/login', 'LoginController@login');
    Route::post('/logout','LoginController@logout')->middleware('auth:api');
    Route::post('/check-token','LoginController@checkToken');

    Route::get('/social/{provider}', 'SocialiteController@redirectToProvider');
    Route::get('/social/{provider}/callback', 'SocialiteController@handleProviderCallback');
});

Route::middleware('auth:api')->group(function(){
    Route::get('profile/get-profile', 'ProfileController@getProfile');
    Route::post('profile/update-profile', 'ProfileController@updateProfile');

});

Route::group([
    'middleware'    => 'api',
    'prefix'        => 'campaign',
], function(){
    Route::get('random/{count}', 'CampaignController@random');
    Route::post('store', 'CampaignController@store');
    Route::get('/', 'CampaignController@index');
    Route::get('/{id}', 'CampaignController@detail');
    Route::get('/search/{keyword}', 'CampaignController@search');
});

Route::group([
    'middleware'    => 'api',
    'prefix'        => 'blog',
], function(){
    Route::get('random/{count}', 'BlogController@random');
    Route::post('store', 'BlogController@store');
});