<?php

namespace App\Http\Middleware;

use App\Contracts\CanHaveRoles;
use App\Enums\RoleType;
use Closure;
use Illuminate\Http\Request;

class AdminOnlyAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        abort_unless($this->accessGranted($request), '403', 'Sorry, this is an admin-only area.');

        return $next($request);
    }

    /**
     * @param Request $request
     * @return bool
     */
    private function accessGranted(Request $request): bool
    {
        $user = $request->user();

        return (! ($user instanceof CanHaveRoles) || $user->hasRole(RoleType::Admin));
    }
}
