<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Point;
use Illuminate\Http\Request;

// TODO Terminar este controlador.
class TypeController extends Controller
{

    // Crear un nuevo type
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'point_ids' => 'array', // array de IDs de puntos
            'point_ids.*' => 'exists:points,id'
        ]);

        $type = Type::create($validated);

        if (!empty($validated['point_ids'])) {
            $type->points()->sync($validated['point_ids']);
        }

        return response()->json($type->load('points'), 201);
    }

    // Mostrar un type específico
    public function show($id)
    {
        $type = Type::with('points')->findOrFail($id);
        return response()->json($type);
    }

    // Actualizar un type existente
    public function update(Request $request, $id)
    {
        $type = Type::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'point_ids' => 'array',
            'point_ids.*' => 'exists:points,id'
        ]);

        $type->update($validated);

        if (isset($validated['point_ids'])) {
            $type->points()->sync($validated['point_ids']);
        }

        return response()->json($type->load('points'));
    }

    // Eliminar un type
    public function destroy($id)
    {
        $type = Type::findOrFail($id);
        $type->points()->detach(); // Borra relaciones
        $type->delete();

        return response()->json(['message' => 'Type deleted']);
    }
    public function index(Request $request)
    {
        $pointId = $request->query('point_id');

        if ($pointId) {
            $point = Point::with('types')->find($pointId);

            if (!$point) {
                return response()->json([
                    'message' => 'Punto no encontrado.'
                ], 404);
            }

            return response()->json($point->types);
        }

        // Si no se proporciona point_id, devolver todos los tipos
        return response()->json(Type::all());
    }

    public function getPointsByType($id)
{
    $type = Type::with('points')->findOrFail($id);

    return response()->json($type->points);
}

}
