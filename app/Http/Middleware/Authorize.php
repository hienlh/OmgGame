<?php

namespace OmgGame\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Authorize
{
    use AuthorizesRequests;

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param $ability
     * @param array $attributes
     * @return mixed
     * @throws AuthorizationException
     */
    public function handle($request, Closure $next, $ability, $attributes = [])
    {
        $this->authorize($ability, $attributes);

        return $next($request);
    }
}
