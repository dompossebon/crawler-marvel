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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/comicsCrawler', 'CrawlerMarvelController@comicsCrawler')->name('comicsCrawler');

Route::get('/multiOption/{option}', 'CrawlerMarvelController@multiOption')->name('multiOption');
Route::get('/detailOption/{id}/{option}', 'CrawlerMarvelController@detailOption')->name('detailOption');
