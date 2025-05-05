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
        return Point::with('user')->latest()->get();
    }

    /**
     * Almacena un nuevo punto asociado a un usuario.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'latitude' => 'required|numeric|min:-90|max:90',
            'longitude' => 'required|numeric|min:-180|max:180',
            //'city' => 'required|string|max:255', Se puede extraer con geocodificación inversa de maptiler
            //'address' => 'required|string|max:255', Se puede extraer con geocodificación inversa de maptiler
            //'telephone' => 'sometimes|nullable|string|max:20', Debería ser el del usuario
            //'email' => 'sometimes|nullable|email|max:255', Debería ser el del usuario
            //'url' => 'sometimes|nullable|url|max:255', La Url del punto se puede generar con una función y/o concatenando
            //TODO Implementar esto en el front, pero mientras tanto para que funcione:

            
        ]);
        $fields['city'] = 'sanpitopato';
        $fields['address'] = 'sanpitopato';
        $fields['address'] = 'sanpitopato';
        $fields['telephone'] = 'sanpitopato';
        $fields['email'] = 'sanpitopato@sanp.com';
        $fields['url'] = 'sanpitopato';
        $point = $request->user()->points()->create($fields);

        return response()->json(['point' => $point, 'user' => $point->user], 201);
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
    public function update(Request $request, Point $point)
    {
        // Aplica la política de acceso.
        Gate::authorize('modify', $point);

        $fields = $request->validate([
            'longitude' => 'required|numeric|min:-180|max:180',
            'latitude' => 'required|numeric|min:-90|max:90',
        ]);

        $point->update($fields);

        return ['point' => $point, 'user' => $point->user];
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
