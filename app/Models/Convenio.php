<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    protected $primaryKey = 'convenio_id';
    protected $fillable = [
        'empresa_id',
        'sede',
        'nombre_contacto',
        'telefono_contacto',
        'correo_contacto',
        'estado',
        'tipo_convenio',
        'fecha_inicio',
        'fecha_fin',
        'convenio_detalle',
        'convenio_respaldado',
        'estado_evidencia',
        'habilitado',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'empresa_id');
    }

    public function archivos()
    {
        return $this->hasMany(ArchivoEvidencia::class, 'convenio_id', 'convenio_id');
    }
}
