<?php

use App\Http\Controllers\AmbienteController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ProfesoresController;
use App\Http\Controllers\ProfileController;
use App\Models\Ambiente;
use App\Models\Inventario;
use App\Models\Profesores;
use App\Models\User;
use App\Models\UserXProfesores;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
Route::get('/', function () {
    return view('auth.login');
});

// ruta que se tiene que seprar la logica mediante roles
Route::get('/dashboard', function () {
    $Inventario=Inventario::all();
    $Profesores=Profesores::all();
    $Ambientes=Ambiente::all();

        // Verificar si el usuario autenticado es el admin
        if (Auth::user()->email === 'admin@gmail.com') {
            return view('dashboard', compact('Ambientes', 'Profesores', 'Inventario'));
        } else {

            //estoy usando la misma variable de inventario
            $usuario=UserXProfesores::all()->where('user_id','=',Auth::user()->id)->first();

            $Inventario=Inventario::all()->where('profesor_id','=',$usuario->profesor_id);
            return view('Profesores.Inventario.index',compact('Inventario','Ambientes')); // Asegúrate de que esta ruta esté definida
        }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('inventarios', InventarioController::class);
    Route::resource('profesores', ProfesoresController::class);
    Route::resource('ambientes', AmbienteController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(ExcelController::class)->group(function () {
        Route::post('/Excel', 'import')->name('importar');
        Route::get('/Excel/export', 'export')->name('exportar');

    });

});





require __DIR__.'/auth.php';
