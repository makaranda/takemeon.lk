<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        //$routeName = $request->route()->getName(); // Get the current route name
        $macAddress = exec('getmac');
        $ipAddress = $request->ip();
        $route = request()->route();
        $routeName = $route ? $route->getName() : 'unknown';
        dd($request->route()->getAction());
        dd($routeName);

        if (!$routeName) {
            //return $next($request); // Skip if no route name
        }

        // Check if the visitor entry exists
        $visitor = DB::table('visitors_counts')
            ->where('route_name', $routeName)
            ->where(function ($query) use ($macAddress, $ipAddress) {
                $query->where('mac_address', $macAddress)
                      ->orWhere('ip_address', $ipAddress);
            })
            ->first();

        if ($visitor) {
            DB::table('visitors_counts')->where('id', $visitor->id)->increment('count');
        } else {
            DB::table('visitors_counts')->insert([
                'route_name' => $routeName,
                'count'      => 1,
                'mac_address' => $macAddress,
                'ip_address' => $ipAddress,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return $next($request);
    }
}
