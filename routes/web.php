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

Route::get('/', [
    'uses' => 'SetController@getRecents',
    'as' => 'pages.dashboard'
]); 

Route::get('/my-sets', [
    'uses' => 'SetController@getMySets',
    'as' => 'pages.my-sets'
]); 


Route::get('/logout', [
    'uses' => 'SetController@logout',
]); 


Route::get('/create', function () {
    return view('pages.set-editor');
})->name("pages.set-editor");

Route::post('/potato', [
    'uses' => 'SetController@validateSet',
    'as' => 'potato.me'
]); 

Route::get('/study', [
    'uses' => 'FlashcardController@listFlashcards',
    'as' => 'pages.viewer'
]); 

Route::get('/cards-editor', function () {
    return view('pages.cards-editor');
})->name("pages.cards-editor");

Route::get('/profile', function () {
    return view('pages.profile');
})->name("pages.profile");

Route::get('/search', function () {
    return view('pages.search');
})->name("pages.search");

