<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\PersonaController;
use App\Http\Controllers\Dashboard\EquipoController;
use App\Http\Controllers\Dashboard\ParticipaController;
use App\Http\Controllers\Dashboard\GestionController;
use App\Http\Controllers\Dashboard\EventoController;
use App\Http\Controllers\Dashboard\TematicaController;

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
/*
Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/',[EventoController::class,'publicar'] )->name('evento.publicar');
/*    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
*/
Route::group(['prefix'=>'dashboard','middleware'=> ['auth','admin']],function(){
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('participa/confirmar/{participa}',[ParticipaController::class,'confirmar'] )->name('participa.confirmar');
    Route::get('participa/desconfirmar/{participa}',[ParticipaController::class,'desconfirmar'] )->name('participa.desconfirmar');
    Route::get('participa/imprimir/{participa}',[ParticipaController::class,'imprimir'] )->name('participa.imprimir');
    Route::get('participa/mensaje/{msg?}/{ruta?}',[ParticipaController::class,'mensaje'] )->name('participa.mensaje');
    //listas
    Route::get('participa/export',[ParticipaController::class,'export'] )->name('participa.export');
    Route::get('persona/export',[PersonaController::class,'export'] )->name('persona.export');


    Route::get('persona/estadistica',[PersonaController::class,'estadistica'] )->name('persona.estadistica');
    Route::resources([
        'persona'=> PersonaController::class,
        'equipo'=> EquipoController::class,
        'participa'=> ParticipaController::class,
        'gestion'=> GestionController::class,
        'evento'=> EventoController::class,
        'tematica'=> tematicaController::class,
    ]);
});


require __DIR__.'/auth.php';
//require __DIR__.'/hack-auth.php';
