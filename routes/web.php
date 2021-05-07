<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Backend'], function () {
    Route::resource('/ringtones', 'RingtoneController');
    Route::resource('/photos', 'PhotoController');
});

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', 'RingtoneController@index')->name('ringtones');
    Route::get('/ringtones/{id}/{slug}', 'RingtoneController@show')->name('ringtones.show');
    Route::post('/ringtones/download/{id}', 'RingtoneController@downloadRingtone')->name('ringtones.download');
    Route::get('/category/{id}', 'RingtoneController@category')->name('ringtones.category');
    Route::get('/wallpapers', 'PhotoController@index')->name('wallpapers.index');
    Route::post('photos/download1/{id}', 'PhotoController@downloadPhoto800x600')->name('photos.download1');

    Route::post('photos/download2/{id}', 'PhotoController@downloadPhoto1280x1024')->name('photos.download2');

    Route::post('photos/download3/{id}', 'PhotoController@downloadPhoto316x255')->name('photos.download3');
    Route::post('photos/download4/{id}', 'PhotoController@downloadPhoto118x95')->name('photos.download4');
});
