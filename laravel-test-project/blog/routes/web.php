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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test-1', function () {
    return response("<h1>Hello world!</h1>");
});


Route::get('/test-2/{id?}', function ($id = -1) {
    return  view("test-2",[
        'id' => $id,
        'name' => "Gipsz Jakab",
        "toIterate" => [
            [
                'domain' => "backend-1",
                'tech' => "php"
            ],
        ]
    ]);
});
