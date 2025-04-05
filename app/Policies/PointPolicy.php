<?php

namespace App\Policies;

use App\Models\Point;
use App\Models\User;
use Illuminate\Auth\Access\Response;

/**
 * Políticas de acceso.
 */
class PointPolicy
{
    /**
     * Evita que un point pueda ser manipulado por un usuario que no sea su creador.
     * TODO: Añadir alternativa con user->isAdmin == true cuando el campo esté en la BBDD
     */
    public function modify(User $user, Point $point): Response
    {
        return $user->id === $point->user_id
            ? Response::allow()
            : Response::deny('Acceso denegado: Este punto pertenece a otro usuario.');
    }
    
}
