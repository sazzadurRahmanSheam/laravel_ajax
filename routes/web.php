<?php

Route::get('/','StudentController@index');
Route::post('/student/store','StudentController@store');
Route::get('/student/show','StudentController@getData');
Route::get('/student/delete/{id}','StudentController@destroy');
Route::get('/student/edit/{id}','StudentController@edit');


