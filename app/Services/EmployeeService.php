<?php

namespace App\Services;

use App\Repositories\Employee\EmployeeRepositoryInterface;

class EmployeeService
{
    protected $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function getAllEmployees()
    {
        return $this->employeeRepository->getAll();
    }

    public function getEmployeeById($id)
    {
        return $this->employeeRepository->findById($id);
    }

    public function createEmployee(array $data)
    {
        return $this->employeeRepository->create($data);
    }

    public function updateEmployee($id, array $data)
    {
        return $this->employeeRepository->update($id, $data);
    }

    public function deleteEmployee($id)
    {
        return $this->employeeRepository->delete($id);
    }
}
?>