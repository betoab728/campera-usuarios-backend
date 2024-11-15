<?php

namespace App\Repositories\Position;

use App\Models\Position;

class PositionRepository implements PositionRepositoryInterface
{
    public function getAll()
    {
        return Position::all();
    }

    public function findById($id)
    {
        return Position::find($id);
    }

    public function create(array $data)
    {
        return Position::create($data);
    }

    public function update($id, array $data)
    {
        $position = Position::find($id);
        if ($position) {
            $position->update($data);
            return $position;
        }
        return null;
    }

    public function delete($id)
    {
        $position = Position::find($id);
        if ($position) {
            $position->delete();
            return true;
        }
        return false;
    }
}
?>