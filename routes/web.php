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

Route::get('/comicsApi', 'CrawlerMarvelController@comicsApi')->name('comicsApi');
Route::get('/comicApi/{id}', 'CrawlerMarvelController@comicApi')->name('comicApi');

Route::get('/charactersApi', 'CrawlerMarvelController@charactersApi')->name('charactersApi');
Route::get('/characterApi/{id}', 'CrawlerMarvelController@characterApi')->name('character');

Route::get('/eventsApi', 'CrawlerMarvelController@eventsApi')->name('eventsApi');
Route::get('/eventApi/{id}', 'CrawlerMarvelController@eventApi')->name('eventApi');

Route::get('/seriesApi', 'CrawlerMarvelController@seriesApi')->name('seriesApi');
Route::get('/serieApi/{id}', 'CrawlerMarvelController@serieApi')->name('serieApi');

Route::get('/storiesApi', 'CrawlerMarvelController@storiesApi')->name('storiesApi');
Route::get('/storieApi/{id}', 'CrawlerMarvelController@storieApi')->name('storieApi');


Route::get('/multiOption/{option}', 'CrawlerMarvelController@multiOption')->name('multiOption');
