<?php

/**
 * UI labels for supported locales (single source: config/laravellocalization.php).
 *
 * @var array<string, string>
 */
return [
    'supported' => collect(config('laravellocalization.supportedLocales'))
        ->map(fn (array $meta): string => $meta['native'])
        ->all(),
];
