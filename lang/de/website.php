<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Website Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in the website.
    |
    */

    'meta' => [
        'title' => 'Ihr Business-Begleiter für den Alltag.',
        'description' => 'Ein moderner Begleiter für Unternehmen, die Einfachheit, Struktur und Effizienz schätzen.',
    ],
    'layout' => [
        'footer' => [
            'brand' => 'companion.',
            'copyright' => '© :year Companion. Alle Rechte vorbehalten.',
            'tagline' => 'Ein moderner Begleiter für Unternehmen, die Einfachheit, Struktur und Effizienz schätzen.',
            'columns' => [
                'product' => [
                    'label' => 'Produkt',
                    'links' => [
                        'features' => 'Funktionen',
                        'pricing' => 'Preise',
                    ],
                ],
                'resources' => [
                    'label' => 'Ressourcen',
                    'links' => [
                        'blog' => 'Blog',
                        'help' => 'Hilfe-Center',
                    ],
                ],
                'company' => [
                    'label' => 'Unternehmen',
                    'links' => [
                        'about' => 'Über uns',
                        'contact' => 'Kontakt',
                    ],
                ],
                'legal' => [
                    'label' => 'Rechtliches',
                    'links' => [
                        'privacy' => 'Datenschutz',
                        'terms' => 'Nutzungsbedingungen',
                    ],
                ],
            ],
        ],
        'header' => [
            'nav' => [
                'features' => 'Funktionen',
                'pricing' => 'Preise',
                'about' => 'Über uns',
                'blog' => 'Blog',
                'help' => 'Hilfe-Center',
            ],
            'theme' => [
                'select_aria' => 'Farbschema wählen',
                'light' => 'Hell',
                'dark' => 'Dunkel',
                'system' => 'System',
            ],
            'actions' => [
                'login' => 'Anmelden',
                'get_started' => 'Loslegen',
            ],
        ],
    ],
    'home' => [
        'heading' => 'Startseite',
    ],

    'auth' => [
        'login' => [
            'head_title' => 'Anmelden',
            'layout_title' => 'Bei Ihrem Konto anmelden',
            'layout_description' => 'Geben Sie unten E-Mail und Passwort ein, um sich anzumelden',
            'email_label' => 'E-Mail-Adresse',
            'email_placeholder' => 'ihre@email.de',
            'password_label' => 'Passwort',
            'password_placeholder' => 'Passwort',
            'forgot_password' => 'Passwort vergessen?',
            'remember_me' => 'Angemeldet bleiben',
            'submit' => 'Anmelden',
            'no_account' => 'Noch kein Konto?',
            'sign_up' => 'Registrieren',
        ],
        'register' => [
            'head_title' => 'Registrieren',
            'layout_title' => 'Konto erstellen',
            'layout_description' => 'Geben Sie Ihre Daten ein, um ein Konto zu erstellen',
            'name_label' => 'Name',
            'name_placeholder' => 'Vollständiger Name',
            'email_label' => 'E-Mail-Adresse',
            'email_placeholder' => 'ihre@email.de',
            'password_label' => 'Passwort',
            'password_placeholder' => 'Passwort',
            'confirm_password_label' => 'Passwort bestätigen',
            'confirm_password_placeholder' => 'Passwort bestätigen',
            'submit' => 'Konto erstellen',
            'has_account' => 'Bereits ein Konto?',
            'log_in' => 'Anmelden',
        ],
        'forgot_password' => [
            'head_title' => 'Passwort vergessen',
            'layout_title' => 'Passwort vergessen',
            'layout_description' => 'Geben Sie Ihre E-Mail ein, um einen Link zum Zurücksetzen zu erhalten',
            'email_label' => 'E-Mail-Adresse',
            'email_placeholder' => 'ihre@email.de',
            'submit' => 'Link per E-Mail senden',
            'or_return' => 'Oder zurück zu',
            'log_in' => 'Anmelden',
        ],
        'reset_password' => [
            'head_title' => 'Passwort zurücksetzen',
            'layout_title' => 'Passwort zurücksetzen',
            'layout_description' => 'Bitte geben Sie Ihr neues Passwort ein',
            'email_label' => 'E-Mail',
            'password_label' => 'Passwort',
            'password_placeholder' => 'Passwort',
            'confirm_password_label' => 'Passwort bestätigen',
            'confirm_password_placeholder' => 'Passwort bestätigen',
            'submit' => 'Passwort zurücksetzen',
        ],
        'verify_email' => [
            'head_title' => 'E-Mail-Bestätigung',
            'layout_title' => 'E-Mail bestätigen',
            'layout_description' => 'Bitte bestätigen Sie Ihre E-Mail-Adresse über den Link, den wir Ihnen gerade gesendet haben.',
            'verification_sent' => 'Ein neuer Bestätigungslink wurde an die bei der Registrierung angegebene E-Mail-Adresse gesendet.',
            'resend' => 'Bestätigungs-E-Mail erneut senden',
            'log_out' => 'Abmelden',
        ],
        'confirm_password' => [
            'head_title' => 'Passwort bestätigen',
            'layout_title' => 'Passwort bestätigen',
            'layout_description' => 'Dies ist ein geschützter Bereich. Bitte bestätigen Sie Ihr Passwort, bevor Sie fortfahren.',
            'password_label' => 'Passwort',
            'submit' => 'Passwort bestätigen',
        ],
        'two_factor' => [
            'head_title' => 'Zwei-Faktor-Authentifizierung',
            'code_title' => 'Authentifizierungscode',
            'code_description' => 'Geben Sie den Code aus Ihrer Authenticator-App ein.',
            'recovery_title' => 'Wiederherstellungscode',
            'recovery_description' => 'Bestätigen Sie den Zugriff mit einem Ihrer Notfall-Wiederherstellungscodes.',
            'use_recovery_code' => 'mit einem Wiederherstellungscode anmelden',
            'use_auth_code' => 'mit einem Authentifizierungscode anmelden',
            'continue' => 'Weiter',
            'or_you_can' => 'oder Sie können ',
            'recovery_placeholder' => 'Wiederherstellungscode eingeben',
        ],
    ],

];
