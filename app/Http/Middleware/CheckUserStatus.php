<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->userStatus !== 'ACTIVE') {
            // Redirect or abort as needed
            return redirect()->route('unauthorized')->with('error', 'Your account is not active.');
        }

        return $next($request);
    }
}
