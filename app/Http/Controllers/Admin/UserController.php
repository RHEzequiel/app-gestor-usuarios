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
    public function index(): View
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }
        
        $users = User::all();
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        if (!Auth::user()->is_admin && Auth::id() !== $user->id) {
            abort(403);
        }
        
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        if (!Auth::user()->is_admin && Auth::id() !== $user->id) {
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

