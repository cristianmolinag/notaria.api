<?php

Route::group(['prefix' => 'usuario'], function ($router) {
    Route::post('/login', 'UsuarioController@login');
    Route::get('/permisos', 'UsuarioController@getPermisos');

    Route::get('/',
        [
            //      'middleware' => 'permission:ver_usuarios',
            'uses' => 'UsuarioController@index',
        ]);

    Route::get('/{id}',
        [
            //      'middleware' => 'permission:ver_usuario',
            'uses' => 'UsuarioController@find',
        ]);

    Route::post('/',
        [
            //     'middleware' => 'permission:crear_usuario',
            'uses' => 'UsuarioController@create',
        ]);

    Route::put('/{id}',
        [
            //    'middleware' => 'permission:editar_usuario',
            'uses' => 'UsuarioController@update',
        ]);
});

Route::group(['prefix' => 'genero'], function ($router) {
    Route::get('/',
        [
            //      'middleware' => 'permission:ver_usuarios',
            'uses' => 'GeneroController@index',
        ]);

    Route::get('/{id}',
        [
            //      'middleware' => 'permission:ver_usuario',
            'uses' => 'GeneroController@find',
        ]);

    Route::post('/',
        [
            //     'middleware' => 'permission:crear_usuario',
            'uses' => 'GeneroController@create',
        ]);

    Route::put('/{id}',
        [
            //    'middleware' => 'permission:editar_usuario',
            'uses' => 'GeneroController@update',
        ]);
});

Route::group(['prefix' => 'nacionalidad'], function ($router) {
    Route::get('/',
        [
            //      'middleware' => 'permission:ver_usuarios',
            'uses' => 'NacionalidadController@index',
        ]);

    Route::get('/{id}',
        [
            //      'middleware' => 'permission:ver_usuario',
            'uses' => 'NacionalidadController@find',
        ]);

    Route::post('/',
        [
            //     'middleware' => 'permission:crear_usuario',
            'uses' => 'NacionalidadController@create',
        ]);

    Route::put('/{id}',
        [
            //    'middleware' => 'permission:editar_usuario',
            'uses' => 'NacionalidadController@update',
        ]);
});

Route::group(['prefix' => 'tipo_documento'], function ($router) {
    Route::get('/',
        [
            //      'middleware' => 'permission:ver_usuarios',
            'uses' => 'TipoDocumentoController@index',
        ]);

    Route::get('/{id}',
        [
            //      'middleware' => 'permission:ver_usuario',
            'uses' => 'TipoDocumentoController@find',
        ]);

    Route::post('/',
        [
            //     'middleware' => 'permission:crear_usuario',
            'uses' => 'TipoDocumentoController@create',
        ]);

    Route::put('/{id}',
        [
            //    'middleware' => 'permission:editar_usuario',
            'uses' => 'TipoDocumentoController@update',
        ]);
});

Route::group(['prefix' => 'persona'], function ($router) {
    Route::get('/',
        [
            //      'middleware' => 'permission:ver_usuarios',
            'uses' => 'PersonaController@index',
        ]);

    Route::get('/{id}',
        [
            //      'middleware' => 'permission:ver_usuario',
            'uses' => 'PersonaController@find',
        ]);

    Route::post('/',
        [
            //     'middleware' => 'permission:crear_usuario',
            'uses' => 'PersonaController@create',
        ]);

    Route::put('/{id}',
        [
            //    'middleware' => 'permission:editar_usuario',
            'uses' => 'PersonaController@update',
        ]);
});

Route::group(['prefix' => 'funcionario'], function ($router) {
    Route::get('/',
        [
            //      'middleware' => 'permission:ver_usuarios',
            'uses' => 'FuncionarioController@index',
        ]);

    Route::get('/{id}',
        [
            //      'middleware' => 'permission:ver_usuario',
            'uses' => 'FuncionarioController@find',
        ]);

    Route::post('/',
        [
            //     'middleware' => 'permission:crear_usuario',
            'uses' => 'FuncionarioController@create',
        ]);

    Route::put('/{id}',
        [
            //    'middleware' => 'permission:editar_usuario',
            'uses' => 'FuncionarioController@update',
        ]);

    Route::post('/login',
        [
            //     'middleware' => 'permission:crear_usuario',
            'uses' => 'FuncionarioController@login',
        ]);
});

Route::group(['prefix' => 'cliente'], function ($router) {
    Route::get('/',
        [
            //      'middleware' => 'permission:ver_usuarios',
            'uses' => 'ClienteController@index',
        ]);

    Route::get('/{id}',
        [
            //      'middleware' => 'permission:ver_usuario',
            'uses' => 'ClienteController@find',
        ]);

    Route::post('/',
        [
            //     'middleware' => 'permission:crear_usuario',
            'uses' => 'ClienteController@create',
        ]);

    Route::post('/login',
        [
            //     'middleware' => 'permission:crear_usuario',
            'uses' => 'ClienteController@login',
        ]);

    Route::put('/{id}',
        [
            //    'middleware' => 'permission:editar_usuario',
            'uses' => 'ClienteController@update',
        ]);
});

Route::group(['prefix' => 'reg_nacimiento'], function ($router) {
    Route::get('/',
        [
            //      'middleware' => 'permission:ver_usuarios',
            'uses' => 'RCNacimientoController@index',
        ]);

    Route::get('/{id}',
        [
            //      'middleware' => 'permission:ver_usuario',
            'uses' => 'RCNacimientoController@find',
        ]);

    Route::post('/',
        [
            //     'middleware' => 'permission:crear_usuario',
            'uses' => 'RCNacimientoController@create',
        ]);

    Route::put('/{id}',
        [
            //    'middleware' => 'permission:editar_usuario',
            'uses' => 'RCNacimientoController@update',
        ]);
});

Route::group(['prefix' => 'forma_pago'], function ($router) {
    Route::get('/',
        [
            //      'middleware' => 'permission:ver_usuarios',
            'uses' => 'FormaPagoController@index',
        ]);

    Route::get('/{id}',
        [
            //      'middleware' => 'permission:ver_usuario',
            'uses' => 'FormaPagoController@find',
        ]);

    Route::post('/',
        [
            //     'middleware' => 'permission:crear_usuario',
            'uses' => 'FormaPagoController@create',
        ]);

    Route::put('/{id}',
        [
            //    'middleware' => 'permission:editar_usuario',
            'uses' => 'FormaPagoController@update',
        ]);
});

Route::group(['prefix' => 'tipo_tramite'], function ($router) {
    Route::get('/',
        [
            //      'middleware' => 'permission:ver_usuarios',
            'uses' => 'TipoTramiteController@index',
        ]);

    Route::get('/{id}',
        [
            //      'middleware' => 'permission:ver_usuario',
            'uses' => 'TipoTramiteController@find',
        ]);

    Route::post('/',
        [
            //     'middleware' => 'permission:crear_usuario',
            'uses' => 'TipoTramiteController@create',
        ]);

    Route::put('/{id}',
        [
            //    'middleware' => 'permission:editar_usuario',
            'uses' => 'TipoTramiteController@update',
        ]);
});
Route::group(['prefix' => 'estado_tramite'], function ($router) {
    Route::get('/',
        [
            //      'middleware' => 'permission:ver_usuarios',
            'uses' => 'EstadoTramiteController@index',
        ]);

    Route::get('/{id}',
        [
            //      'middleware' => 'permission:ver_usuario',
            'uses' => 'EstadoTramiteController@find',
        ]);

    Route::post('/',
        [
            //     'middleware' => 'permission:crear_usuario',
            'uses' => 'EstadoTramiteController@create',
        ]);

    Route::put('/{id}',
        [
            //    'middleware' => 'permission:editar_usuario',
            'uses' => 'EstadoTramiteController@update',
        ]);
});

Route::group(['prefix' => 'tramite'], function ($router) {
    Route::get('/',
        [
            //      'middleware' => 'permission:ver_usuarios',
            'uses' => 'TramiteController@index',
        ]);

    Route::get('/{id}',
        [
            //      'middleware' => 'permission:ver_usuario',
            'uses' => 'TramiteController@find',
        ]);

    Route::post('/',
        [
            //     'middleware' => 'permission:crear_usuario',
            'uses' => 'TramiteController@create',
        ]);

    Route::put('/{id}',
        [
            //    'middleware' => 'permission:editar_usuario',
            'uses' => 'TramiteController@update',
        ]);
});
