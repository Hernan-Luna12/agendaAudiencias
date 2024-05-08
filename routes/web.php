<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/clear', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');

    return "¡Cache limpio!";
});

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/Plantilla2/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get('/Plantilla2/livewire/livewire.js', $handle);
});

Route::get('/', function () {
    if(!Auth::check()){
        return redirect()->route('login');
    } else{
        return redirect()->route('dashboard');
    }
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('dashboard');
    });
});

////***************************generales
Route::group(['middleware' => ['auth']] , function(){
    Route::get('/get/distritos/{id}', [App\Http\Controllers\Controller::class, 'getDistritos'])->name('get-distritos');
    Route::get('/get/centros-trabajo/{id}', [App\Http\Controllers\Controller::class, 'getCentrosTrabajo'])->name('get-centros-trabajo');
    Route::get('/check-username/{username}', [App\Http\Controllers\Controller::class, 'checkUsername'])->name('check-username');
});

////***************************dashboard
Route::group(['middleware' => ['auth']] , function(){
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');
});

////***************************categoriaspermisos
Route::group(['middleware' => ['auth']] , function(){
    Route::get('/categoriaspermiso', [App\Http\Controllers\CategoriaPermisoController::class, 'index'])->name('categoriaspermiso.index');
    Route::post('/categoriaspermiso/tabla', [App\Http\Controllers\CategoriaPermisoController::class, 'tabla'])->name('categoriaspermiso.tabla');
    Route::get('/categoriaspermiso/create', [App\Http\Controllers\CategoriaPermisoController::class, 'create'])->name('categoriaspermiso.create');
    Route::post('/categoriaspermiso/store', [App\Http\Controllers\CategoriaPermisoController::class, 'store'])->name('categoriaspermiso.store');
    Route::get('/categoriaspermiso/edit/{id}', [App\Http\Controllers\CategoriaPermisoController::class, 'edit'])->name('categoriaspermiso.edit');
    Route::post('/categoriaspermiso/update', [App\Http\Controllers\CategoriaPermisoController::class, 'update'])->name('categoriaspermiso.update');
    Route::post('/categoriaspermiso/delete/{id}', [App\Http\Controllers\CategoriaPermisoController::class, 'delete'])->name('categoriaspermiso.delete');
});

////***************************permisos
Route::group(['middleware' => ['auth']] , function(){
    Route::get('/permisos', [App\Http\Controllers\PermisoController::class, 'index'])->name('permisos.index');
    Route::post('/permisos/tabla', [App\Http\Controllers\PermisoController::class, 'tabla'])->name('permisos.tabla');
    Route::get('/permisos/create', [App\Http\Controllers\PermisoController::class, 'create'])->name('permisos.create');
    Route::post('/permisos/store', [App\Http\Controllers\PermisoController::class, 'store'])->name('permisos.store');
    Route::get('/permisos/edit/{id}', [App\Http\Controllers\PermisoController::class, 'edit'])->name('permisos.edit');
    Route::post('/permisos/update', [App\Http\Controllers\PermisoController::class, 'update'])->name('permisos.update');
    Route::post('/permisos/delete/{id}', [App\Http\Controllers\PermisoController::class, 'delete'])->name('permisos.delete');
});


////***************************perfiles
Route::group(['middleware' => ['auth']] , function(){
    Route::get('/perfiles', [App\Http\Controllers\PerfilController::class, 'index'])->name('perfiles.index');
    Route::post('/perfiles/tabla', [App\Http\Controllers\PerfilController::class, 'tabla'])->name('perfiles.tabla');
    Route::get('/perfiles/create', [App\Http\Controllers\PerfilController::class, 'create'])->name('perfiles.create');
    Route::post('/perfiles/store', [App\Http\Controllers\PerfilController::class, 'store'])->name('perfiles.store');
    Route::get('/perfiles/edit/{id}', [App\Http\Controllers\PerfilController::class, 'edit'])->name('perfiles.edit');
    Route::post('/perfiles/update', [App\Http\Controllers\PerfilController::class, 'update'])->name('perfiles.update');
    Route::post('/perfiles/delete/{id}', [App\Http\Controllers\PerfilController::class, 'delete'])->name('perfiles.delete');
});

////***************************usuarios
Route::group(['middleware' => ['auth']] , function(){
    Route::get('/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('usuarios.index');
    Route::post('/usuarios/tabla', [App\Http\Controllers\UsuarioController::class, 'tabla'])->name('usuarios.tabla');
    Route::get('/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios/store', [App\Http\Controllers\UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/edit/{id}', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::post('/usuarios/update', [App\Http\Controllers\UsuarioController::class, 'update'])->name('usuarios.update');
    Route::post('/usuarios/destroy/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('usuarios.destroy');
    Route::post('/usuarios/activate/{id}', [App\Http\Controllers\UsuarioController::class, 'activate'])->name('usuarios.activate');
    Route::post('/usuarios/resetpassword/{id}', [App\Http\Controllers\UsuarioController::class, 'resetpassword'])->name('usuarios.resetpassword');
});

///***********************CATAGOLO ETAPA */
Route::group(['middleware' => ['auth']] , function(){
    Route::get('/catagolo/Etapas', [App\Http\Controllers\ctgEtapaController::class, 'index'])->name('etapas.index');
    Route::get('/catagolo/Etapas/Create', [App\Http\Controllers\ctgEtapaController::class, 'create'])->name('etapas.create');
    Route::post('/catagolo/Etapas/Storage', [App\Http\Controllers\ctgEtapaController::class, 'guardarEtapa'])->name('etapas.storage');

});