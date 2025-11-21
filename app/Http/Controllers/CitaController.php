<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ← Importante
use App\Models\Cita;
use App\Models\User;
use App\Models\Servicio;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with('usuario', 'servicios')->get();
        return view('citas.index', compact('citas'));
    }

    public function create()
    {
        $usuarios = User::all();
        $servicios = Servicio::all();
        return view('citas.create', compact('usuarios', 'servicios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
        ]);

        // ✅ Obtener usuario autenticado
        $usuarioId = Auth::id();

        // Crear la cita
        $cita = Cita::create([
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'usuarioId' => $usuarioId, // ← aquí usamos el ID del usuario autenticado
        ]);

        // Asociar servicios
        $cita->servicios()->attach($request->servicios);

        return redirect()->route('citas.index')->with('success', 'Cita creada correctamente');
    }

    public function show($id)
    {
        $cita = Cita::with('usuario', 'servicios')->findOrFail($id);
        return view('citas.show', compact('cita'));
    }

    public function edit($id)
    {
        $cita = Cita::findOrFail($id);
        $usuarios = User::all();


        return view('citas.edit', compact('cita', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
        ]);

        $cita = Cita::findOrFail($id);

        // Mantener el usuario autenticado
        $usuarioId = Auth::id();

        $cita->update([
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'usuarioId' => $usuarioId,
        ]);

        $cita->servicios()->sync($request->servicios);

        return redirect()->route('citas.index')->with('success', 'Cita actualizada correctamente');
    }

    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->servicios()->detach();
        $cita->delete();

        return redirect()->route('citas.index')->with('success', 'Cita eliminada correctamente');
    }
}