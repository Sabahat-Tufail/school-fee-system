<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StudentMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role !== 'student') {
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
