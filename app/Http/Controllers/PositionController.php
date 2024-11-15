<?php

namespace App\Http\Controllers;

use App\Services\PositionService;
use Illuminate\Http\Request;
use App\Http\Resources\PositionResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PositionController extends Controller
{
    protected $positionService;

    public function __construct(PositionService $positionService)
    {
        $this->positionService = $positionService;
    }

    public function index()
    {
        $positions = $this->positionService->getAllPositions();
        return PositionResource::collection($positions);
    }

    public function show($id)
    {
        try {
            $position = $this->positionService->getPositionById($id);
            return new PositionResource($position);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Position not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $position = $this->positionService->createPosition($data);

        return response()->json([
            'message' => 'Position created successfully',
            'data' => new PositionResource($position),
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'descripcion' => 'sometimes|nullable|string|max:255',
        ]);

        try {
            $position = $this->positionService->updatePosition($id, $data);
            return response()->json([
                'message' => 'Position updated successfully',
                'data' => new PositionResource($position),
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Position not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $this->positionService->deletePosition($id);
            return response()->json(['message' => 'Position deleted successfully'], 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Position not found'], 404);
        }
    }
}
?>