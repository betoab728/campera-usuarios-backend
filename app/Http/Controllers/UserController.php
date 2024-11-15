<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        return UserResource::collection($users);
    }

    public function show($id)
    {
        try {
            $user = $this->userService->getUserById($id);
            return new UserResource($user);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo',
            'clave' => 'required|string|min:6',
            'idrol' => 'required|exists:roles,idrol',
            'estado' => 'required|boolean',
        ]);

        $user = $this->userService->createUser($data);

        return response()->json([
            'message' => 'User created successfully',
            'data' => new UserResource($user),
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'correo' => 'sometimes|required|email|unique:usuarios,correo,' . $id . ',idUsuario',
            'clave' => 'sometimes|required|string|min:6',
            'idrol' => 'sometimes|required|exists:roles,idrol',
            'estado' => 'sometimes|required|boolean',
        ]);

        try {
            $user = $this->userService->updateUser($id, $data);
            return response()->json([
                'message' => 'User updated successfully',
                'data' => new UserResource($user),
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $this->userService->deleteUser($id);
            return response()->json(['message' => 'User deleted successfully'], 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}
?>