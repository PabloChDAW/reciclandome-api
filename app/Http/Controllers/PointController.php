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

    public function index()
    {
        return Point::with('user')->latest()->get();
    }


    public function store(Request $request)
    {
        $fields = $request->validate([
            'latitude' => 'required|numeric|min:-90|max:90',
            'longitude' => 'required|numeric|min:-180|max:180',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'url' => 'nullable|url|max:255',
        ]);

        $point = $request->user()->points()->create($fields);

        return ['point' => $point, 'user' => $point->user];
    }


    public function show(Point $point)
    {
        return ['point' => $point, 'user' => $point->user];
    }


    public function update(Request $request, Point $point)
    {
        // Aplica la política de acceso.
        Gate::authorize('modify', $point);

        $fields = $request->validate([
            'latitude' => 'required|numeric|min:-90|max:90',
            'longitude' => 'required|numeric|min:-180|max:180',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'url' => 'nullable|url|max:255',
        ]);

        $point->update($fields);

        return ['point' => $point, 'user' => $point->user];
    }


    public function destroy(Point $point)
    {
        Gate::authorize('modify', $point);

        $point->delete();

        return ['message' => 'El punto ha sido eliminado.'];
    }
}
