<?php

return [

    'name' => env('APP_NAME', 'Laravel'),
    'env' => env('APP_ENV', 'production'),
    'debug' => (bool) env('APP_DEBUG', false),
    'url' => env('APP_URL', 'http://localhost'),
    'timezone' => env('APP_TIMEZONE', 'UTC'),
    'locale' => env('APP_LOCALE', 'en'),
    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),
    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

    'cipher' => 'AES-256-CBC',
    'key' => env('APP_KEY'),
    'previous_keys' => [
        ...array_filter(
            explode(',', env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Barcode Configuration
    |--------------------------------------------------------------------------
    |
    | Konfigurasi untuk pengaturan barcode aplikasi
    |
    */
    'barcode' => [
        'default_format' => env('BARCODE_FORMAT', 'CODE128'),
        'width' => env('BARCODE_WIDTH', 2),
        'height' => env('BARCODE_HEIGHT', 50),
        'color' => env('BARCODE_COLOR', '#000000'),
        'display_value' => env('BARCODE_DISPLAY_VALUE', true),

        'providers' => [
    Milon\Barcode\BarcodeServiceProvider::class,
],

'aliases' => [
    'DNS1D' => Milon\Barcode\Facades\DNS1DFacade::class,
    'DNS2D' => Milon\Barcode\Facades\DNS2DFacade::class,
],

    ],

];
