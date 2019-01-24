<?php
//
//  1118180



//Route::get('/test','CarteraController@ClientesFacturasPdtePago' );
/** LOGIN */
/*-----------------*/
Route::get('login'  , 'LoginController@ShowLogin')->name('login.show');
Route::post('login' , 'LoginController@PostLogin')->name('login');
Route::get('logout' , 'LoginController@getLogOut')->name('logout');

/** PASSWORD RESET */
/*-----------------*/
Route::get('reset-password'           , 'LoginController@PasswordRememberShowForm')->name('password.reset.show.form');
Route::post('reset-password'          , 'LoginController@PasswordResetSendMail')->name('reset-password');
Route::get('update-password/{token}'  , 'LoginController@UpdatePasswordShowForm')->name('update-password');
Route::post('update-password'         , 'LoginController@UpdatePassword')->name('update-password');


Route::middleware(['VerifyUserRequestJson'])->group(function () {
   Route::resource('/cargos'        , 'MstroCargosController'             ,['except'=>'edit','create', 'show'] );
   // Route::resource('/medidas'       , 'MstroUndsMedidaController'         ,['except'=>'edit','create', 'show'] );
   // Route::resource('/lineas'        , 'MstroLineasController'             ,['except'=>'edit','create', 'show'] );
   // Route::delete('/sublineas-destroy/{idsub}/{idline}'     , 'MstroLineasController@SubLineasBorrarAsocc',
   //                                                                         ['except'=>'edit','create', 'show'] );
   // Route::resource('/sublineas'     , 'MstroLineasSubLineasController'    ,['except'=>'edit','create', 'show'] );
   // Route::get('/sublineas-show'     , 'MstroLineasSubLineasController@ConsultaSubLineas');

    Route::get('/clientes/buscar'                     , 'TercerosController@ClientesBusqueda'                      );
    Route::get('/clientes/vendedores'                 , 'TercerosController@ClientesVendedorPrincipal'             );
    Route::get('/clientes/compras'                    , 'TercerosController@ClientesProductosComprados'            );
    Route::get('/terceros/notas/ventas'               , 'TercerosController@NotasVenta'                            );
    Route::get('/terceros/notas/cartera'              , 'TercerosController@NotasCartera'                          );
    Route::get('/terceros/contactos'                  , 'TercerosController@Contactos'                             );

    Route::get('/terceros/clientes/cartera'           , 'CarteraController@ClientesFacturasPdtePago'               );
    Route::post('/pedidos/grabar'                      ,'PedidosController@Grabar'            );
   // Route::get('/pedido/dias/financiacion'                      ,'PedidosController@DiasFinanciacion'            );
});
//Route::get('/{any?}'             , 'DashBoardController@Index')->name('dashboad')->where('any','.*');
Route::middleware(['AppPreventBackHistory'])->group( function(){
    Route::get ('/{any?}'             , 'DashBoardController@Index')->name('dashboad')->where('any','.*');
});


