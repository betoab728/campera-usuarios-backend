<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->idEmpleado,
            'nombre' => $this->nombre,
            'apellido_paterno' => $this->apellidoPaterno,
            'apellido_materno' => $this->apellidoMaterno,
            'dni' => $this->dni,
            'fecha_nacimiento' => $this->fechaNacimiento,
            'direccion' => $this->direccion,
            'correo' => $this->correo,
            'telefono' => $this->telefono,
            'fecha_ingreso' => $this->fechaIngreso,
            'fecha_cese' => $this->fechaCese,
            'cargo' => $this->cargo ? [
                'id' => $this->cargo->idCargo,
                'nombre' => $this->cargo->nombre,
            ] : null,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
?>

