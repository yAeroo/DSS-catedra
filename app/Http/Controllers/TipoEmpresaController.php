<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoEmpresa;

class TipoEmpresaController extends Controller
{
    public function index()
    {
        /* $tipoEmpresasList = TipoEmpresa::all();
        return view('gestion_empresas', compact('tipoEmpresasList')); */
        $tipoEmpresasList = TipoEmpresa::all();
        return view('gestion_empresas', compact('tipoEmpresasList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|nullable|string',
        ]);

        $tipo = new TipoEmpresa();
        $tipo->nombre = $request->nombre;
        $tipo->descripcion = $request->descripcion;
        $tipo->save();

        // return response()->json(['message' => 'Tipo de empresa creado con éxito'], 201);
        return redirect()->route('tipos-empresa.index')->with('success', "Tipo de Empresa Creada Exitosamente");
    }
}
