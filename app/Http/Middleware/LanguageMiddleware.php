<?php

namespace App\Http\Middleware;

use App\Models\SiteSettings;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class LanguageMiddleware
{
    public function handle($request, Closure $next)
    {
        $language = SiteSettings::query()->where('key', 'language')->first();
        if ($language) {
            App::setLocale($language->value);
        }
        return $next($request);
    }
}
