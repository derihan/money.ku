<?php

// akses Cors importan !

header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

// end cors

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
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/income/add','IncomeController@add');
    Route::get('/income/show','IncomeController@show');
    Route::put('/income/{income}','IncomeController@update');
    Route::delete('/income/{income}', 'IncomeController@delete');
    Route::get('/profile','UserController@profile');
    Route::post('/expense/add','ExpenseController@add');
    Route::get('/expense/show','ExpenseController@show');
    Route::put('/expense/{expense}','ExpenseController@update');
    Route::delete('/expense/{expense}','ExpenseController@delete');
    Route::get('/expense/{expense}','ExpenseController@showByid');
    Route::get('/income/{income}','IncomeController@showByid');
});


// Route::post('/income/add','IncomeController@add')->middleware('auth:api');
// Route::get('/income/show','IncomeController@show')->middleware('auth:api');
// Route::put('/income/{income}','IncomeController@update')->middleware('auth:api');
// Route::delete('/income/{income}', 'IncomeController@delete')->middleware('auth:api');
// Route::get('/profile','UserController@profile')->middleware('auth:api');

