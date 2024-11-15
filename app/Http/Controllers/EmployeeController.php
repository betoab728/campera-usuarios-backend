<?php

namespace App\Http\Controllers;

use App\Services\EmployeeService;
use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        return EmployeeResource::collection($this->employeeService->getAllEmployees());
    }

    public function show($id)
    {
        try {
            $employee = $this->employeeService->getEmployeeById($id);
            return new EmployeeResource($employee);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Employee not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidoPaterno' => 'required|string|max:255',
            'apellidoMaterno' => 'nullable|string|max:255',
            'dni' => 'required|string|size:8|unique:empleados,dni',
            'fechaNacimiento' => 'required|date',
            'direccion' => 'nullable|string|max:255',
            'correo' => 'required|email|unique:empleados,correo',
            'telefono' => 'nullable|string|max:15',
            'fechaIngreso' => 'required|date',
            'idCargo' => 'required|exists:cargos,idCargo',
        ]);

        $employee = $this->employeeService->createEmployee($data);

        return response()->json([
            'message' => 'Employee created successfully',
            'data' => new EmployeeResource($employee),
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'apellidoPaterno' => 'sometimes|required|string|max:255',
            'apellidoMaterno' => 'sometimes|nullable|string|max:255',
            'dni' => 'sometimes|required|string|size:8|unique:empleados,dni,' . $id,
            'fechaNacimiento' => 'sometimes|required|date',
            'direccion' => 'sometimes|nullable|string|max:255',
            'correo' => 'sometimes|required|email|unique:empleados,correo,' . $id,
            'telefono' => 'sometimes|nullable|string|max:15',
            'fechaIngreso' => 'sometimes|required|date',
            'idCargo' => 'sometimes|required|exists:cargos,idCargo',
        ]);

        try {
            $employee = $this->employeeService->updateEmployee($id, $data);
            return response()->json([
                'message' => 'Employee updated successfully',
                'data' => new EmployeeResource($employee),
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Employee not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $this->employeeService->deleteEmployee($id);
            return response()->noContent();
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Employee not found'], 404);
        }
    }
}
?>