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
            new Middleware('auth:sanctum', except: ['index', 'show', 'filter'])
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
            'place_type' => 'nullable|string|max:50',
            'name' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'way' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'region' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'postcode' => 'nullable|string|max:20',
            'description' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
            'types' => 'required|array|min:1',
            'types.*' => 'exists:types,id',
        ]);

        if ($fields['place_type'] == 'continental_marine' && $fields['way'] == 'continental_marine'
        && $fields['country'] == null) {
            return response()->json([
            'errors' => 'No puedes crear un punto de reciclaje ahí. ¿Acaso está en mitad de la nada?',
            'lugarVacio' => true
            ], 422);
        }

        $point = $request->user()->points()->create($fields);

        if (!empty($fields['types'])) {
            $point->types()->attach($fields['types']);
        }

        $point->load(['user', 'types']);

        return response()->json(['point' => $point], 201);
    }


    /**
     * Muestra los datos de un punto específico.
     */
    public function show(Point $point)
    {
        $point->load(['types', 'user']);
        return ['point' => $point];
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
            'place_type' => 'nullable|string|max:50',
            'name' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'way' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'region' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'postcode' => 'nullable|string|max:20',
            'description' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
            'types' => 'required|array|min:1',
            'types.*' => 'exists:types,id',
        ]);

    $point->update($fields);

    if (isset($fields['types'])) {
        $point->types()->sync($fields['types']);
    }

    $point->load(['user','types']);

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

    /**
     * Filtra y ordena puntos con múltiples criterios
     *
     * Parámetros aceptados:
     * - filters: city, point_type, place_type, name, way
     * - order_by: name, type (point_type), created_at
     * - order_direction: asc, desc (opcional, default: asc)
     *
     * Ejemplos:
     * /api/points/filter?filters[city]=Madrid&order_by=name&order_direction=desc
     * /api/points/filter?filters[point_type]=recycling&filters[way]=street
     */
    public function filter(Request $request)
    {
        $query = Point::query()->with(['user', 'types']);

        $filters = $request->input('filters');
        if (is_string($filters)) {
            $filters = json_decode($filters, true);
        }
        // Aplicar filtros
        if ($filters && is_array($filters)) {
            if (isset($filters['user']) && $filters['user'] === 'me') {
                $token = $request->bearerToken();

                if (!$token) {
                    return response()->json(['error' => 'Token requerido para filtrar por usuario'], 401);
                }

                try {
                    // Obtiene el usuario desde el token manualmente
                    $user = \Laravel\Sanctum\PersonalAccessToken::findToken($token)?->tokenable;

                    if (!$user) {
                        return response()->json(['error' => 'Token inválido'], 401);
                    }

                    $query->where('user_id', $user->id);

                } catch (\Exception $e) {
                    return response()->json(['error' => 'Error de autenticación'], 401);
                }
            }

            // Filtro por ciudad (búsqueda parcial)
            if (isset($filters['city'])) {
                $query->where('city', 'like', '%'.$filters['city'].'%');
            }

            // Filtro por tipo de punto
            if (!empty($filters['types']) && is_array($filters['types'])) {
                $typeIds = array_filter(array_map('intval', $filters['types']));
                
                if (!empty($typeIds)) {
                    // Contar cuántos tipos estamos filtrando
                    $typesCount = count($typeIds);
                    
                    $query->whereHas('types', function($q) use ($typeIds) {
                        $q->whereIn('types.id', $typeIds);
                    }, '>=', $typesCount); // Debe tener al menos $typesCount coincidencias
                }
            }

            // Filtro por tipo de lugar
            if (isset($filters['place_type'])) {
                $query->where('place_type', $filters['place_type']);
            }

            // Filtro por nombre (búsqueda parcial)
            if (isset($filters['name'])) {
                $query->where('name', 'like', '%'.$filters['name'].'%');
            }

            // Filtro por vía
            if (isset($filters['way'])) {
                $query->where('way', $filters['way']);
            }
        }

        // Aplicar ordenación
        $orderBy = $request->input('order_by', 'created_at');
        $orderDirection = $request->input('order_direction', 'desc');

        switch ($orderBy) {
            case 'name':
            case 'created_at':
                $query->orderBy($orderBy, $orderDirection);
                break;
            case 'types': // alias para point_type
                $query->join('point_type', 'points.id', '=', 'point_type.point_id')
                    ->join('types', 'point_type.type_id', '=', 'types.id')
                    ->orderBy('types.name', $orderDirection)
                    ->select('points.*')
                    ->distinct();
                break;
            case 'date': // alias para created_at
                $query->orderBy('created_at', $orderDirection);
                break;
            default:
                $query->latest();
        }

        return $query->get();
    }

}
