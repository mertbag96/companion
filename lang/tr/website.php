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
        'title' => 'Günlük operasyonlarınız için iş arkadaşınız.',
        'description' => 'Sadelik, yapı ve verimliliği önemseyen işletmeler için modern bir eşlikçi.',
    ],
    'layout' => [
        'footer' => [
            'brand' => 'companion.',
            'copyright' => '© :year Companion. Tüm hakları saklıdır.',
            'tagline' => 'Sadelik, yapı ve verimliliği önemseyen işletmeler için modern bir eşlikçi.',
            'columns' => [
                'product' => [
                    'label' => 'Ürün',
                    'links' => [
                        'features' => 'Özellikler',
                        'pricing' => 'Fiyatlandırma',
                    ],
                ],
                'resources' => [
                    'label' => 'Kaynaklar',
                    'links' => [
                        'blog' => 'Blog',
                        'help' => 'Yardım merkezi',
                    ],
                ],
                'company' => [
                    'label' => 'Şirket',
                    'links' => [
                        'about' => 'Hakkımızda',
                        'contact' => 'İletişim',
                    ],
                ],
                'legal' => [
                    'label' => 'Yasal',
                    'links' => [
                        'privacy' => 'Gizlilik politikası',
                        'terms' => 'Hizmet şartları',
                    ],
                ],
            ],
        ],
        'header' => [
            'nav' => [
                'features' => 'Özellikler',
                'pricing' => 'Fiyatlandırma',
                'about' => 'Hakkımızda',
                'blog' => 'Blog',
                'help' => 'Yardım merkezi',
            ],
            'theme' => [
                'select_aria' => 'Renk temasını seçin',
                'light' => 'Açık',
                'dark' => 'Koyu',
                'system' => 'Sistem',
            ],
            'actions' => [
                'login' => 'Giriş yap',
                'get_started' => 'Başlayın',
            ],
        ],
    ],
    'home' => [
        'heading' => 'Ana sayfa',
    ],

    'auth' => [
        'login' => [
            'head_title' => 'Giriş yap',
            'layout_title' => 'Hesabınıza giriş yapın',
            'layout_description' => 'Giriş yapmak için e-posta ve şifrenizi girin',
            'email_label' => 'E-posta adresi',
            'email_placeholder' => 'ornek@email.com',
            'password_label' => 'Şifre',
            'password_placeholder' => 'Şifre',
            'forgot_password' => 'Şifrenizi mi unuttunuz?',
            'remember_me' => 'Beni hatırla',
            'submit' => 'Giriş yap',
            'no_account' => 'Hesabınız yok mu?',
            'sign_up' => 'Kayıt ol',
        ],
        'register' => [
            'head_title' => 'Kayıt ol',
            'layout_title' => 'Hesap oluşturun',
            'layout_description' => 'Hesabınızı oluşturmak için bilgilerinizi girin',
            'name_label' => 'Ad',
            'name_placeholder' => 'Ad soyad',
            'email_label' => 'E-posta adresi',
            'email_placeholder' => 'ornek@email.com',
            'password_label' => 'Şifre',
            'password_placeholder' => 'Şifre',
            'confirm_password_label' => 'Şifreyi onayla',
            'confirm_password_placeholder' => 'Şifreyi onayla',
            'submit' => 'Hesap oluştur',
            'has_account' => 'Zaten hesabınız var mı?',
            'log_in' => 'Giriş yap',
        ],
        'forgot_password' => [
            'head_title' => 'Şifremi unuttum',
            'layout_title' => 'Şifremi unuttum',
            'layout_description' => 'Şifre sıfırlama bağlantısı almak için e-postanızı girin',
            'email_label' => 'E-posta adresi',
            'email_placeholder' => 'ornek@email.com',
            'submit' => 'Sıfırlama bağlantısını e-postayla gönder',
            'or_return' => 'Ya da şuraya dönün:',
            'log_in' => 'giriş yap',
        ],
        'reset_password' => [
            'head_title' => 'Şifreyi sıfırla',
            'layout_title' => 'Şifreyi sıfırla',
            'layout_description' => 'Lütfen yeni şifrenizi girin',
            'email_label' => 'E-posta',
            'password_label' => 'Şifre',
            'password_placeholder' => 'Şifre',
            'confirm_password_label' => 'Şifreyi onayla',
            'confirm_password_placeholder' => 'Şifreyi onayla',
            'submit' => 'Şifreyi sıfırla',
        ],
        'verify_email' => [
            'head_title' => 'E-posta doğrulama',
            'layout_title' => 'E-postayı doğrula',
            'layout_description' => 'Size az önce e-postayla gönderdiğimiz bağlantıya tıklayarak e-posta adresinizi doğrulayın.',
            'verification_sent' => 'Kayıt sırasında verdiğiniz e-posta adresine yeni bir doğrulama bağlantısı gönderildi.',
            'resend' => 'Doğrulama e-postasını yeniden gönder',
            'log_out' => 'Çıkış yap',
        ],
        'confirm_password' => [
            'head_title' => 'Şifreyi onayla',
            'layout_title' => 'Şifrenizi onaylayın',
            'layout_description' => 'Bu güvenli bir alandır. Devam etmeden önce şifrenizi onaylayın.',
            'password_label' => 'Şifre',
            'submit' => 'Şifreyi onayla',
        ],
        'two_factor' => [
            'head_title' => 'İki faktörlü kimlik doğrulama',
            'code_title' => 'Kimlik doğrulama kodu',
            'code_description' => 'Kimlik doğrulama uygulamanızın verdiği kodu girin.',
            'recovery_title' => 'Kurtarma kodu',
            'recovery_description' => 'Hesabınıza erişimi, acil durum kurtarma kodlarınızdan biriyle onaylayın.',
            'use_recovery_code' => 'kurtarma kodu ile giriş yap',
            'use_auth_code' => 'kimlik doğrulama kodu ile giriş yap',
            'continue' => 'Devam',
            'or_you_can' => 'veya ',
            'recovery_placeholder' => 'Kurtarma kodunu girin',
        ],
    ],

];
