<?php

use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Settings\SecurityController;
use App\Support\LocalizedRoutePaths;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

LaravelLocalization::transRoute('routes.settings_segment');
LaravelLocalization::transRoute('routes.settings_profile_b');
LaravelLocalization::transRoute('routes.settings_security_b');
LaravelLocalization::transRoute('routes.settings_appearance_b');
LaravelLocalization::transRoute('routes.settings_password_segment');

Route::middleware(['auth'])->group(function () {
    Route::get(
        '{settingsSlug}',
        fn () => redirect()->route('profile.edit')
    )->where('settingsSlug', LocalizedRoutePaths::pattern('routes.settings_segment'));

    Route::get(
        '{settingsSlug}/{profileSegment}',
        [ProfileController::class, 'edit']
    )->where([
        'settingsSlug' => LocalizedRoutePaths::pattern('routes.settings_segment'),
        'profileSegment' => LocalizedRoutePaths::pattern('routes.settings_profile_b'),
    ])->name('profile.edit');

    Route::patch(
        '{settingsSlug}/{profileSegment}',
        [ProfileController::class, 'update']
    )->where([
        'settingsSlug' => LocalizedRoutePaths::pattern('routes.settings_segment'),
        'profileSegment' => LocalizedRoutePaths::pattern('routes.settings_profile_b'),
    ])->name('profile.update');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::delete(
        '{settingsSlug}/{profileSegment}',
        [ProfileController::class, 'destroy']
    )->where([
        'settingsSlug' => LocalizedRoutePaths::pattern('routes.settings_segment'),
        'profileSegment' => LocalizedRoutePaths::pattern('routes.settings_profile_b'),
    ])->name('profile.destroy');

    Route::get(
        '{settingsSlug}/{securitySegment}',
        [SecurityController::class, 'edit']
    )->where([
        'settingsSlug' => LocalizedRoutePaths::pattern('routes.settings_segment'),
        'securitySegment' => LocalizedRoutePaths::pattern('routes.settings_security_b'),
    ])->name('security.edit');

    Route::put(
        '{settingsSlug}/{passwordSegment}',
        [SecurityController::class, 'update']
    )->middleware('throttle:6,1')
        ->where([
            'settingsSlug' => LocalizedRoutePaths::pattern('routes.settings_segment'),
            'passwordSegment' => LocalizedRoutePaths::pattern('routes.settings_password_segment'),
        ])
        ->name('user-password.update');

    Route::get(
        '{settingsSlug}/{appearanceSegment}',
        fn () => Inertia::render('settings/Appearance')
    )->where([
        'settingsSlug' => LocalizedRoutePaths::pattern('routes.settings_segment'),
        'appearanceSegment' => LocalizedRoutePaths::pattern('routes.settings_appearance_b'),
    ])->name('appearance.edit');
});
