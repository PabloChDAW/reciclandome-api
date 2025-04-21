<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    /** @use HasFactory<\Database\Factories\PointFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
    ];

    /**
     * Devuelve los puntos de un de un tipo (de basura reciclable) específico.
     */
    public function points()
    {
        return $this->belongsToMany(Point::class);
    }
}
