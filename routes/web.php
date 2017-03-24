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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::post('/idea/store', 'IdeaController@store')->name('idea.store');
    Route::post('/idea/like/', 'IdeaController@like')->name('idea.like');
    Route::post('/idea/skip/', 'IdeaController@skip')->name('idea.skip');
    Route::get('/idea/next', 'IdeaController@next')->name('idea.next');
    Route::get('/idea/{id}', 'IdeaController@show')->name('idea.show');
});

Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');

/* Social Auth */
Route::get('/redirect', 'SocialAuthController@redirect')->name('social.redirect');
Route::get('/callback', 'SocialAuthController@callback')->name('social.callback');
Route::post('import', 'AdminController@import');

