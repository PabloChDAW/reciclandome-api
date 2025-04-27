<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\Response;


//Esto lo creamos porque nos hace falta hacer un modify nuevo para nuestros pedidos
/**
 * Políticas de acceso.
 */
class OrderPolicy
{
    /**
     * Evita que un point pueda ser manipulado por un usuario que no sea su creador.
     */
    public function modify(User $user, Order $order): Response
    {
        return $user->id === $order->user_id
            ? Response::allow()
            : Response::deny('Acceso denegado: Este punto pertenece a otro usuario.');
    }
}
