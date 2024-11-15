<?php

namespace App\Http\Controllers;

use App\Services\RoleService;
use Illuminate\Http\Request;
use App\Http\Resources\RoleResource;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        $roles = $this->roleService->getAllRoles();
        return RoleResource::collection($roles);
    }

    public function show($id)
    {
        $role = $this->roleService->getRoleById($id);
        return new RoleResource($role);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $role = $this->roleService->createRole($data);
        return (new RoleResource($role))
            ->response()
            ->setStatusCode(201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $role = $this->roleService->updateRole($id, $data);
        return new RoleResource($role);
    }

    public function destroy($id)
    {
        $this->roleService->deleteRole($id);
        return response()->json(null, 204);
    }
}

?>