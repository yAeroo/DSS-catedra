<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\TipoEmpresa;

class EmpresaController extends Controller
{
    public function index(Request $request)
    {
        $empresasList = Empresa::where('habilitada', 1)->with('tipoEmpresa')->get();
        $editarEmpresa = null;
        $tipoEmpresas = TipoEmpresa::where('habilitada', 1)->get();

        if ($request->has('editar')) {
            $editarEmpresa = Empresa::find($request->editar);
        }

        return view('listado_empresas', compact('empresasList', 'editarEmpresa', 'tipoEmpresas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'abreviatura_empresa' => 'required|string|max:50',
            'nombre_empresa' => 'required|string|max:255',
            'codigo_donante' => 'nullable|string|max:100',
            'tipo_cooperacion' => 'nullable|string|max:100',
            'tipo_relacion' => 'nullable|string|max:100',
            'direccion' => 'nullable|string',
            'estado' => 'required|in:activo,inactivo',
            'tipo_empresa_id' => 'required|exists:tipo_empresas,tipo_empresa_id',
        ]);

        $empresa = new Empresa();
        $empresa->fill($request->all());
        $empresa->habilitada = 1;
        $empresa->save();

        return redirect()->route('empresas.index')->with('success', 'Empresa creada exitosamente');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'abreviatura_empresa' => 'required|string|max:50',
            'nombre_empresa' => 'required|string|max:255',
            'codigo_donante' => 'nullable|string|max:100',
            'tipo_cooperacion' => 'nullable|string|max:100',
            'tipo_relacion' => 'nullable|string|max:100',
            'direccion' => 'nullable|string',
            'estado' => 'required|in:activo,inactivo',
            'tipo_empresa_id' => 'required|exists:tipo_empresas,tipo_empresa_id',
        ]);

        $empresa = Empresa::findOrFail($id);

        // Actualizar todos los campos excepto estado
        $empresa->fill($request->except('estado'));

        // Manejar el estado por separado para asegurar el formato correcto
        $empresa->estado = $request->estado;

        $empresa->save();

        return redirect()->route('empresas.index')->with('success', 'Empresa actualizada correctamente');
    }

    public function destroy($id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->habilitada = 0;
        $empresa->save();

        return redirect()->route('empresas.index')->with('success', 'Empresa deshabilitada correctamente');
    }
}
