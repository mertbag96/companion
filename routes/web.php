<?php

use App\Actions\LoadTranslationsAction;
use App\Support\LocalizedRoutePaths;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', fn () => redirect()->route('home', ['locale' => config('app.locale')]));

Route::prefix('{locale}')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Home', [
            'canRegister' => Features::enabled(Features::registration()),
            'translations' => app(LoadTranslationsAction::class)->handle(['website', 'footer', 'header']),
        ]);
    })->name('home');

    LaravelLocalization::transRoute('routes.dashboard');

    Route::get(
        '{dashboardSlug}',
        fn () => Inertia::render('Dashboard')
    )->middleware(['auth', 'verified'])
        ->where('dashboardSlug', LocalizedRoutePaths::pattern('routes.dashboard'))
        ->name('dashboard');

    require __DIR__.'/settings.php';
});
