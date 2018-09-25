<?php

Route::group(['prefix' => 'usuario'], function ($router) {

    Route::post('/login', 'UsuarioController@login');
    Route::put('/{id}', 'UsuarioController@update');

    Route::post('/registro/cliente', 'UsuarioController@registroCliente');
    Route::put('/update/cliente/{id}', 'UsuarioController@updateCliente');

    Route::post('/registro/funcionario', 'UsuarioController@registroFuncionario');
    Route::put('/update/funcionario/{id}', 'UsuarioController@updateFuncionario');

    Route::get('/funcionario', 'UsuarioController@indexFuncionario');

    Route::get('/funcionario/{id}', 'UsuarioController@findFuncionario');

    Route::get('/cliente', 'UsuarioController@indexCliente');

    Route::get('/cliente/{id}', 'UsuarioController@findCliente');

});

Route::group(['prefix' => 'rol'], function ($router) {

    Route::get('/', 'RolController@index');

    Route::get('/{id}', 'RolController@find');

    Route::post('/', 'RolController@create');

    Route::post('/usuario/{id}', 'RolController@create');

    Route::put('/{id}', 'RolController@update');
});

Route::group(['prefix' => 'perfil'], function ($router) {

    Route::get('/', 'PerfilController@index');

    Route::get('/{id}', 'PerfilController@find');

    Route::post('/', 'PerfilController@create');

    Route::put('/{id}', 'PerfilController@update');
});

Route::group(['prefix' => 'permiso'], function ($router) {

    Route::get('/', 'PermisoController@index');

    Route::get('/porRol/', 'PermisoController@porRol');

    Route::get('/porUsuario/{id}', 'PermisoController@porUsuario');

    Route::get('/{id}', 'PermisoController@find');

    Route::post('/', 'PermisoController@create');

    Route::post('/rol/{id}', 'PermisoController@create');

    Route::put('/{id}', 'PermisoController@update');
});

Route::group(['prefix' => 'forma_pago'], function ($router) {

    Route::get('/', 'FormaPagoController@index');

    Route::get('/{id}', 'FormaPagoController@find');

    Route::post('/', 'FormaPagoController@create');

    Route::put('/{id}', 'FormaPagoController@update');
});

Route::group(['prefix' => 'tipo_tramite'], function ($router) {

    Route::get('/', 'TipoTramiteController@index');

    Route::get('/{id}', 'TipoTramiteController@find');

    Route::post('/', 'TipoTramiteController@create');

    Route::put('/{id}', 'TipoTramiteController@update');
});

Route::group(['prefix' => 'tipo_documento'], function ($router) {

    Route::get('/', 'TipoDocumentoController@index');

    Route::get('/{id}', 'TipoDocumentoController@find');

    Route::post('/', 'TipoDocumentoController@create');

    Route::put('/{id}', 'TipoDocumentoController@update');
});

Route::group(['prefix' => 'estado_tramite'], function ($router) {

    Route::get('/', 'EstadoTramiteController@index');

    Route::get('/{id}', 'EstadoTramiteController@find');

    Route::post('/', 'EstadoTramiteController@create');

    Route::put('/{id}', 'EstadoTramiteController@update');
});

Route::group(['prefix' => 'firma'], function ($router) {

    Route::get('/', 'firmaController@index');

    Route::get('/{id}', 'firmaController@find');

    Route::post('/', 'firmaController@create');

    Route::put('/{id}', 'firmaController@update');
});

Route::group(['prefix' => 'pais'], function ($router) {

    Route::get('/', 'PaisController@index');

    Route::get('/{id}', 'PaisController@find');

    Route::post('/', 'PaisController@create');

    Route::put('/{id}', 'PaisController@update');
});

Route::group(['prefix' => 'departamento'], function ($router) {

    Route::get('/', 'DepartamentoController@index');

    Route::get('/{id}', 'DepartamentoController@find');

    Route::post('/', 'DepartamentoController@create');

    Route::put('/{id}', 'DepartamentoController@update');
});

Route::group(['prefix' => 'municipio'], function ($router) {

    Route::get('/', 'MunicipioController@index');

    Route::get('/{id}', 'MunicipioController@find');

    Route::post('/', 'MunicipioController@create');

    Route::put('/{id}', 'MunicipioController@update');
});

Route::group(['prefix' => 'corregimiento'], function ($router) {

    Route::get('/', 'CorregimientoController@index');

    Route::get('/{id}', 'CorregimientoController@find');

    Route::post('/', 'CorregimientoController@create');

    Route::put('/{id}', 'CorregimientoController@update');
});

Route::group(['prefix' => 'antecedente'], function ($router) {

    Route::get('/', 'AntecedenteController@index');

    Route::get('/{id}', 'AntecedenteController@find');

    Route::post('/', 'AntecedenteController@create');

    Route::put('/{id}', 'AntecedenteController@update');
});

Route::group(['prefix' => 'genero'], function ($router) {

    Route::get('/', 'GeneroController@index');

    Route::get('/{id}', 'GeneroController@find');

    Route::post('/', 'GeneroController@create');

    Route::put('/{id}', 'GeneroController@update');
});

Route::group(['prefix' => 'grupo_sanguineo'], function ($router) {

    Route::get('/', 'GrupoSanguineoController@index');

    Route::get('/{id}', 'GrupoSanguineoController@find');

    Route::post('/', 'GrupoSanguineoController@create');

    Route::put('/{id}', 'GrupoSanguineoController@update');
});

Route::group(['prefix' => 'factor_rh'], function ($router) {

    Route::get('/', 'FactorRHController@index');

    Route::get('/{id}', 'FactorRHController@find');

    Route::post('/', 'FactorRHController@create');

    Route::put('/{id}', 'FactorRHController@update');
});

Route::group(['prefix' => 'rc_nacimiento'], function ($router) {

    Route::get('/', 'RCNacimientoController@index');

    Route::get('/cliente/{id}', 'RCNacimientoController@cliente');

    Route::get('/{id}', 'RCNacimientoController@find');

    Route::post('/', 'RCNacimientoController@create');

    Route::put('/{id}', 'RCNacimientoController@update');
});

Route::group(['prefix' => 'madre'], function ($router) {

    Route::get('/{id}', 'MadreController@find');
});

Route::group(['prefix' => 'padre'], function ($router) {

    Route::get('/{id}', 'PadreController@find');
});

Route::group(['prefix' => 'declarante'], function ($router) {

    Route::get('/{id}', 'DeclaranteController@find');
});

Route::group(['prefix' => 'testigo'], function ($router) {

    Route::get('/{id}', 'TestigoController@find');
});

Route::group(['prefix' => 'contrayente'], function ($router) {

    Route::get('/{id}', 'ContrayenteController@find');
});

Route::group(['prefix' => 'denunciante'], function ($router) {

    Route::get('/{id}', 'DenuncianteController@find');
});

Route::group(['prefix' => 'rc_matrimonio'], function ($router) {

    Route::get('/', 'RCMatrimonioController@index');

    Route::get('/cliente/{id}', 'RCMatrimonioController@cliente');

    Route::get('/{id}', 'RCMatrimonioController@find');

    Route::post('/', 'RCMatrimonioController@create');

    Route::put('/{id}', 'RCMatrimonioController@update');
});

Route::group(['prefix' => 'capitulacion'], function ($router) {

    Route::get('/{id}', 'CapitulacionController@find');
});

Route::group(['prefix' => 'hijo'], function ($router) {

    Route::get('/{id}', 'HijoController@find');
});

Route::group(['prefix' => 'providencia'], function ($router) {

    Route::get('/{id}', 'ProvidenciaController@find');
});

Route::group(['prefix' => 'rc_defuncion'], function ($router) {

    Route::get('/', 'RCDefuncionController@index');

    Route::get('/cliente/{id}', 'RCDefuncionController@cliente');

    Route::get('/{id}', 'RCDefuncionController@find');

    Route::post('/', 'RCDefuncionController@create');

    Route::put('/{id}', 'RCDefuncionController@update');
});

Route::group(['prefix' => 'tramite'], function ($router) {

    Route::get('/', 'TramiteController@index');

    Route::get('/buscar/{id}', 'TramiteController@buscar');

    Route::get('/{id}', 'TramiteController@find');

    Route::post('/', 'TramiteController@create');

    Route::put('/{id}', 'TramiteController@update');
});

Route::group(['prefix' => 'cita'], function ($router) {

    Route::get('/', 'CitaController@index');

    Route::post('/horas', 'CitaController@getHoras');

    Route::get('/{id}', 'CitaController@find');

    Route::post('/', 'CitaController@create');

    Route::put('/{id}', 'CitaController@update');
});
