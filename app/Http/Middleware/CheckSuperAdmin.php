<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class CheckSuperAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()->isSuperAdmin()) {
            return redirect()->back()->with('error', 'Vous n\'avez pas les permissions nécessaires.');
        }

        return $next($request);
    }
}
