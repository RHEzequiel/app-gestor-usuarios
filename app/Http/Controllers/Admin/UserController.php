<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        /** @var User $user */
        $user = Auth::user();
        
        // Solo administradores y profesores pueden ver listados
        if (!$user->isAdmin() && !$user->isProfesor()) {
            abort(403);
        }
        
        // Los administradores ven todos los usuarios
        if ($user->isAdmin()) {
            $users = User::all();
        }
        // Los profesores solo ven alumnos
        else {
            $query = User::where('role', 'alumno');
            
            // Si hay búsqueda por teléfono
            if ($request->filled('search_phone')) {
                $searchPhone = $request->search_phone;
                $query->where('phone', 'like', '%' . $searchPhone . '%');
            }
            
            $users = $query->get();
        }
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        /** @var User $authUser */
        $authUser = Auth::user();
        
        // Verificar permisos: admins ven todo, profesores ven alumnos, usuarios ven su propio perfil
        if (!$authUser->isAdmin() && !$authUser->isProfesor() && Auth::id() !== $user->id) {
            abort(403);
        }
        
        // Si es profesor, solo puede ver alumnos (excepto su propio perfil)
        if ($authUser->isProfesor() && Auth::id() !== $user->id && !$user->isAlumno()) {
            abort(403);
        }
        
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        /** @var User $authUser */
        $authUser = Auth::user();
        
        // Solo admins pueden editar cualquier usuario, otros solo su propio perfil
        if (!$authUser->isAdmin() && Auth::id() !== $user->id) {
            abort(403);
        }
        
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();
        
        if ($request->hasFile('photo')) {
            if ($user->photo_path) {
                Storage::disk('public')->delete($user->photo_path);
            }
            
            $path = $request->file('photo')->store('photos', 'public');
            $data['photo_path'] = $path;
        }
        
        $user->update($data);
        
        return redirect()->route('admin.users.show', $user)->with('success', 'Usuario actualizado correctamente.');
    }
}

