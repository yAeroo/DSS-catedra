<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Convenio;
use App\Models\TipoEmpresa;
use App\Models\ArchivoEvidencia as Evidencia;

use Illuminate\Http\Request;

class ConveniosController extends Controller{
    public function index(){
        $withConvenios = Convenio::with('empresa')->where('convenio_respaldado', 1)->where('habilitado', 1)->get();
        $noConvenios = Convenio::with('empresa')->where('convenio_respaldado', 0)->where('habilitado', 1)->get();
        $tipos_empresa = TipoEmpresa::all();
        $empresas_list = Empresa::all();

        return view('listado_convenios', compact('withConvenios', 'noConvenios', 'tipos_empresa', 'empresas_list'));
    }

    public function store(Request $request){

        $convenio = new Convenio();
        $convenio->empresa_id = $request->empresa;
        $convenio->sede = $request->sede;
        $convenio->nombre_contacto = $request->nombre_contacto;
        $convenio->telefono_contacto = $request->numero_contacto;
        $convenio->correo_contacto = $request->correo;
        $convenio->estado = $request->situacion_actual;
        $convenio->tipo_convenio = $request->tipo_convenio;
        $convenio->fecha_inicio = $request->fecha_inicio;
        $convenio->fecha_fin = $request->fecha_finalizacion;
        $convenio->convenio_detalle = $request->detalles_convenio;
        $convenio->convenio_respaldado = isset($request->documentacion)?? 0;

        $convenio->save();
        return redirect()->route('convenios.index')->with('success', 'Convenio creado exitosamente.');
    }

    public function details($id){   return Convenio::with('archivos','empresa.tipoEmpresa')->findOrFail($id);   }

    public function update(Request $request){

        $convenio = Convenio::findOrFail($request->convenioId);
        $convenio->empresa_id = $request->empresa;
        $convenio->sede = $request->sede;
        $convenio->nombre_contacto = $request->nombre_contacto;
        $convenio->telefono_contacto = $request->numero_contacto;
        $convenio->correo_contacto = $request->correo;
        $convenio->estado = $request->situacion_actual;
        $convenio->tipo_convenio = $request->tipo_convenio;
        $convenio->fecha_inicio = $request->fecha_inicio;
        $convenio->fecha_fin = $request->fecha_finalizacion;
        $convenio->convenio_detalle = $request->detalles_convenio;
        $convenio->convenio_respaldado = isset($request->documentacion)?? 0;

        $convenio->save();
        return redirect()->route('convenios.index')->with('success', 'Convenio actualizado exitosamente.');
    }

    public function destroy(Request $request){
        $convenio = Convenio::findOrFail($request->convenioId);
        $convenio->habilitado = 0;
        $convenio->save();

        return redirect()->route('convenios.index')->with('success', 'Convenio eliminado exitosamente.');
    }

    public function upload(Request $request){

        if ($request->hasFile('documentacion')) {
            $convenio = Convenio::with('empresa')->findOrFail($request->convenioId);
            $file = $request->file('documentacion');
            $filename = $convenio->empresa->abreviatura_empresa .'_'.now()->format('n_j_Y_H_i_s').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/convenios'), $filename);

            // Guardar el archivo en la base de datos
            $evidencia = Evidencia::where('convenio_id', $request->convenioId)->first();

            if ($evidencia) {
                $evidencia->update([
                    'nombre_archivo' => $filename,
                ]);
            }
            else {
                $evidencia = new Evidencia();
                $evidencia->convenio_id = $request->convenioId;
                $evidencia->nombre_archivo = $filename;
                $evidencia->save();
            }

            // Actualizar el estado del convenio si todo está correcto
            $convenio->estado_evidencia = 1;
            $convenio->save();
        }

        return redirect()->route('convenios.index')->with('success', 'Archivo subido exitosamente.');
    }

    public function download($id){
        $evidencia = Evidencia::findOrFail($id);
        $filePath = public_path('uploads/convenios/' . $evidencia->nombre_archivo);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->route('convenios.index')->with('error', 'Archivo no encontrado.');
        }
    }
}
