<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class PointController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }

    /**
     * Muestra todos los puntos almacenados en la base de datos.
     */
    public function index()
    {
        return Point::with(['user', 'types'])->latest()->get();
    }


    /**
     * Almacena un nuevo punto asociado a un usuario.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'latitude' => 'required|numeric|min:-90|max:90',
            'longitude' => 'required|numeric|min:-180|max:180',
            'city' => 'required|string|max:255',
            'point_type' => 'sometimes|nullable|string|max:50',
            'place_type' => 'sometimes|nullable|string|max:50',
            'name' => 'sometimes|nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'phone' => 'sometimes|nullable|string|max:20',
            'way' => 'nullable|string|max:255',
            'email' => 'sometimes|nullable|email|max:255',
            'region' => 'sometimes|nullable|string|max:100',
            'country' => 'sometimes|nullable|string|max:100',
            'postcode' => 'sometimes|nullable|string|max:20',
            'description' => 'sometimes|nullable|string|max:255',
            'url' => 'sometimes|nullable|string|max:255',
            'type_ids' => 'sometimes|array',
            'type_ids.*' => 'integer|exists:types,id',
        ]);

        $point = $request->user()->points()->create($fields);

        if (!empty($fields['type_ids'])) {
            $point->types()->attach($fields['type_ids']);
        }

        $point->load(['user', 'types']);

        return response()->json(['point' => $point], 201);
    }


    /**
     * Muestra los datos de un punto específico.
     */
    public function show(Point $point)
    {
        return ['point' => $point, 'user' => $point->user];
    }

    /**
     * Actualiza los datos de un punto específico.
     * Aplica políticas de acceso para que el punto sólo pueda ser
     * modificado por el usuario que lo creó.
     */
    /**
     * Actualiza un punto existente.
     */
    public function update(Request $request, Point $point)
    {
        // Aplica la política de acceso
        Gate::authorize('modify', $point);

        $fields = $request->validate([
            'latitude' => 'required|numeric|min:-90|max:90',
            'longitude' => 'required|numeric|min:-180|max:180',
            'city' => 'required|string|max:255',
            'point_type' => 'sometimes|nullable|string|max:50',
            'place_type' => 'sometimes|nullable|string|max:50',
            'name' => 'sometimes|nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'phone' => 'sometimes|nullable|string|max:20',
            'way' => 'nullable|string|max:255',
            'email' => 'sometimes|nullable|email|max:255',
            'region' => 'sometimes|nullable|string|max:100',
            'country' => 'sometimes|nullable|string|max:100',
            'postcode' => 'sometimes|nullable|string|max:20',
            'description' => 'sometimes|nullable|string|max:255',
            'url' => 'sometimes|nullable|string|max:255',
            'type_ids' => 'sometimes|array',
            'type_ids.*' => 'integer|exists:types,id',
        ]);

        $point->update($fields);

    if (isset($fields['type_ids'])) {
        $point->types()->sync($fields['type_ids']);
    }

    $point->load(['user', 'types']);

    return response()->json(['point' => $point]);
    
    }


    /**
     * Elimina un punto específico.
     * Aplica políticas de acceso para que el punto sólo pueda ser
     * eliminado por el usuario que lo creó.
     */
    public function destroy(Point $point)
    {
        // Aplica la política de acceso.
        Gate::authorize('modify', $point);

        $point->delete();

        return ['message' => 'El punto ha sido eliminado.'];
    }
}
