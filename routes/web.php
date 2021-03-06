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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('layout.home');
// });

Route::get('{path}', 'HomeController@index')->where( 'path', '[A-z]([0-9a-z_.]+)?' );

Route::post('/createid', 'IdController@store');
Route::post('/updateid', 'IdController@update');
Route::delete('/deleteid/{id}', 'IdController@delete');
