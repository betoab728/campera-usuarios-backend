<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function getAll();

    public function findById($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);
}
?>