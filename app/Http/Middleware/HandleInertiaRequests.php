<?php

namespace App\Http\Middleware;

use App\Support\LocalizedRoutePaths;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'auth' => [
                'user' => $request->user(),
            ],
            'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',
            'locale' => fn () => app()->getLocale(),
            'fallback_locale' => fn () => config('app.fallback_locale'),
            'locales' => fn () => config('locales.supported'),
            'locale_urls' => fn () => collect(LaravelLocalization::getSupportedLanguagesKeys())
                ->mapWithKeys(fn (string $loc): array => [$loc => LaravelLocalization::getLocalizedURL($loc)])
                ->all(),
            'url_route_defaults' => fn () => array_merge(
                ['locale' => app()->getLocale()],
                LocalizedRoutePaths::urlDefaultsForLocale(app()->getLocale()),
            ),
        ];
    }
}
