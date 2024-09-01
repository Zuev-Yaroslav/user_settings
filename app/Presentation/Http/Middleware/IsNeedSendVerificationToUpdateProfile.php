<?php

namespace App\Presentation\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class IsNeedSendVerificationToUpdateProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $originalToken = Cache::get('token:update_profile:' . $request->profile->id);
        $token = $request->cookie('profile_update_token');
        if (($originalToken && $token) && ($originalToken === $token)) {
            return redirect()->route('profiles.edit', $request->profile->id);
        }

        return $next($request);
    }
}
