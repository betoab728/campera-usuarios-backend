<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject; // Importamos la interfaz JWTSubject

class User extends Authenticatable implements JWTSubject // Implementamos la interfaz JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * Los atributos que se pueden asignar de forma masiva.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',        // Nuevo campo
        'idempleado',    // Nuevo campo
        'idrol',         // Nuevo campo
    ];

    /**
     * Los atributos que deben estar ocultos para la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Obtener los atributos que deben ser convertidos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación con la tabla employees.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'idempleado');
    }

    /**
     * Relación con la tabla roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'idrol');
    }

    // Implementación del método getJWTIdentifier() que es requerido por JWTSubject
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Devuelve el identificador único del usuario, típicamente el ID
    }

    // Implementación del método getJWTCustomClaims() que es requerido por JWTSubject
    public function getJWTCustomClaims()
    {
        return []; // Si no necesitas claims personalizados, puedes devolver un array vacío
    }
}
