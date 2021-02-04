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
Route::get('/', [
    'uses' => 'WebController@index',
    'as' => 'web.index'
]);

Route::group(['middleware' => ['guest']], function () {
    Route::get('/signup', [
        'uses' => 'WebController@getSignup',
        'as' => 'web.signup'
    ]);

    Route::post('/signup', [
        'uses' => 'WebController@postSignup',
        'as' => 'web.signup'
    ]);

    Route::get('/signin', [
        'uses' => 'WebController@getSignin',
        'as' => 'web.signin'
    ]);

    Route::post('/signin', [
        'uses' => 'WebController@postSignin',
        'as' => 'web.signin'
    ]);
});
Route::group(['middleware' => ['auth']], function () {
    Route::resource('/post', 'PostController');
    
    Route::resource('/user', 'UserController');
    
    Route::post('/suspend', [
        'uses' => 'UserController@suspend',
        'as' => 'user.suspend'
    ]);
    Route::get('/restore', [
        'uses' => 'UserController@restore',
        'as' => 'user.restore'
    ]);
    Route::get('/logout', [
        'uses' => 'WebController@logout',
        'as' => 'web.logout'
    ]);
});
// Route::group(['middleware' => ['can:user']], function () {
//     Route::resource('/post', 'PostController');
    
//     Route::resource('/user', 'UserController');

//     Route::get('/logout', [
//         'uses' => 'WebController@logout',
//         'as' => 'web.logout'
//     ]);
// });