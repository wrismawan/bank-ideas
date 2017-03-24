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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();


Route::get('/', function (){
    return redirect()->route('idea.show',[1]);
})->name('ten_idea');


Route::get('/idea/{id}', 'IdeaController@show')->name('idea.show');
Route::post('/idea/store', 'IdeaController@store')->name('idea.store');
Route::post('/idea/like/', 'IdeaController@like')->name('idea.like');
Route::post('/idea/skip/', 'IdeaController@skip')->name('idea.skip');

Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');

Route::get('login', 'LoginController@showLoginPage')->name('login');
Route::get('polling', 'LoginController@showIdea')->middleware(['auth'])->name('polling');
Route::get('logout', 'LoginController@logout')->name('log-out');
Route::get('login/{provider}', 'LoginController@auth')
    ->where(['provider' => 'facebook']);
Route::get('login/{provider}/callback', 'LoginController@login')
    ->where(['provider' => 'facebook']);