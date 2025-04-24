<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\PointFactory> */
    use HasFactory;

    protected $fillable = [
        'total',
        'status',
        'address',
    ];

    /**
     * Devuelve el usuario de un pedido específico.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Devuelve los productos de un pedido específico.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
