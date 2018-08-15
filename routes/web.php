<?php

Route::group(['prefix' => 'pessoas'], function () {
	Route::get('/', function(){
		return redirect('/pessoas/A');
	});
	Route::get('/novo', 'PessoasController@novoview');
	Route::get('/{id}/editar', 'PessoasController@editarView');
	Route::get('/{id}/excluir', 'PessoasController@excluirView');
	Route::get('/{id}/destroy', 'PessoasController@destroy');
	Route::post('/store', 'PessoasController@store');
	Route::post('/update', 'PessoasController@update');
	Route::post('/buscar', 'PessoasController@buscar');
	Route::get('/{letra}', 'PessoasController@index');
});
