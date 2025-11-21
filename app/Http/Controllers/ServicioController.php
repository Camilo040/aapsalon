<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all();
        return view('servicios.index', compact('servicios'));
    }

    public function create()
    {
        return view('servicios.create');
    }

     public function show($id)
    {
        $servicio = Servicio::find($id);
        return view('servicios.show', ['servicio' => $servicio]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
        ]);

        Servicio::create($request->only('nombre', 'precio'));

        return redirect()->route('servicios.index')->with('success', 'Servicio creado correctamente');
    }

    public function edit(Servicio $servicio)
    {
        return view('servicios.edit', compact('servicio'));
    }

    public function update(Request $request, Servicio $servicio)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
        ]);

        $servicio->update($request->only('nombre', 'precio'));

        return redirect()->route('servicios.index')->with('success', 'Servicio actualizado correctamente');
    }

    public function destroy(Servicio $servicio)
    {
        $servicio->delete();
        return redirect()->route('servicios.index')->with('success', 'Servicio eliminado correctamente');
    }
}