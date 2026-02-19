<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        //return $request->expectsJson() ? null : route('admin.login');
        if ($request->expectsJson()) {
            return null;
        }

        // If accessing admin routes
        if ($request->is('admin*')) {
            return route('admin.login');
        }

        // If accessing candidate dashboard
        if ($request->is('candidate-dashboard*')) {
            return route('frontend.userlogin');
        }

        // If accessing customer dashboard
        if ($request->is('customer-dashboard*')) {
            return route('frontend.userlogin');
        }

        // Default fallback
        return route('frontend.userlogin');
    }
}
