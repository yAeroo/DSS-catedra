<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoEmpresa;

class TipoEmpresaController extends Controller
{
    public function index(Request $request)
    {
        $tipoEmpresasList = TipoEmpresa::where('habilitada', 1)->get();
        $editarTipoEmpresa = null;

        if ($request->has('editar')) {
            $editarTipoEmpresa = TipoEmpresa::find($request->editar);
        }

        return view('gestion_empresas', compact('tipoEmpresasList', 'editarTipoEmpresa'));
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
        return redirect()->route('tipos-empresa.index')->with('success', "Tipo de Empresa Creada Exitosamente");
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $tipo = TipoEmpresa::findOrFail($id);
        $tipo->nombre = $request->nombre;
        $tipo->descripcion = $request->descripcion;
        $tipo->save();

        return redirect()->route('tipos-empresa.index')->with('success', "Tipo de Empresa actualizada correctamente");
    }

    public function destroy($id)
{
    $tipo = TipoEmpresa::findOrFail($id);
    $tipo->habilitada = 0; // Cambiar a 0 en lugar de eliminar
    $tipo->save();

    return redirect()->route('tipos-empresa.index')->with('success', 'Tipo de Empresa deshabilitada correctamente');
}

}
