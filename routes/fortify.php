<?php

use App\Support\LocalizedRoutePaths;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;
use Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController;
use Laravel\Fortify\Http\Controllers\ConfirmedTwoFactorAuthenticationController;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\RecoveryCodeController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController;
use Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController;
use Laravel\Fortify\Http\Controllers\TwoFactorSecretKeyController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

$enableViews = config('fortify.views', true);
$guard = config('fortify.guard');
$authMiddleware = config('fortify.auth_middleware', 'auth').':'.$guard;
$limiter = config('fortify.limiters.login');
$twoFactorLimiter = config('fortify.limiters.two-factor');
$verificationLimiter = config('fortify.limiters.verification', '6,1');

$registerTrans = static function (string ...$keys): void {
    foreach ($keys as $key) {
        LaravelLocalization::transRoute($key);
    }
};

/*
|--------------------------------------------------------------------------
| Order matters: register more specific (multi-segment) routes before generic
| single-segment routes (login, register, etc.).
|--------------------------------------------------------------------------
*/

// Signed email verification link (must be registered before the 2-segment notice route).
if (Features::enabled(Features::emailVerification())) {
    $registerTrans('routes.verification_a', 'routes.verification_b');

    Route::get(
        '{verificationSegmentA}/{verificationSegmentB}/{id}/{hash}',
        [VerifyEmailController::class, '__invoke']
    )->middleware([$authMiddleware, 'signed', 'throttle:'.$verificationLimiter])
        ->where([
            'verificationSegmentA' => LocalizedRoutePaths::pattern('routes.verification_a'),
            'verificationSegmentB' => LocalizedRoutePaths::pattern('routes.verification_b'),
            'id' => '[0-9]+',
            'hash' => '[^/]+',
        ])
        ->name('verification.verify');
}

// Password reset (prefix used by GET reset form + POST new password).
if (Features::enabled(Features::resetPasswords())) {
    $registerTrans('routes.password_reset_prefix');
}

// Password reset form (GET).
if (Features::enabled(Features::resetPasswords()) && $enableViews) {
    Route::get(
        '{resetPrefix}/{token}',
        [NewPasswordController::class, 'create']
    )->middleware(['guest:'.$guard])
        ->where([
            'resetPrefix' => LocalizedRoutePaths::pattern('routes.password_reset_prefix'),
            'token' => '[^/]+',
        ])
        ->name('password.reset');
}

// Email verification prompt (same first two segments as the signed URL, without id/hash).
if (Features::enabled(Features::emailVerification()) && $enableViews) {
    Route::get(
        '{verificationSegmentA}/{verificationSegmentB}',
        [EmailVerificationPromptController::class, '__invoke']
    )->middleware([$authMiddleware])
        ->where([
            'verificationSegmentA' => LocalizedRoutePaths::pattern('routes.verification_a'),
            'verificationSegmentB' => LocalizedRoutePaths::pattern('routes.verification_b'),
        ])
        ->name('verification.notice');
}

// Forgot password (GET) + link request (POST) share one slug.
if (Features::enabled(Features::resetPasswords())) {
    $registerTrans('routes.password_request');

    Route::get(
        '{forgotSlug}',
        [PasswordResetLinkController::class, 'create']
    )->middleware(['guest:'.$guard])
        ->where('forgotSlug', LocalizedRoutePaths::pattern('routes.password_request'))
        ->name('password.request');

    Route::post(
        '{forgotSlug}',
        [PasswordResetLinkController::class, 'store']
    )->middleware(['guest:'.$guard])
        ->where('forgotSlug', LocalizedRoutePaths::pattern('routes.password_request'))
        ->name('password.email');
}

// Submit new password (POST) — one segment, same prefix as reset form.
if (Features::enabled(Features::resetPasswords())) {
    Route::post(
        '{resetPrefix}',
        [NewPasswordController::class, 'store']
    )->middleware(['guest:'.$guard])
        ->where('resetPrefix', LocalizedRoutePaths::pattern('routes.password_reset_prefix'))
        ->name('password.update');
}

// Resend verification email (POST).
if (Features::enabled(Features::emailVerification())) {
    $registerTrans('routes.verification_notification_b');

    Route::post(
        '{verificationSegmentA}/{verificationNotificationSegment}',
        [EmailVerificationNotificationController::class, 'store']
    )->middleware([$authMiddleware, 'throttle:'.$verificationLimiter])
        ->where([
            'verificationSegmentA' => LocalizedRoutePaths::pattern('routes.verification_a'),
            'verificationNotificationSegment' => LocalizedRoutePaths::pattern('routes.verification_notification_b'),
        ])
        ->name('verification.send');
}

// Password confirmation views + POST.
if ($enableViews) {
    $registerTrans('routes.user_segment', 'routes.user_confirm_password_b');

    Route::get(
        '{userSegment}/{confirmPasswordSegment}',
        [ConfirmablePasswordController::class, 'show']
    )->middleware([$authMiddleware])
        ->where([
            'userSegment' => LocalizedRoutePaths::pattern('routes.user_segment'),
            'confirmPasswordSegment' => LocalizedRoutePaths::pattern('routes.user_confirm_password_b'),
        ])
        ->name('password.confirm');
}

$registerTrans('routes.user_segment', 'routes.user_confirmed_password_status_b');

Route::get(
    '{userSegment}/{confirmedPasswordStatusSegment}',
    [ConfirmedPasswordStatusController::class, 'show']
)->middleware([$authMiddleware])
    ->where([
        'userSegment' => LocalizedRoutePaths::pattern('routes.user_segment'),
        'confirmedPasswordStatusSegment' => LocalizedRoutePaths::pattern('routes.user_confirmed_password_status_b'),
    ])
    ->name('password.confirmation');

Route::post(
    '{userSegment}/{confirmPasswordSegment}',
    [ConfirmablePasswordController::class, 'store']
)->middleware([$authMiddleware])
    ->where([
        'userSegment' => LocalizedRoutePaths::pattern('routes.user_segment'),
        'confirmPasswordSegment' => LocalizedRoutePaths::pattern('routes.user_confirm_password_b'),
    ])
    ->name('password.confirm.store');

// Two-factor management (2-segment paths — before generic 1-segment auth routes).
if (Features::enabled(Features::twoFactorAuthentication())) {
    $twoFactorMiddleware = Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword')
        ? [$authMiddleware, 'password.confirm']
        : [$authMiddleware];

    $registerTrans(
        'routes.user_segment',
        'routes.user_two_factor_authentication_b',
        'routes.user_confirmed_two_factor_b',
        'routes.user_two_factor_qr_b',
        'routes.user_two_factor_secret_b',
        'routes.user_two_factor_recovery_b',
    );

    Route::post(
        '{userSegment}/{twoFactorAuthSegment}',
        [TwoFactorAuthenticationController::class, 'store']
    )->middleware($twoFactorMiddleware)
        ->where([
            'userSegment' => LocalizedRoutePaths::pattern('routes.user_segment'),
            'twoFactorAuthSegment' => LocalizedRoutePaths::pattern('routes.user_two_factor_authentication_b'),
        ])
        ->name('two-factor.enable');

    Route::post(
        '{userSegment}/{confirmedTwoFactorSegment}',
        [ConfirmedTwoFactorAuthenticationController::class, 'store']
    )->middleware($twoFactorMiddleware)
        ->where([
            'userSegment' => LocalizedRoutePaths::pattern('routes.user_segment'),
            'confirmedTwoFactorSegment' => LocalizedRoutePaths::pattern('routes.user_confirmed_two_factor_b'),
        ])
        ->name('two-factor.confirm');

    Route::delete(
        '{userSegment}/{twoFactorAuthSegment}',
        [TwoFactorAuthenticationController::class, 'destroy']
    )->middleware($twoFactorMiddleware)
        ->where([
            'userSegment' => LocalizedRoutePaths::pattern('routes.user_segment'),
            'twoFactorAuthSegment' => LocalizedRoutePaths::pattern('routes.user_two_factor_authentication_b'),
        ])
        ->name('two-factor.disable');

    Route::get(
        '{userSegment}/{qrSegment}',
        [TwoFactorQrCodeController::class, 'show']
    )->middleware($twoFactorMiddleware)
        ->where([
            'userSegment' => LocalizedRoutePaths::pattern('routes.user_segment'),
            'qrSegment' => LocalizedRoutePaths::pattern('routes.user_two_factor_qr_b'),
        ])
        ->name('two-factor.qr-code');

    Route::get(
        '{userSegment}/{secretSegment}',
        [TwoFactorSecretKeyController::class, 'show']
    )->middleware($twoFactorMiddleware)
        ->where([
            'userSegment' => LocalizedRoutePaths::pattern('routes.user_segment'),
            'secretSegment' => LocalizedRoutePaths::pattern('routes.user_two_factor_secret_b'),
        ])
        ->name('two-factor.secret-key');

    Route::get(
        '{userSegment}/{recoverySegment}',
        [RecoveryCodeController::class, 'index']
    )->middleware($twoFactorMiddleware)
        ->where([
            'userSegment' => LocalizedRoutePaths::pattern('routes.user_segment'),
            'recoverySegment' => LocalizedRoutePaths::pattern('routes.user_two_factor_recovery_b'),
        ])
        ->name('two-factor.recovery-codes');

    Route::post(
        '{userSegment}/{recoverySegment}',
        [RecoveryCodeController::class, 'store']
    )->middleware($twoFactorMiddleware)
        ->where([
            'userSegment' => LocalizedRoutePaths::pattern('routes.user_segment'),
            'recoverySegment' => LocalizedRoutePaths::pattern('routes.user_two_factor_recovery_b'),
        ])
        ->name('two-factor.regenerate-recovery-codes');
}

// Two-factor login challenge (1 segment).
if (Features::enabled(Features::twoFactorAuthentication()) && $enableViews) {
    $registerTrans('routes.two_factor_challenge');

    Route::get(
        '{twoFactorChallengeSlug}',
        [TwoFactorAuthenticatedSessionController::class, 'create']
    )->middleware(['guest:'.$guard])
        ->where('twoFactorChallengeSlug', LocalizedRoutePaths::pattern('routes.two_factor_challenge'))
        ->name('two-factor.login');

    Route::post(
        '{twoFactorChallengeSlug}',
        [TwoFactorAuthenticatedSessionController::class, 'store']
    )->middleware(array_filter([
        'guest:'.$guard,
        $twoFactorLimiter ? 'throttle:'.$twoFactorLimiter : null,
    ]))->where('twoFactorChallengeSlug', LocalizedRoutePaths::pattern('routes.two_factor_challenge'))
        ->name('two-factor.login.store');
}

// Login & registration (1 segment).
if ($enableViews) {
    $registerTrans('routes.login');

    Route::get(
        '{loginSlug}',
        [AuthenticatedSessionController::class, 'create']
    )->middleware(['guest:'.$guard])
        ->where('loginSlug', LocalizedRoutePaths::pattern('routes.login'))
        ->name('login');
}

Route::post(
    '{loginSlug}',
    [AuthenticatedSessionController::class, 'store']
)->middleware(array_filter([
    'guest:'.$guard,
    $limiter ? 'throttle:'.$limiter : null,
]))->where('loginSlug', LocalizedRoutePaths::pattern('routes.login'))
    ->name('login.store');

if (Features::enabled(Features::registration()) && $enableViews) {
    $registerTrans('routes.register');

    Route::get(
        '{registerSlug}',
        [RegisteredUserController::class, 'create']
    )->middleware(['guest:'.$guard])
        ->where('registerSlug', LocalizedRoutePaths::pattern('routes.register'))
        ->name('register');
}

if (Features::enabled(Features::registration())) {
    Route::post(
        '{registerSlug}',
        [RegisteredUserController::class, 'store']
    )->middleware(['guest:'.$guard])
        ->where('registerSlug', LocalizedRoutePaths::pattern('routes.register'))
        ->name('register.store');
}

$registerTrans('routes.logout');

Route::post(
    '{logoutSlug}',
    [AuthenticatedSessionController::class, 'destroy']
)->middleware([$authMiddleware])
    ->where('logoutSlug', LocalizedRoutePaths::pattern('routes.logout'))
    ->name('logout');
