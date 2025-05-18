<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchivoEvidencia extends Model
{
    protected $primaryKey = 'archivo_id';
    protected $fillable = ['convenio_id', 'nombre_archivo'];

    public function convenio()
    {
        return $this->belongsTo(Convenio::class, 'convenio_id', 'convenio_id');
    }
}
