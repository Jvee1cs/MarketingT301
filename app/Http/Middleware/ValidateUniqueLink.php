<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Link;
class ValidateUniqueLink
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $uniqueIdentifier = $request->route('uniqueIdentifier');
        $link = Link::where('unique_identifier', $uniqueIdentifier)->first();

        if (!$link || !$link->is_active || $link->expires_at < now()) {
            abort(404);
        }

        return $next($request);
    }
}
