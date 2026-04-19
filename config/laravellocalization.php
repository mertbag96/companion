<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Supported locales (authoritative list for mcamara/laravel-localization)
    |--------------------------------------------------------------------------
    |
    | Labels for the language switcher are derived in config/locales.php from
    | the `native` field. Keep app.locale and fallback_locale aligned with this list.
    |
    */

    'supportedLocales' => [
        'en' => ['name' => 'English', 'script' => 'Latn', 'native' => 'English', 'regional' => 'en_GB'],
        'tr' => ['name' => 'Turkish', 'script' => 'Latn', 'native' => 'Türkçe', 'regional' => 'tr_TR'],
        'fr' => ['name' => 'French', 'script' => 'Latn', 'native' => 'Français', 'regional' => 'fr_FR'],
        'de' => ['name' => 'German', 'script' => 'Latn', 'native' => 'Deutsch', 'regional' => 'de_DE'],
        'es' => ['name' => 'Spanish', 'script' => 'Latn', 'native' => 'Español', 'regional' => 'es_ES'],
    ],

    // Use app locale and explicit / → /{app.locale}/ redirects; avoids extra Accept-Language redirects in tests.
    'useAcceptLanguageHeader' => false,

    'hideDefaultLocaleInURL' => false,

    'localesOrder' => ['en', 'tr', 'fr', 'de', 'es'],

    'localesMapping' => [],

    'utf8suffix' => env('LARAVELLOCALIZATION_UTF8SUFFIX', '.UTF-8'),

    'urlsIgnored' => [],

    'httpMethodsIgnored' => ['POST', 'PUT', 'PATCH', 'DELETE'],
];
