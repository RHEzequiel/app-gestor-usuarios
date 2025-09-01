<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminAuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de administración - Login separado
Route::prefix('admin')->name('admin.')->group(function () {
    // Rutas para invitados (no autenticados)
    Route::middleware('guest')->group(function () {
        Route::get('/', [AdminAuthController::class, 'create'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'store'])->name('login.store');
    });
    
    // Rutas protegidas para administradores
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', function () {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            // Verificar que sea admin
            if (!$user->isAdmin()) {
                Auth::logout();
                return redirect()->route('admin.login')->withErrors(['email' => 'Acceso denegado.']);
            }
            return view('dashboards.admin');
        })->name('dashboard');
        
        Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');
        Route::resource('users', UserController::class)->except(['create', 'store', 'destroy']);
    });
});

// Dashboard general (mantener compatibilidad)
Route::get('/dashboard', function () {
    /** @var \App\Models\User $user */
    $user = Auth::user();
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->isProfesor()) {
        return redirect()->route('profesor.dashboard');
    } else {
        return redirect()->route('alumno.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Dashboards específicos por rol
Route::get('/profesor/dashboard', function () {
    return view('dashboards.profesor');
})->middleware(['auth', 'verified'])->name('profesor.dashboard');

Route::get('/alumno/dashboard', function () {
    return view('dashboards.alumno');
})->middleware(['auth', 'verified'])->name('alumno.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
