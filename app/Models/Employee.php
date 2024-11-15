<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'idempleado';

    protected $fillable = [
        'nombre',
        'apellidoPaterno',
        'apellidoMaterno',
        'dni',
        'fechaNacimiento',
        'direccion',
        'correo',
        'telefono',
        'fechaIngreso',
        'fechaCese',
        'idcargo',
    ];

    public $timestamps = true;

      // Relación con la tabla positions
      public function position()
      {
          return $this->belongsTo(Position::class, 'idcargo');
      }
  
      // Relación con la tabla users
      public function user()
      {
          return $this->hasOne(User::class, 'idempleado');
      }


}
