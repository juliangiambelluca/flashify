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



Route::post('/create-set', [
    'uses' => 'SetController@createSet',
    'as' => 'create.set'
]); 

Route::post('/create-cards', [
    'uses' => 'FlashcardController@createCards',
    'as' => 'create.cards'
]); 

Route::post('/delete-card', [
    'uses' => 'FlashcardController@deleteCard',
    'as' => 'delete.card'
]); 

Route::get('/study', [
    'uses' => 'FlashcardController@listFlashcards',
    'as' => 'pages.viewer'
]); 

Route::get('/cards-editor', function () {
    return view('pages.cards-editor');
})->name("pages.cards-editor");

Route::get('/editor/{setID?}', [
    'uses' => 'SetController@prepEditor',
    'as' => 'pages.editor'
]); 


Route::get('/set-editor', function () {
    return view('pages.set-editor');
})->name("pages.set-editor");

Route::get('/profile', function () {
    return view('pages.profile');
})->name("pages.profile");

Route::get('/search', function () {
    return view('pages.search');
})->name("pages.search");

