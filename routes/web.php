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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

/*
|--------------------------------------------------------------------------
| Recipe Routes
|--------------------------------------------------------------------------
*/

Route::get('/recipes', 'RecipesController@index');
Route::get('/recipes/create', 'RecipesController@create');
Route::post('/recipes', 'RecipesController@store');

Route::get('/recipes/{recipe}', 'RecipesController@show');
Route::get('/recipes/{recipe}/edit', 'RecipesController@edit');
Route::put('/recipes/{recipe}', 'RecipesController@update');

/*
|--------------------------------------------------------------------------
| Ingredient Routes
|--------------------------------------------------------------------------
*/
Route::delete('/ingredients/{ingredient}', 'IngredientsController@delete');
Route::post('/ingredients', 'IngredientsController@store');
Route::put('/ingredients/{ingredient}', 'IngredientsController@update');
