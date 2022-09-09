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

/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';*/

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){

    // Admin Login Route
    Route::match(['get','post'],'login','AdminController@login');

    Route::group(['middleware'=>['admin']],function(){
        // Admin Logout
        Route::get('logout','AdminController@logout');

        // Messages Route
        Route::get('messages','MessagesController@messages');
        Route::get('messages/message/{id}','MessagesController@viewMessages');
        Route::post('messages/update-message-status','MessagesController@updateMessageStatus');
        Route::get('messages/delete-message/{id}','MessagesController@deleteMessage');

        // Dashboard Route
        Route::get('dashboard', 'AdminController@dashboard');

        // News Route
        Route::get('news','NewsController@news');
        Route::match(['get','post'], 'news/add-news', 'NewsController@addNews');
        Route::match(['get','post'], 'news/add-news-images', 'NewsController@addNewsImages');
        Route::get('news/skip-news/{id}','NewsController@skipNews');
        Route::post('news/update-news-status','NewsController@updateNewsStatus');
        Route::get('news/delete-news/{id}','NewsController@deleteNews');
        Route::match(['get','post'], 'news/edit-news/{id}','NewsController@editNews');
        Route::get('news/delete-news-title-image/{id}','NewsController@deleteNewsTitleImage');
        Route::match(['get','post'], 'news/edit-news-images/{id}','NewsController@editNewsImages');
        Route::get('news/delete-news-image/{id}','NewsController@deleteNewsImage');
        Route::post('news/update-news-image-status','NewsController@updateNewsImageStatus');

        // Parohije Route
        Route::get('parohije','ParohijeController@parohije');
        Route::match(['get','post'], 'parohije/parohija/{id}', 'ParohijeController@editParohija');

        // Ljetopis Route
        Route::match(['get','post'], 'ljetopis', 'LjetopisController@ljetopis');

        // Admin Route
        Route::get('admins', 'AdminController@admins');
        Route::match(['get','post'], 'admins/add-admin', 'AdminController@addAdmin');
        Route::match(['get','post'], 'admins/admin/{id}', 'AdminController@editAdmin');
        Route::get('admins/delete-admin/{id}','AdminController@deleteAdmin');
        
        // Settings Route
        Route::match(['get','post'], 'settings', 'AdminController@settings');
        Route::get('settings/delete-hero/{id}','AdminController@deleteHero');
        Route::get('settings/set-hero/{id}','AdminController@setHero');
        Route::get('settings/set-hero/{id}','AdminController@setHero');
        Route::match(['get','post'], 'settings/mitropolit/{id}','AdminController@mitropolit');

        // CKEditor5 Route
        Route::post('/upload','EditorController@uploadImage')->name('ckeditor.upload');
    });
   
});

Route::namespace('App\Http\Controllers\Front')->group(function(){
    // Početna Route
    Route::match(['get','post'], '/', 'FrontController@index');

    // Mitropolit Route
    Route::get('mitropolit', 'FrontController@mitropolit');

    // Novosti Route
    Route::get('novosti', 'FrontController@news');
    Route::get('novosti/vijest/{id}', 'FrontController@post');

    // Bogosluženja

    // Parohije Route
    Route::get('parohije', 'FrontController@parohije');
    Route::get('parohije/parohija/{id}', 'FrontController@parohija');

    // Galerija Route

    // Ljetopis Route
    Route::get('ljetopis', 'FrontController@ljetopis');

});


