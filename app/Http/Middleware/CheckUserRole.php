<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        switch ($user->userRole) {
            case 'ADMIN':
            return redirect()->route('admin.dashboard');
            case 'MANAGER':
            return redirect()->route('manager.dashboard');
            case 'USER':
            return redirect()->route('user.dashboard');
            default:
            return redirect()->route('unauthorized')->with('error', 'Invalid user role.');
        }

        // if ($user && $user->userRole !== 'ACTIVE') {
        //     // Redirect or abort as needed
        //     return redirect()->route('unauthorized')->with('error', 'Your account is not active.');
        // }
        return $next($request);
    }
}
