<?php

namespace App\Http\Middleware;

use App\Models\Profile;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\Response;

class AllowUpdateProfileSettings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $originalToken = Cache::get('edit_profile_data_token:' . $request->profile->id);
        $token = $request->cookie('edit_profile_token');
        if ((!$originalToken && !$token) || ($originalToken !== $token)) {
            return ($request->expectsJson())
                ? response()->json(['message' => 'not allowed'], Response::HTTP_UNAUTHORIZED)
                : redirect()->route('profile.show', $request->profile->id);
        }

        return $next($request);
    }
}
