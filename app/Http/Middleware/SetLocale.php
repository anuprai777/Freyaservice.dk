<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // 1. Direct query parameter override (?locale=en or ?lang=da)
        $queryLocale = $request->query('locale') ?? $request->query('lang');
        if ($queryLocale && in_array($queryLocale, ['da', 'en'], true)) {
            $locale = $queryLocale;
            Session::put('locale', $locale);
            if ($user && $user->locale !== $locale) {
                $user->forceFill(['locale' => $locale])->save();
            }
        } else {
            // 2. Session locale preferred, then authenticated user preference, then default
            $locale = Session::get('locale') ?? $user?->locale ?? config('app.locale', 'da');
        }

        if (in_array($locale, ['da', 'en'], true)) {
            App::setLocale($locale);

            if (!Session::has('locale') || Session::get('locale') !== $locale) {
                Session::put('locale', $locale);
            }

            if ($user && $user->locale !== $locale) {
                $user->forceFill(['locale' => $locale])->save();
            }
        }

        return $next($request);
    }
}
