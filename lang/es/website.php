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
        'title' => 'Tu compañero de negocio para las operaciones diarias.',
        'description' => 'Un compañero moderno para empresas que valoran la simplicidad, la estructura y la eficiencia.',
    ],
    'layout' => [
        'footer' => [
            'brand' => 'companion.',
            'copyright' => '© :year Companion. Todos los derechos reservados.',
            'tagline' => 'Un compañero moderno para empresas que valoran la simplicidad, la estructura y la eficiencia.',
            'columns' => [
                'product' => [
                    'label' => 'Producto',
                    'links' => [
                        'features' => 'Funciones',
                        'pricing' => 'Precios',
                    ],
                ],
                'resources' => [
                    'label' => 'Recursos',
                    'links' => [
                        'blog' => 'Blog',
                        'help' => 'Centro de ayuda',
                    ],
                ],
                'company' => [
                    'label' => 'Empresa',
                    'links' => [
                        'about' => 'Acerca de',
                        'contact' => 'Contacto',
                    ],
                ],
                'legal' => [
                    'label' => 'Legal',
                    'links' => [
                        'privacy' => 'Política de privacidad',
                        'terms' => 'Términos del servicio',
                    ],
                ],
            ],
        ],
        'header' => [
            'nav' => [
                'features' => 'Funciones',
                'pricing' => 'Precios',
                'about' => 'Acerca de',
                'blog' => 'Blog',
                'help' => 'Centro de ayuda',
            ],
            'actions' => [
                'login' => 'Iniciar sesión',
                'get_started' => 'Empezar',
            ],
        ],
    ],
    'home' => [
        'heading' => 'Inicio',
    ],

    'auth' => [
        'login' => [
            'head_title' => 'Iniciar sesión',
            'layout_title' => 'Inicia sesión en tu cuenta',
            'layout_description' => 'Introduce tu correo y contraseña para continuar',
            'email_label' => 'Correo electrónico',
            'email_placeholder' => 'correo@ejemplo.com',
            'password_label' => 'Contraseña',
            'password_placeholder' => 'Contraseña',
            'forgot_password' => '¿Has olvidado tu contraseña?',
            'remember_me' => 'Recordarme',
            'submit' => 'Iniciar sesión',
            'no_account' => '¿No tienes cuenta?',
            'sign_up' => 'Registrarse',
        ],
        'register' => [
            'head_title' => 'Registrarse',
            'layout_title' => 'Crear una cuenta',
            'layout_description' => 'Introduce tus datos para crear tu cuenta',
            'name_label' => 'Nombre',
            'name_placeholder' => 'Nombre completo',
            'email_label' => 'Correo electrónico',
            'email_placeholder' => 'correo@ejemplo.com',
            'password_label' => 'Contraseña',
            'password_placeholder' => 'Contraseña',
            'confirm_password_label' => 'Confirmar contraseña',
            'confirm_password_placeholder' => 'Confirmar contraseña',
            'submit' => 'Crear cuenta',
            'has_account' => '¿Ya tienes cuenta?',
            'log_in' => 'Iniciar sesión',
        ],
        'forgot_password' => [
            'head_title' => 'Contraseña olvidada',
            'layout_title' => 'Contraseña olvidada',
            'layout_description' => 'Introduce tu correo para recibir un enlace de restablecimiento',
            'email_label' => 'Correo electrónico',
            'email_placeholder' => 'correo@ejemplo.com',
            'submit' => 'Enviar enlace por correo',
            'or_return' => 'O vuelve a',
            'log_in' => 'iniciar sesión',
        ],
        'reset_password' => [
            'head_title' => 'Restablecer contraseña',
            'layout_title' => 'Restablecer contraseña',
            'layout_description' => 'Introduce tu nueva contraseña',
            'email_label' => 'Correo electrónico',
            'password_label' => 'Contraseña',
            'password_placeholder' => 'Contraseña',
            'confirm_password_label' => 'Confirmar contraseña',
            'confirm_password_placeholder' => 'Confirmar contraseña',
            'submit' => 'Restablecer contraseña',
        ],
        'verify_email' => [
            'head_title' => 'Verificación por correo',
            'layout_title' => 'Verificar correo',
            'layout_description' => 'Verifica tu correo haciendo clic en el enlace que te hemos enviado.',
            'verification_sent' => 'Se ha enviado un nuevo enlace de verificación al correo indicado al registrarte.',
            'resend' => 'Reenviar correo de verificación',
            'log_out' => 'Cerrar sesión',
        ],
        'confirm_password' => [
            'head_title' => 'Confirmar contraseña',
            'layout_title' => 'Confirma tu contraseña',
            'layout_description' => 'Zona segura: confirma tu contraseña antes de continuar.',
            'password_label' => 'Contraseña',
            'submit' => 'Confirmar contraseña',
        ],
        'two_factor' => [
            'head_title' => 'Autenticación en dos pasos',
            'code_title' => 'Código de autenticación',
            'code_description' => 'Introduce el código de tu aplicación de autenticación.',
            'recovery_title' => 'Código de recuperación',
            'recovery_description' => 'Confirma el acceso con uno de tus códigos de recuperación de emergencia.',
            'use_recovery_code' => 'iniciar sesión con un código de recuperación',
            'use_auth_code' => 'iniciar sesión con un código de autenticación',
            'continue' => 'Continuar',
            'or_you_can' => 'o puedes ',
            'recovery_placeholder' => 'Introduce el código de recuperación',
        ],
    ],

];
