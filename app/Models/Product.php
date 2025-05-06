<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\PointFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
    ];

    /**
     * Devuelve los pedidos de un producto específico.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class)
                    ->withPivot('quantity');
    }
}
