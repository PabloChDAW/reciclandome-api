<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Point;
use Illuminate\Http\Request;

class TypeController extends Controller
{

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
}
