<?php

namespace App\Repositories\Rol;

use App\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    public function getAll()
    {
        return Role::all();
    }

    public function findById($id)
    {
        return Role::find($id);
    }

    public function create(array $data)
    {
        return Role::create($data);
    }

    public function update($id, array $data)
    {
        $role = Role::find($id);
        if ($role) {
            $role->update($data);
            return $role;
        }
        return null;
    }

    public function delete($id)
    {
        $role = Role::find($id);
        if ($role) {
            $role->delete();
            return true;
        }
        return false;
    }
}
