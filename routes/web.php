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

Route::get('/', function () {
    return view('landing_page');
});

Route::get('/idea/start', 'IdeaController@start')->name('idea.start');

Route::get('/welcome', function () {
    return view('landing_page');
});

Route::group([], function () {
    Route::post('/idea/like/', 'IdeaController@like')->name('idea.like');
    Route::post('/idea/skip/', 'IdeaController@skip')->name('idea.skip');
    Route::get('/idea/next', 'IdeaController@next')->name('idea.next');
    Route::get('/idea/more', 'IdeaController@wantMore')->name('idea.more');
    Route::get('/idea/funfact', 'IdeaController@funFact')->name('idea.funfact');
    Route::get('/idea/checkpoint', 'IdeaController@needLogin')->name('idea.needlogin');
    Route::get('/idea/try', 'IdeaController@trySubmit')->name('idea.try');
    Route::get('/idea/{id}', 'IdeaController@show')->name('idea.show');
});

Route::get('/admin/bismillah100x', 'AdminController@dashboard')->name('admin.dashboard');
Route::get('/updateidea/{id}', 'AdminController@editIdea')->name('admin.updateidea');
Route::get('/deleteidea/{id}', 'AdminController@deleteIdea')->name('admin.deleteidea');
Route::post('/admin/ideaedit', 'AdminController@updateIdea')->name('update.idea');
Route::post('/admin/ideastore', 'IdeaController@store')->name('admin.ideastore');
Route::get('/admin/infoboard', 'AdminController@infoBoard')->name('admin.infoboard');

/* Social Auth */
Route::get('/redirect', 'SocialAuthController@redirect')->name('social.redirect');
Route::get('/callback', 'SocialAuthController@callback')->name('social.callback');
Route::post('import', 'AdminController@import')->name('idea.import');


/* For Experiment Purpose */
Route::get('/test', function () {
    $userActions = \App\UserAction::where('user_id', 1)->get();
    $ideas = [];
    return \App\Idea::whereNotIn('id', $ideas)->orderBy('viewed')->inRandomOrder()->first();
    return $ideas;
});

Route::get('/forcelogout', function () {
    Auth::logout();
});

Route::get('/cookie/set', 'TestController@setCookie');
Route::get('/cookie/get', 'TestController@getCookie')->name('cookie.get');
Route::get('/cookie/clear', 'TestController@clearCookie');

//User
Route::get('/user/ideaedit', 'UserController@editIdea')->name('user.ideaedit');
Route::post('/user/ideastore', 'UserController@storeIdea')->name('user.ideastore');