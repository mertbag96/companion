<?php

namespace App\Support;

use Mcamara\LaravelLocalization\LaravelLocalization;

/**
 * Builds regex alternates from lang/{locale}/routes.php so one named route can match
 * every localized slug (e.g. login|giris-yap) without duplicate route names.
 */
final class LocalizedRoutePaths
{
    /**
     * Wildcard route parameter names → translation keys (routes.*) for URL::defaults / Wayfinder.
     *
     * @return array<string, string>
     */
    public static function urlParameterKeyMap(): array
    {
        return [
            'loginSlug' => 'routes.login',
            'logoutSlug' => 'routes.logout',
            'registerSlug' => 'routes.register',
            'forgotSlug' => 'routes.password_request',
            'resetPrefix' => 'routes.password_reset_prefix',
            'verificationSegmentA' => 'routes.verification_a',
            'verificationSegmentB' => 'routes.verification_b',
            'verificationNotificationSegment' => 'routes.verification_notification_b',
            'userSegment' => 'routes.user_segment',
            'confirmPasswordSegment' => 'routes.user_confirm_password_b',
            'confirmedPasswordStatusSegment' => 'routes.user_confirmed_password_status_b',
            'twoFactorAuthSegment' => 'routes.user_two_factor_authentication_b',
            'confirmedTwoFactorSegment' => 'routes.user_confirmed_two_factor_b',
            'qrSegment' => 'routes.user_two_factor_qr_b',
            'secretSegment' => 'routes.user_two_factor_secret_b',
            'recoverySegment' => 'routes.user_two_factor_recovery_b',
            'twoFactorChallengeSlug' => 'routes.two_factor_challenge',
            'dashboardSlug' => 'routes.dashboard',
            'settingsSlug' => 'routes.settings_segment',
            'profileSegment' => 'routes.settings_profile_b',
            'securitySegment' => 'routes.settings_security_b',
            'appearanceSegment' => 'routes.settings_appearance_b',
            'passwordSegment' => 'routes.settings_password_segment',
        ];
    }

    /**
     * Defaults for route() / Wayfinder when generating URLs for a given app locale.
     *
     * @return array<string, string>
     */
    public static function urlDefaultsForLocale(string $locale): array
    {
        $defaults = [];
        foreach (self::urlParameterKeyMap() as $param => $key) {
            $defaults[$param] = trans($key, [], $locale);
        }

        return $defaults;
    }

    /**
     * @param  string  $key  Translation key, e.g. "routes.login"
     */
    public static function pattern(string $key): string
    {
        $alternates = [];
        foreach (app(LaravelLocalization::class)->getSupportedLanguagesKeys() as $locale) {
            $alternates[] = preg_quote(trans($key, [], $locale), '/');
        }

        return implode('|', array_unique($alternates));
    }
}
