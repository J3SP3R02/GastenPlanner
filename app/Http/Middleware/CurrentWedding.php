<?php

namespace App\Http\Middleware;

use Closure;

class CurrentWedding
{
    public function handle($request, Closure $next)
    {
        $uniqueCode = $request->route()->parameter('unique_code');

        // Set the current wedding in the application container
        app()->singleton('currentWedding', function () use ($uniqueCode) {
            return $uniqueCode;
        });

        // Set the current wedding ID in the application container
        app()->singleton('currentWeddingId', function () {
            $wedding = new \App\Models\Wedding();
            return $wedding->where('unique_code', '=', app('currentWedding'))->value('id');
        });

        // Set the current guestlist ID in the application container
        app()->singleton('currentGuestlistId', function () {
            $wedding = new \App\Models\Wedding();
            return $wedding->where('unique_code', '=', app('currentWedding'))->value('guestlist_id');
        });

        return $next($request);
    }
}
