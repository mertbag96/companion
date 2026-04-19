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
        'title' => 'Your business companion for everyday operations.',
        'description' => 'A modern companion for businesses that value simplicity, structure, and efficiency.',
    ],
    'layout' => [
        'footer' => [
            'brand' => 'companion.',
            'copyright' => '© :year Companion. All rights reserved.',
            'tagline' => 'A modern companion for businesses that value simplicity, structure, and efficiency.',
            'columns' => [
                'product' => [
                    'label' => 'Product',
                    'links' => [
                        'features' => 'Features',
                        'pricing' => 'Pricing',
                    ],
                ],
                'resources' => [
                    'label' => 'Resources',
                    'links' => [
                        'blog' => 'Blog',
                        'help' => 'Help center',
                    ],
                ],
                'company' => [
                    'label' => 'Company',
                    'links' => [
                        'about' => 'About',
                        'contact' => 'Contact',
                    ],
                ],
                'legal' => [
                    'label' => 'Legal',
                    'links' => [
                        'privacy' => 'Privacy policy',
                        'terms' => 'Terms of service',
                    ],
                ],
            ],
        ],
        'header' => [
            'nav' => [
                'features' => 'Features',
                'pricing' => 'Pricing',
                'about' => 'About',
                'blog' => 'Blog',
                'help' => 'Help center',
            ],
            'theme' => [
                'select_aria' => 'Choose color theme',
                'light' => 'Light',
                'dark' => 'Dark',
                'system' => 'System',
            ],
            'actions' => [
                'login' => 'Log in',
                'get_started' => 'Get started',
            ],
        ],
    ],
    'home' => [
        'heading' => 'Homepage',
    ],

    'auth' => [
        'login' => [
            'head_title' => 'Log in',
            'layout_title' => 'Log in to your account',
            'layout_description' => 'Enter your email and password below to log in',
            'email_label' => 'Email address',
            'email_placeholder' => 'email@example.com',
            'password_label' => 'Password',
            'password_placeholder' => 'Password',
            'forgot_password' => 'Forgot password?',
            'remember_me' => 'Remember me',
            'submit' => 'Log in',
            'no_account' => "Don't have an account?",
            'sign_up' => 'Sign up',
        ],
        'register' => [
            'head_title' => 'Register',
            'layout_title' => 'Create an account',
            'layout_description' => 'Enter your details below to create your account',
            'name_label' => 'Name',
            'name_placeholder' => 'Full name',
            'email_label' => 'Email address',
            'email_placeholder' => 'email@example.com',
            'password_label' => 'Password',
            'password_placeholder' => 'Password',
            'confirm_password_label' => 'Confirm password',
            'confirm_password_placeholder' => 'Confirm password',
            'submit' => 'Create account',
            'has_account' => 'Already have an account?',
            'log_in' => 'Log in',
        ],
        'forgot_password' => [
            'head_title' => 'Forgot password',
            'layout_title' => 'Forgot password',
            'layout_description' => 'Enter your email to receive a password reset link',
            'email_label' => 'Email address',
            'email_placeholder' => 'email@example.com',
            'submit' => 'Email password reset link',
            'or_return' => 'Or, return to',
            'log_in' => 'log in',
        ],
        'reset_password' => [
            'head_title' => 'Reset password',
            'layout_title' => 'Reset password',
            'layout_description' => 'Please enter your new password below',
            'email_label' => 'Email',
            'password_label' => 'Password',
            'password_placeholder' => 'Password',
            'confirm_password_label' => 'Confirm password',
            'confirm_password_placeholder' => 'Confirm password',
            'submit' => 'Reset password',
        ],
        'verify_email' => [
            'head_title' => 'Email verification',
            'layout_title' => 'Verify email',
            'layout_description' => 'Please verify your email address by clicking on the link we just emailed to you.',
            'verification_sent' => 'A new verification link has been sent to the email address you provided during registration.',
            'resend' => 'Resend verification email',
            'log_out' => 'Log out',
        ],
        'confirm_password' => [
            'head_title' => 'Confirm password',
            'layout_title' => 'Confirm your password',
            'layout_description' => 'This is a secure area of the application. Please confirm your password before continuing.',
            'password_label' => 'Password',
            'submit' => 'Confirm password',
        ],
        'two_factor' => [
            'head_title' => 'Two-factor authentication',
            'code_title' => 'Authentication code',
            'code_description' => 'Enter the authentication code provided by your authenticator application.',
            'recovery_title' => 'Recovery code',
            'recovery_description' => 'Please confirm access to your account by entering one of your emergency recovery codes.',
            'use_recovery_code' => 'login using a recovery code',
            'use_auth_code' => 'login using an authentication code',
            'continue' => 'Continue',
            'or_you_can' => 'or you can ',
            'recovery_placeholder' => 'Enter recovery code',
        ],
    ],

];
