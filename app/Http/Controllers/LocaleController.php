<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function switch(string $locale, Request $request): RedirectResponse
    {
        if (in_array($locale, ['da', 'en'], true)) {
            Session::put('locale', $locale);
            Session::save();
            App::setLocale($locale);

            if ($user = $request->user()) {
                $user->forceFill(['locale' => $locale])->save();
            }
        }

        // Support explicit safe return_url parameter
        $returnUrl = $request->query('return_url');
        if ($returnUrl && str_starts_with($returnUrl, '/') && !str_starts_with($returnUrl, '//')) {
            return redirect()->to($returnUrl);
        }

        // Context-aware fallback: authenticated users go to their dashboard, guests to home
        $fallback = $request->user() ? route('dashboard') : route('home');
        return redirect()->back(fallback: $fallback);
    }
}
