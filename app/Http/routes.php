<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//    Auth::loginUsingId(2);
    // Authentication routes...
    Route::get('auth/login', 'Auth\AuthController@getLogin');
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logout', 'Auth\AuthController@getLogout');

    // Registration routes...
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::post('auth/register', 'Auth\AuthController@postRegister');
    //
    //
    // Password reset link request routes...
    Route::get('password/email', 'Auth\PasswordController@getEmail');
    Route::post('password/email', 'Auth\PasswordController@postEmail');

    // Password reset routes...
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset', 'Auth\PasswordController@postReset');


    Route::group(['middleware' => 'auth'], function () { // 'middleware' => ['auth', 'roles'],'roles' => ['administrator', 'manager']    Only an administrator, or a manager can access this route
        Route::get('/', 'DashboardController@index');
        Route::resource('tournaments', 'TournamentController');
        Route::resource('competitors', 'CompetitorController');
        Route::resource('grade', 'GradeController');
        Route::resource('users', 'UserController');
        Route::resource('country', 'CountryController');
        Route::resource('places', 'PlaceController');
    });


//Route::resource('shinpan', 'ShinpanController');
//Route::resource('clubs', 'ClubController');
//Route::resource('fight', 'FightController');
//Route::resource('team', 'TeamController');
//Route::resource('shiaicategory', 'ShiaiCategoryController');
//Route::resource('associations', 'AssociationController');
//Route::resource('federations', 'FederationController');
