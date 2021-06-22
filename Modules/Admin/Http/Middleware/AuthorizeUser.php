<?php

namespace Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthorizeUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // user with "admin" role has all permissions (check AuthServiceProvider)
        $has_permission = rescue(function () use ($request) {
            return (!$request->route()->getName() || $request->route()->getName() == 'home')
                ? true
                : auth()->user()->can($request->route()->getName());
        }, false);
        if (!$has_permission) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => 451,
                    'message' => __('Access denied, you do not have sufficient privileges'),
                ], 451);
            } else {
                toastr()->error(__('Access denied, you do not have sufficient privileges'));

                return back();
            }
        }

        return $next($request);
    }
}
