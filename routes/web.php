<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LlistaController;
use App\Http\Controllers\ProducteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CompartirLlistaController;

Route::get('/', function () {
    return view('auth.register');
});

Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('google.redirect');

Route::get('/google-auth/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();

    // Crear o buscar usuario
    $user = User::firstOrCreate(
        ['email' => $googleUser->getEmail()],
        ['name' => $googleUser->getName(), 'password' => bcrypt(str()->random(16)), 'avatar' => $googleUser->getAvatar() ?? null,]
    );
    Auth::login($user);
    return redirect('/home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
   
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/home', function () {
        return view('home');
    })->middleware(['verified'])->name('home');

    //Categories
    Route::get('/categories', [CategoriaController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoriaController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoriaController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoriaController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoriaController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoriaController::class, 'destroy'])->name('categories.destroy');

    //Llistas
    Route::get('/llistes', [LlistaController::class, 'index'])->name('llistas.index');
    Route::get('/llistes/create', [LlistaController::class, 'create'])->name('llistas.create');
    Route::post('/llistes', [LlistaController::class, 'store'])->name('llistas.store');
    Route::get('/llistes/{id}/edit', [LlistaController::class, 'edit'])->name('llistas.edit');
    Route::put('/llistes/{id}', [LlistaController::class, 'update'])->name('llistas.update');
    Route::delete('/llistes/{id}', [LlistaController::class, 'destroy'])->name('llistas.destroy');

    //Productes
    Route::get('/llistes/{llista_id}/productes/create', [ProducteController::class, 'create'])->name('productes.create');
    Route::post('/productes', [ProducteController::class, 'store'])->name('productes.store');
    Route::put('/productes/{id}', [ProducteController::class, 'update'])->name('productes.update');
    Route::delete('/productes/{id}', [ProducteController::class, 'destroy'])->name('productes.destroy');
    Route::post('/productes/{id}/toggle-comprat', [ProducteController::class, 'toggleComprat'])->name('productes.toggleComprat');


    //Comprtir
    Route::post('/llistas/{id}/compartir', [CompartirLlistaController::class, 'compartir'])->name('llistas.compartir');
    Route::get('/compartido-conmigo', [CompartirLlistaController::class, 'recibidas'])->name('llistas.compartidas');
});

require __DIR__.'/auth.php';