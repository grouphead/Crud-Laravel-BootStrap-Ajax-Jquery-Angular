<?php

use App\Http\Controllers\CandidatosController;
use App\Http\Controllers\CRUDLinguagemController;
use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

route::get('/admin/crudlinguagens', [CRUDLinguagemController::class, 'create']);

route::post('/admin/crudlinguagens', [CRUDLinguagemController::class, 'store']);

route::resource('/admin/crudVagas', 'CRUDVagaController');

Route::resource('/crudCandidatos', 'CandidatosController');