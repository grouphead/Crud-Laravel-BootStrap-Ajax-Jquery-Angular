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

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\CandidatosController;
use App\Http\Controllers\CRUDLinguagemController;
use App\Http\Controllers\CRUDVagaController;
use App\Http\Controllers\HomeController;

/* Pagina Principal */
Route::get('/', function () {
    return view('welcome');
});

/* Adicionando rotas de auth do laravel */
Auth::routes();

/* Inicio do candidato */
Route::get('/home', [HomeController::class, 'index'])->name('home');

/* Inicio do admin */
route::get('/admin', [AdminController::class, 'index'])->name('admin.dashbord');

/* Pagina login do administrador */
route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin.login');

/* Metodo de logar do administrador */
route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');

/* Pagina CRUD Linguagens do Administrador */
route::get('/admin/crudlinguagens', [CRUDLinguagemController::class, 'index'])->name('admin.crudlinguagens')->middleware('auth:admin');

/* Enviando dados para o paginate da pagina Linguagens */
route::get('/json', [CRUDLinguagemController::class, 'show']);

/* Pagina CRUD Vagas do Administrador */
route::get('/admin/crudVagas', [CRUDVagaController::class, 'indexview'])->name('admin.crudvagas')->middleware('auth:admin');

/* Pagina CRUD Candidato do usuario */
route::get('/crudCandidatos', [CandidatosController::class, 'indexview'])->name('home.candidatos')->middleware('auth');

/* Pagina CRUD Candidatos enviar */
route::post('/crudCandidatos', [CandidatosController::class, 'store'])->name('enviar.candidatos')->middleware('auth');