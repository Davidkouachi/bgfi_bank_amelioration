<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Events\UserSessionExpired;

class CheckUserActivity
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            $lastActivity = Cache::get('user_last_activity_' . $user->id);

            if ($lastActivity && now()->diffInMinutes($lastActivity) >= 5) {
                event(new UserSessionExpired());
            }
        }

        return $next($request);
    }
}
