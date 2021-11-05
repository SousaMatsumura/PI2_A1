<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Services\UserService;

class InstitutionType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $type)
    {
        $institutionType = Auth::user()->institution->type;

        if($institutionType !== $type) {
            return redirect(UserService::getDashboardRouteBasedOnUserInstitutionType($institutionType));
        }

        return $next($request);
    }
}
