<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Los administradores deben usar /admin para iniciar sesión
        if ($user->isAdmin()) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Los administradores deben usar el acceso administrativo en /admin',
            ])->onlyInput('email');
        }
        
        // Validar que el rol del usuario coincida con el rol seleccionado
        $intendedRole = $request->input('intended_role');
        if ($intendedRole) {
            if ($intendedRole === 'profesor' && !$user->isProfesor()) {
                Auth::logout();
                return back()->withErrors([
                    'intended_role' => 'Este usuario no es profesor. Selecciona "Alumno" si eres alumno.',
                ])->withInput();
            }
            
            if ($intendedRole === 'alumno' && !$user->isAlumno()) {
                Auth::logout();
                return back()->withErrors([
                    'intended_role' => 'Este usuario no es alumno. Selecciona "Profesor" si eres profesor.',
                ])->withInput();
            }
        }
        
        $request->session()->regenerate();
        
        // Redireccionar según el rol del usuario (solo profesores y alumnos)
        if ($user->isProfesor()) {
            return redirect()->intended(route('profesor.dashboard', absolute: false));
        } elseif ($user->isAlumno()) {
            return redirect()->intended(route('alumno.dashboard', absolute: false));
        } else {
            // Si llega aquí, hay un problema - no debería pasar
            Auth::logout();
            return back()->withErrors([
                'email' => 'Error en el sistema: rol de usuario no válido.',
            ])->onlyInput('email');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
