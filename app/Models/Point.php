<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    /** @use HasFactory<\Database\Factories\PointFactory> */
    use HasFactory;

    protected $fillable = [
        'latitude',
        'longitude',
        'point_type',
        'place_type',
        'name',
        'address',
        'city',
        'region',
        'country',
        'postcode',
        'phone',
        'email',
        'url',
        'way',
        'description',
        
    ];

    /**
     * Devuelve el usuario de un punto específico.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Devuelve los tipos (de basura reciclable) de un punto específico.
     */
    public function types()
    {
        return $this->belongsToMany(Type::class);
    }
}
