<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    //
    public function index()
    {
        // Traemos todos los usuarios para la tabla
        $usuarios = \App\Models\User::all();
        return view('usuarios.index', compact('usuarios'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|',
            'password' => 'required|string|min:8',
            'role' => 'required',
        ]);
        $busqueda_email_existente = User::where('email', $request->email)->first();
        if ($busqueda_email_existente) {
            return back()->with('error', 'El correo ya se encuentra registrado');
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role, // Se guarda el texto directo
            'estado' => true
        ]);

        return redirect()->route('usuarios.index')->with('info', 'Usuario creado con éxito.');
    }
    public function destroy($id)
    {
        if (auth()->user()->id == $id) {
            return back()->with('error', 'No puedes inhabilitar tu propio usuario');
        }
        if ($id == 1) {
            return back()->with('error', 'No puedes inhabilitar al superadmin');
        }
        $user = User::findOrFail($id);

        // Cambiamos el estado (si está activo lo apaga, si está apagado lo activa)
        $user->estado = !$user->estado;
        $user->save();

        $mensaje = $user->estado ? 'Usuario habilitado' : 'Usuario inhabilitado';

        return back()->with('info', $mensaje);
    }
}
