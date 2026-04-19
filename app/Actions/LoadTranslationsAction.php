<?php

namespace App\Actions;

/**
 * Loads translation groups from PHP lang files for the current locale (for Inertia props).
 */
final class LoadTranslationsAction
{
    /**
     * @param  array<int, string>  $groups  Translation file names without path (e.g. "website", "footer").
     * @return array<string, array<string, mixed>>
     */
    public function handle(array $groups): array
    {
        $translations = [];

        foreach ($groups as $group) {
            $translations[$group] = trans($group);
        }

        return $translations;
    }
}
