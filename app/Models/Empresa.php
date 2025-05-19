<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';
    protected $primaryKey = 'empresa_id';
    protected $fillable = [
        'abreviatura_empresa',
        'nombre_empresa',
        'codigo_donante',
        'tipo_cooperacion',
        'tipo_relacion',
        'direccion',
        'estado',
        'tipo_empresa_id',
        'habilitada'
    ];

    public function setEstadoAttribute($value)
    {
        // Asegura que el valor se guarde en minúsculas
        $val = strtolower($value);
        $this->attributes['estado'] = ($val === 'activa' || $val === 'activo') ? 'activo' : 'inactivo';
    }

    public function getEstadoAttribute($value)
    {
        // Muestra el valor formateado
        return $value === 'activo' ? 'Activa' : 'Inactiva';
    }
    public function tipoEmpresa()
    {
        return $this->belongsTo(TipoEmpresa::class, 'tipo_empresa_id', 'tipo_empresa_id');
    }

    public function convenios()
    {
        return $this->hasMany(Convenio::class, 'empresa_id', 'empresa_id');
    }
}
