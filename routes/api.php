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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/register','AuthController@register');
Route::post('/auth/login','AuthController@login');
Route::post('/income/add','IncomeController@add')->middleware('auth:api');
Route::get('/income/show','IncomeController@show')->middleware('auth:api');
Route::put('/income/{income}','IncomeController@update')->middleware('auth:api');
Route::delete('/income/{income}', 'IncomeController@delete')->middleware('auth:api');
Route::get('/profile','UserController@profile')->middleware('auth:api');