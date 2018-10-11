<?php
Route::get('/test','ProductosController@ProductosBusqueda' );
/** LOGIN */
/*-----------------*/
Route::get('login'  , 'LoginController@ShowLogin')->name('login.show');
Route::post('login' , 'LoginController@PostLogin')->name('login');
Route::get('logout' , 'LoginController@getLogOut')->name('cerrar-sistema');
/** PASSWORD RESET */
/*-----------------*/
Route::get('reset-password'           , 'LoginController@PasswordRememberShowForm')->name('password.reset.show.form');
Route::post('reset-password'          , 'LoginController@PasswordResetSendMail')->name('reset-password');
Route::get('update-password/{token}'  , 'LoginController@UpdatePasswordShowForm')->name('update-password');
Route::post('update-password'         , 'LoginController@UpdatePassword')->name('update-password');
