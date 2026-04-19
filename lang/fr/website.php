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
        'title' => 'Votre compagnon métier pour les opérations quotidiennes.',
        'description' => 'Un compagnon moderne pour les entreprises qui valorisent la simplicité, la structure et l’efficacité.',
    ],
    'layout' => [
        'footer' => [
            'brand' => 'companion.',
            'copyright' => '© :year Companion. Tous droits réservés.',
            'tagline' => 'Un compagnon moderne pour les entreprises qui valorisent la simplicité, la structure et l’efficacité.',
            'columns' => [
                'product' => [
                    'label' => 'Produit',
                    'links' => [
                        'features' => 'Fonctionnalités',
                        'pricing' => 'Tarifs',
                    ],
                ],
                'resources' => [
                    'label' => 'Ressources',
                    'links' => [
                        'blog' => 'Blog',
                        'help' => 'Centre d’aide',
                    ],
                ],
                'company' => [
                    'label' => 'Entreprise',
                    'links' => [
                        'about' => 'À propos',
                        'contact' => 'Contact',
                    ],
                ],
                'legal' => [
                    'label' => 'Légal',
                    'links' => [
                        'privacy' => 'Politique de confidentialité',
                        'terms' => 'Conditions d’utilisation',
                    ],
                ],
            ],
        ],
        'header' => [
            'nav' => [
                'features' => 'Fonctionnalités',
                'pricing' => 'Tarifs',
                'about' => 'À propos',
                'blog' => 'Blog',
                'help' => 'Centre d’aide',
            ],
            'actions' => [
                'login' => 'Connexion',
                'get_started' => 'Commencer',
            ],
        ],
    ],
    'home' => [
        'heading' => 'Accueil',
    ],

    'auth' => [
        'login' => [
            'head_title' => 'Connexion',
            'layout_title' => 'Connectez-vous à votre compte',
            'layout_description' => 'Saisissez votre e-mail et votre mot de passe pour vous connecter',
            'email_label' => 'Adresse e-mail',
            'email_placeholder' => 'vous@exemple.com',
            'password_label' => 'Mot de passe',
            'password_placeholder' => 'Mot de passe',
            'forgot_password' => 'Mot de passe oublié ?',
            'remember_me' => 'Se souvenir de moi',
            'submit' => 'Connexion',
            'no_account' => 'Pas encore de compte ?',
            'sign_up' => 'Créer un compte',
        ],
        'register' => [
            'head_title' => 'Inscription',
            'layout_title' => 'Créer un compte',
            'layout_description' => 'Saisissez vos informations pour créer votre compte',
            'name_label' => 'Nom',
            'name_placeholder' => 'Nom complet',
            'email_label' => 'Adresse e-mail',
            'email_placeholder' => 'vous@exemple.com',
            'password_label' => 'Mot de passe',
            'password_placeholder' => 'Mot de passe',
            'confirm_password_label' => 'Confirmer le mot de passe',
            'confirm_password_placeholder' => 'Confirmer le mot de passe',
            'submit' => 'Créer le compte',
            'has_account' => 'Vous avez déjà un compte ?',
            'log_in' => 'Connexion',
        ],
        'forgot_password' => [
            'head_title' => 'Mot de passe oublié',
            'layout_title' => 'Mot de passe oublié',
            'layout_description' => 'Saisissez votre e-mail pour recevoir un lien de réinitialisation',
            'email_label' => 'Adresse e-mail',
            'email_placeholder' => 'vous@exemple.com',
            'submit' => 'Envoyer le lien par e-mail',
            'or_return' => 'Ou retourner à',
            'log_in' => 'la connexion',
        ],
        'reset_password' => [
            'head_title' => 'Réinitialiser le mot de passe',
            'layout_title' => 'Réinitialiser le mot de passe',
            'layout_description' => 'Veuillez saisir votre nouveau mot de passe',
            'email_label' => 'E-mail',
            'password_label' => 'Mot de passe',
            'password_placeholder' => 'Mot de passe',
            'confirm_password_label' => 'Confirmer le mot de passe',
            'confirm_password_placeholder' => 'Confirmer le mot de passe',
            'submit' => 'Réinitialiser le mot de passe',
        ],
        'verify_email' => [
            'head_title' => 'Vérification de l’e-mail',
            'layout_title' => 'Vérifier l’e-mail',
            'layout_description' => 'Veuillez vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer.',
            'verification_sent' => 'Un nouveau lien de vérification a été envoyé à l’adresse e-mail indiquée lors de l’inscription.',
            'resend' => 'Renvoyer l’e-mail de vérification',
            'log_out' => 'Se déconnecter',
        ],
        'confirm_password' => [
            'head_title' => 'Confirmer le mot de passe',
            'layout_title' => 'Confirmez votre mot de passe',
            'layout_description' => 'Zone sécurisée : confirmez votre mot de passe avant de continuer.',
            'password_label' => 'Mot de passe',
            'submit' => 'Confirmer le mot de passe',
        ],
        'two_factor' => [
            'head_title' => 'Authentification à deux facteurs',
            'code_title' => 'Code d’authentification',
            'code_description' => 'Saisissez le code fourni par votre application d’authentification.',
            'recovery_title' => 'Code de récupération',
            'recovery_description' => 'Confirmez l’accès à votre compte avec l’un de vos codes de récupération d’urgence.',
            'use_recovery_code' => 'se connecter avec un code de récupération',
            'use_auth_code' => 'se connecter avec un code d’authentification',
            'continue' => 'Continuer',
            'or_you_can' => 'ou vous pouvez ',
            'recovery_placeholder' => 'Saisir le code de récupération',
        ],
    ],

];
