<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
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

    public function tipoEmpresa()
    {
        return $this->belongsTo(TipoEmpresa::class, 'tipo_empresa_id', 'tipo_empresa_id');
    }

    public function convenios()
    {
        return $this->hasMany(Convenio::class, 'empresa_id', 'empresa_id');
    }
}
