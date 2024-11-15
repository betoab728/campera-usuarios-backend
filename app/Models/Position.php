<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
     // Nombre de la tabla asociada (opcional si sigue la convención)
     protected $table = 'positions';
     
      // Clave primaria personalizada
    protected $primaryKey = 'idcargo';
     // Campos asignables en masivo
     protected $fillable = [
        'nombre',
        'descripcion',
    ];

    // Indica que la tabla tiene timestamps (por defecto es true)
    public $timestamps = true;


}
