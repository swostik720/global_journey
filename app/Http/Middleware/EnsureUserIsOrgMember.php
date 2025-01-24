<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\UserType;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsOrgMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (auth()->check() && in_array(auth()->user()->user_type, [UserType::Admin->value, UserType::SuperAdmin->value, UserType::Staff->value], true)) {
        //     return $next($request);
        // }

        if(auth()->check() && in_array(auth()->user()->user_type, ['SuperAdmin','Admin','Staff'])) {
            return $next($request);
        }

        // return abort(401, 'Not Allowed');
        return redirect()->route('home');
    }
}
