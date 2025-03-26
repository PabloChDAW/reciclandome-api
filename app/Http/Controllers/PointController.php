<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Point::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'longitude' => 'required|numeric|min:-180|max:180',
            'latitude' => 'required|numeric|min:-90|max:90',
        ]);

        $point = Point::create($fields);

        return $point;
    }

    /**
     * Display the specified resource.
     */
    public function show(Point $point)
    {
        return $point;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Point $point)
    {
        $fields = $request->validate([
            'longitude' => 'required|numeric|min:-180|max:180',
            'latitude' => 'required|numeric|min:-90|max:90',
        ]);

        $point->update($fields);

        return $point;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Point $point)
    {
        $point->delete();

        return ['message' => 'El punto ha sido borrado.'];
    }
}
