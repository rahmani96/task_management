<?php

namespace App\Http\Middleware;

use App\Http\Utilities\ApiResponse;
use Closure;
use Illuminate\Http\Request;

class checkTaskPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        if ($request->user()->can($permission)) {
            return $next($request);
        }
        return ApiResponse::error("error", 'Unauthorized', 403);
    }
}
