<?php

namespace App\Helpers;

use App\Models\VisitorsCount;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

class VisitorHelper
{
    // This method updates the visitor count
    public static function updateVisitorCount()
    {
        // Get the current route name
        $routeName = Route::currentRouteName();
        // Get the user's IP address
        $ipAddress = request()->ip();
        // Get the MAC address (optional)
        $macAddress = self::getMacAddress();

        Log::info("Processing visitor count update for route: $routeName, IP: $ipAddress");

        // Check if a record already exists for this route
        $existingRecord = VisitorsCount::where('route_name', $routeName)->first();

        if ($existingRecord) {
            // Increment count if the route already exists
            Log::info("Existing route found. Incrementing count for: $routeName");
            $existingRecord->increment('count');
            $existingRecord->update([
                'ip_address' => $ipAddress,
                'mac_address' => $macAddress,
                'updated_at' => now(),
            ]);
        } else {
            // Create a new record if the route doesn't exist
            VisitorsCount::create([
                'route_name' => $routeName,
                'count' => 1,
                'mac_address' => $macAddress,
                'ip_address' => $ipAddress,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    // Helper method to get the MAC address (this might not work on all platforms)
    private static function getMacAddress()
    {
        // For simplicity, return a placeholder for now.
        return exec('getmac') ?: null; // This works on Windows but might not work on other platforms.
    }
}
