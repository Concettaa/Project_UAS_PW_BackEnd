<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');

Route::get('email/verify/{id}', 'Api\VerificationController@verify')->name('verificationapi.verify');
Route::get('email/resend', 'Api\VerificationController@resend')->name('verificationapi.resend');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('buku', 'Api\BukuController@index');
    Route::get('buku/{id}', 'Api\BukuController@show');
    Route::post('buku', 'Api\BukuController@store');
    Route::put('buku/{id}', 'Api\BukuController@update');
    Route::delete('buku/{id}', 'Api\BukuController@destroy');

    Route::get('artikel', 'Api\ArtikelController@index');
    Route::get('artikel/{id}', 'Api\ArtikelController@show');
    Route::post('artikel', 'Api\ArtikelController@store');
    Route::put('artikel/{id}', 'Api\ArtikelController@update');
    Route::delete('artikel/{id}', 'Api\ArtikelController@destroy');

    Route::get('review', 'Api\ReviewController@index');
    Route::get('review/{id}', 'Api\ReviewController@show');
    Route::post('review', 'Api\ReviewController@store');
    Route::put('review/{id}', 'Api\ReviewController@update');
    Route::delete('review/{id}', 'Api\ReviewController@destroy');

    Route::get('user', 'Api\UserController@index');
    Route::get('user/{id}', 'Api\UserController@show');
    Route::post('user', 'Api\UserController@store');
    Route::put('user/{id}', 'Api\UserController@update');
    Route::delete('user/{id}', 'Api\UserController@destroy');
});
