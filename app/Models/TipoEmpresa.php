<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEmpresa extends Model
{
    protected $primaryKey = 'tipo_empresa_id';
    protected $fillable = ['nombre', 'descripcion', 'habilitada'];

    public function empresas()
    {
        return $this->hasMany(Empresa::class, 'tipo_empresa_id', 'tipo_empresa_id');
    }
}
