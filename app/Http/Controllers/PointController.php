<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

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
        return Point::all();
    }

    /**
     * Almacena un nuevo punto asociado a un usuario.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'latitude' => 'required|numeric|min:-90|max:90',
            'longitude' => 'required|numeric|min:-180|max:180',
        ]);

        $point = $request->user()->points()->create($fields);

        return ['point' => $point, 'user' => $point->user];
    }

    /**
     * Muestra los datos de un punto específico.
     */
    public function show(Point $point)
    {
        return $point;
    }

    /**
     * Actualiza los datos de un punto específico.
     * Aplica políticas de acceso para que el punto sólo pueda ser
     * modificado por el usuario que lo creó.
     */
    public function update(Request $request, Point $point)
    {
        // Aplica la política de acceso.
        Gate::authorize('modify', $point);

        $fields = $request->validate([
            'longitude' => 'required|numeric|min:-180|max:180',
            'latitude' => 'required|numeric|min:-90|max:90',
        ]);

        $point->update($fields);

        return $point;
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
