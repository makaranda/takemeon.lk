<?php

namespace App\Observers;

use App\Models\VisitorsCount;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VisitorCountObserver
{
    public function created(VisitorsCount $visitor)
    {
        $this->updateVisitorCount($visitor);
    }

    public function updated(VisitorsCount $visitor)
    {
        $this->updateVisitorCount($visitor);
    }

    protected function updateVisitorCount(VisitorsCount $visitor)
    {
        $routeName = Route::currentRouteName();
        $ipAddress = request()->ip();
        $macAddress = $this->getMacAddress();

        Log::info("Processing visitor count update for route: $routeName, IP: $ipAddress");

        // Check if route already exists
        $existingRecord = VisitorsCount::where('route_name', $routeName)->first();

        if ($existingRecord) {
            // Update the existing count
            Log::info("Existing route found. Incrementing count for: $routeName");
            $existingRecord->increment('count');
            $existingRecord->update([
                'ip_address' => $ipAddress,
                'mac_address' => $macAddress,
                'updated_at' => now(),
            ]);
        } else {
            // Create new entry
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

    private function getMacAddress()
    {
        return exec('getmac') ?: null; // Get MAC address or return null if unavailable
    }
}
