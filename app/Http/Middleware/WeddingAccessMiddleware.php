<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\Wedding;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class WeddingAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $userId = Auth::id();

        $wedding = Wedding::where('unique_code', app('currentWedding'))->get();
        $user = User::where('id', $userId)->get();

        //checks of the current user is an admin
        if ($user[0]->user_role != 1) {

            //if not the user will not be able to access another persons wedding
            if ($userId !== $wedding[0]->user_id) {
                return redirect('/');
            }
        }

        return $next($request);
    }
}
