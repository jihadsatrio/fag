<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['namespace' => 'Admin'], function ()
{
    Route::get('/', ['as' => 'admin.login', 'uses' => 'AuthController@index']);
    Route::post('/submit', ['as' => 'admin.login.submit', 'uses' => 'AuthController@login']);
    Route::get('logout', ['as' => 'admin.logout', 'uses' => 'AuthController@logout']);

    Route::group(['middleware' => ['auth.admin'], 'prefix' => 'admin'], function ()
    {
        Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'SiteController@index']);

        // AJAX
        Route::get('ajax/user/email', ['as' => 'ajax.user.email', 'uses' => 'AjaxController@EmailUser']);
        Route::get('ajax/nahkoda/email', ['as' => 'ajax.nahkoda.email', 'uses' => 'AjaxController@EmailNahkoda']);
        Route::get('ajax/nahkoda/nidn', ['as' => 'ajax.nahkoda.nidn', 'uses' => 'AjaxController@NidnNahkoda']);
        Route::get('ajax/agen/name', ['as' => 'ajax.agen.name', 'uses' => 'AjaxController@NameAgen']);
        Route::get('ajax/agen/code', ['as' => 'ajax.agen.code', 'uses' => 'AjaxController@CodeAgen']);
        Route::get('ajax/kapal/name', ['as' => 'ajax.kapal.name', 'uses' => 'AjaxController@NameKapal']);
        Route::get('ajax/kapal/code', ['as' => 'ajax.kapal.code', 'uses' => 'AjaxController@CodeKapal']);
        Route::get('ajax/pembawakapal/agen', ['as' => 'ajax.pembawakapal.agen', 'uses' => 'AjaxController@PembawakapalKapal']);
        Route::get('replace', ['as' => 'ajax.kapal.DbReplacer', 'uses' => 'AjaxController@DbReplacer']);

        // User
        Route::get('users', ['as' => 'admin.user', 'uses' => 'UserController@index']);
        Route::get('users/create', ['as' => 'admin.user.create', 'uses' => 'UserController@create']);
        Route::post('users/create', ['as' => 'admin.user.store', 'uses' => 'UserController@store']);
        Route::get('users/edit/{id}', ['as' => 'admin.user.edit', 'uses' => 'UserController@edit']);
        Route::post('users/update/{id?}', ['as' => 'admin.user.update', 'uses' => 'UserController@update']);
        Route::delete('users/delete/{id}', ['as' => 'admin.user.delete', 'uses' => 'UserController@destroy']);

        //Day
        Route::get('days', ['as' => 'admin.days', 'uses' => 'DayController@index']);
        Route::get('days/create', ['as' => 'admin.day.create', 'uses' => 'DayController@create']);
        Route::post('days/create', ['as' => 'admin.day.store', 'uses' => 'DayController@store']);
        Route::get('days/edit/{id}', ['as' => 'admin.day.edit', 'uses' => 'DayController@edit']);
        Route::post('days/update/{id?}', ['as' => 'admin.day.update', 'uses' => 'DayController@update']);
        Route::delete('days/delete/{id}', ['as' => 'admin.day.delete', 'uses' => 'DayController@destroy']);

        //Time
        Route::get('times', ['as' => 'admin.times', 'uses' => 'TimeController@index']);
        Route::get('times/create', ['as' => 'admin.time.create', 'uses' => 'TimeController@create']);
        Route::post('times/create', ['as' => 'admin.time.store', 'uses' => 'TimeController@store']);
        Route::get('times/edit/{id}', ['as' => 'admin.time.edit', 'uses' => 'TimeController@edit']);
        Route::post('times/update/{id?}', ['as' => 'admin.time.update', 'uses' => 'TimeController@update']);
        Route::delete('times/delete/{id}', ['as' => 'admin.time.delete', 'uses' => 'TimeController@destroy']);

        //Nahkoda
        Route::get('nahkoda', ['as' => 'admin.nahkoda', 'uses' => 'NahkodaController@index']);
        Route::get('nahkoda/create', ['as' => 'admin.nahkoda.create', 'uses' => 'NahkodaController@create']);
        Route::post('nahkoda/create', ['as' => 'admin.nahkoda.tore', 'uses' => 'NahkodaController@store']);
        Route::get('nahkoda/edit/{id}', ['as' => 'admin.nahkoda.edit', 'uses' => 'NahkodaController@edit']);
        Route::post('nahkoda/update/{id?}', ['as' => 'admin.nahkoda.update', 'uses' => 'NahkodaController@update']);
        Route::delete('nahkoda/delete/{id}', ['as' => 'admin.nahkoda.delete', 'uses' => 'NahkodasController@destroy']);

        //Agen
        Route::get('agen', ['as' => 'admin.agen', 'uses' => 'AgenController@index']);
        Route::get('agen/create', ['as' => 'admin.agen.create', 'uses' => 'AgenController@create']);
        Route::post('agen/create', ['as' => 'admin.agen.store', 'uses' => 'AgenController@store']);
        Route::get('agen/edit/{id}', ['as' => 'admin.agen.edit', 'uses' => 'AgenController@edit']);
        Route::post('agen/update/{id?}', ['as' => 'admin.agen.update', 'uses' => 'AgenController@update']);
        Route::delete('agen/delete/{id}', ['as' => 'admin.agen.delete', 'uses' => 'AgenController@destroy']);

        //Kapal
        Route::get('kapal', ['as' => 'admin.kapal', 'uses' => 'KapalController@index']);
        Route::get('kapal/create', ['as' => 'admin.kapal.create', 'uses' => 'KapalController@create']);
        Route::post('kapal/create', ['as' => 'admin.kapal.store', 'uses' => 'KapalController@store']);
        Route::get('kapal/edit/{id}', ['as' => 'admin.kapal.edit', 'uses' => 'KapalController@edit']);
        Route::post('kapal/update/{id?}', ['as' => 'admin.kapal.update', 'uses' => 'KapalController@update']);
        Route::delete('kapal/delete/{id}', ['as' => 'admin.kapal.delete', 'uses' => 'KapalController@destroy']);

        //Pembawakapal
        Route::get('pembawakapal', ['as' => 'admin.pembawakapal', 'uses' => 'PembawakapalController@index']);
        Route::get('pembawakapal/create', ['as' => 'admin.pembawakapal.create', 'uses' => 'PembawakapalController@create']);
        Route::post('pembawakapal/create', ['as' => 'admin.pembawakapal.store', 'uses' => 'PembawakapalController@store']);
        Route::get('pembawakapal/edit/{id}', ['as' => 'admin.pembawakapal.edit', 'uses' => 'PembawakapalController@edit']);
        Route::post('pembawakapal/update/{id?}', ['as' => 'admin.pembawakapal.update', 'uses' => 'PembawakapalController@update']);
        Route::delete('pembawakapal/delete/{id}', ['as' => 'admin.pembawakapal.delete', 'uses' => 'PembawakapalController@destroy']);

        //TimesNotAvailable
        Route::get('timenotavailable', ['as' => 'admin.timenotavailables', 'uses' => 'TimenotavailableController@index']);
        Route::get('timenotavailable/create', ['as' => 'admin.timenotavailable.create', 'uses' => 'TimenotavailableController@create']);
        Route::post('timenotavailable/create', ['as' => 'admin.timenotavailable.store', 'uses' => 'TimenotavailableController@store']);
        Route::get('timenotavailable/edit/{id}', ['as' => 'admin.timenotavailable.edit', 'uses' => 'TimenotavailableController@edit']);
        Route::post('timenotavailable/update/{id?}', ['as' => 'admin.timenotavailable.update', 'uses' => 'TimenotavailableController@update']);
        Route::delete('timenotavailable/delete/{id}', ['as' => 'admin.timenotavailable.delete', 'uses' => 'TimenotavailableController@destroy']);

        //timedays
        Route::get('timedays', ['as' => 'admin.timedays', 'uses' => 'TimedayController@index']);
        Route::get('timedays/create', ['as' => 'admin.timeday.create', 'uses' => 'TimedayController@create']);
        Route::post('timedays/create', ['as' => 'admin.timeday.store', 'uses' => 'TimedayController@store']);
        Route::get('timedays/edit/{id}', ['as' => 'admin.timeday.edit', 'uses' => 'TimedayController@edit']);
        Route::post('timedays/update/{id?}', ['as' => 'admin.timeday.update', 'uses' => 'TimedayController@update']);
        Route::delete('timedays/delete/{id}', ['as' => 'admin.timeday.delete', 'uses' => 'TimedayController@destroy']);

        //generate
        Route::get('generates', ['as' => 'admin.generates', 'uses' => 'GenetikController@index']);
        Route::get('generates/submit', ['as' => 'admin.generates.submit', 'uses' => 'GenetikController@submit']);
        Route::get('generates/result/{id}', ['as' => 'admin.generates.result', 'uses' => 'GenetikController@result']);
        Route::get('generates/excel/{id}', ['as' => 'admin.generates.excel', 'uses' => 'GenetikController@excel']);

    });
});
