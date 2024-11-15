<?php

namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;


class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAll();
    }

    public function getUserById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function createUser(array $data)
    {
            // Encripta la clave antes de crear el usuario
        if (isset($data['clave'])) {
            $data['clave'] = Hash::make($data['clave']);
        }

        return $this->userRepository->create($data);
                
    }

    public function updateUser($id, array $data)
    {
            // Encripta la clave solo si está presente en los datos
        if (isset($data['clave'])) {
            $data['clave'] = Hash::make($data['clave']);
        }

        return $this->userRepository->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }
}
?>