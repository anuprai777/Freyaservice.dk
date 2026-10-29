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
        $locale = Session::get('locale', $request->user()?->locale ?? config('app.locale', 'da'));

        if (in_array($locale, ['da', 'en'], true)) {
            App::setLocale($locale);

            if ($request->user() && Session::has('locale') && $request->user()->locale !== $locale) {
                $request->user()->update(['locale' => $locale]);
            }
        }

        return $next($request);
    }
}
