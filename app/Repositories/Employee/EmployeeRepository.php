<?php

namespace App\Repositories\Employee;

use App\Models\Employee;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getAll()
    {
        return Employee::all();
    }

    public function findById($id)
    {
        return Employee::find($id);
    }

    public function create(array $data)
    {
        return Employee::create($data);
    }

    public function update($id, array $data)
    {
        $employee = Employee::find($id);
        if ($employee) {
            $employee->update($data);
            return $employee;
        }
        return null;
    }

    public function delete($id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            $employee->delete();
            return true;
        }
        return false;
    }
}

?>