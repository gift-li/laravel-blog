<?php

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
// route('partials.index') need fix
Route::get('/', function () {
    return view('partials.index');
});
Route::resource('/post', 'PostController');
Route::resource('/user', 'UserController');

Route::group(['middleware' => ['guest']], function () {
    Route::get('/signup', [
        'uses' => 'UserController@getSignup',
        'as' => 'user.signup'
    ]);
    Route::post('/signup', [
        'uses' => 'UserController@postSignup',
        'as' => 'user.signup'
    ]);
    Route::get('/signin', [
        'uses' => 'UserController@getSignin',
        'as' => 'user.signin'
    ]);
    Route::post('/signin', [
        'uses' => 'UserController@postSignin',
        'as' => 'user.signin'
    ]);
    Route::get('/suspend', [
        'uses' => 'UserController@postSignin',
        'as' => 'user.signin'
    ]);
    Route::get('/logout', [
        'uses' => 'UserController@logout',
        'as' => 'user.logout'
    ]);
});
// Route::group(['middleware' => ['auth']], function () {
//     Route::get('/profile', [
//         'uses' => 'UserController@getProfile',
//         'as' => 'user.profile'
//     ]);

//     Route::get('/logout', [
//         'uses' => 'UserController@getLogout',
//         'as' => 'user.logout'
//     ]);
// });