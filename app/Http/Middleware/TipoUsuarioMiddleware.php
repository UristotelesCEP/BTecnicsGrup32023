<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipoUsuarioMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->tipus_usuaris_id == 3) {
            return $next($request);
        }

        return redirect('/inici');
    }
}

/**
*La siguiente línea de código define la clase del middleware y su método "handle".
*Este método es el que se ejecuta cuando se llama a este middleware durante una solicitud HTTP.
*El método "handle" recibe dos parámetros: $request y $next.

*$request es una instancia de la clase Request que contiene toda la información de la solicitud HTTP actual,
*como los parámetros de la URL y los datos del formulario.

*$next es una función de cierre (closure) que representa la siguiente acción que se debe ejecutar después
*de que se haya procesado el middleware actual. Esta función se pasará a través de cualquier middleware adicional
*y finalmente llegará al controlador de la ruta.

*El siguiente paso es obtener el usuario actualmente autenticado utilizando el método "user()" de la clase Auth.
*Si no hay usuario autenticado, se redirige a la página de inicio.

*Si hay un usuario autenticado, se verifica su tipo de usuario (tipus_usuaris_id).
*En este caso, si el tipo de usuario es igual a 3, significa que es un usuario con acceso permitido
*y se permite el acceso a la ruta solicitada llamando a la función de cierre $next($request).
*Si el usuario no tiene acceso permitido, se redirige a la página de inicio.

*En resumen, este middleware garantiza que solo los usuarios autenticados con un
*tipo de usuario específico (en este caso, 3) puedan acceder a ciertas rutas en la aplicación web.
*Si el usuario no cumple con estos requisitos, se redirige a la página de inicio.
**/
