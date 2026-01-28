<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = auth()->user();

        if (!$user) {
            abort(403);
        }

        foreach ($roles as $role) {
            if ($role === 'admin' && $user->group_id == 1) {
                return $next($request);
            }

            if ($role === 'op_bidang' && $user->group_id == 4) {
                return $next($request);
            }

            if ($role === 'op_usc' && $user->group_id == 13) {
                return $next($request);
            }
        }

        abort(403, 'Anda tidak memiliki akses.');
    }

}
