<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'idrol';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public $timestamps = true;

     // Relación con la tabla users
     public function users()
     {
         return $this->hasMany(User::class, 'idrol');
     }
}
