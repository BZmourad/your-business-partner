<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProtectStorageAccess
{
    public function handle(Request $request, Closure $next){
        if (str_starts_with($request->path(), 'storage/') || str_contains($request->path(), 'storage/') || str_contains($request->path(), "storage\\")) {
            abort(403, 'Accès aux documents non autorisé');
        }
        return $next($request);
    }
}