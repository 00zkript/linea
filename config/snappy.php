<?php

# SNAPPY DRIVER  ( windows | linux | public | vendor-amd64 | vendor-i386 )
$snappyDriver = [
    "pdf" => [
        'windows'  => env('SNAPPY_PATH_DRIVER_WINDOWS_PDF',"C:/laragon/www/wkhtmltopdf/bin/wkhtmltopdf"),
        'linux'  => "wkhtmltopdf",
        'public'  => public_path('wkhtmltopdf/wkhtmltopdf'),
        'vendor-amd64'  => base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'),
        'vendor-i386'  => base_path('vendor/h4cc/wkhtmltopdf-i386/bin/wkhtmltopdf-i386'),
    ],
    "image" => [
        'windows'  => env('SNAPPY_PATH_DRIVER_WINDOWS_IMAGE',"C:/laragon/www/wkhtmltopdf/bin/wkhtmltoimage"),
        'linux'  => "wkhtmltoimage",
        'public'  => public_path('wkhtmltopdf/wkhtmltoimage'),
        'vendor-amd64'  => base_path('vendor/h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64'),
        'vendor-i386'  => base_path('vendor/h4cc/wkhtmltoimage-i386/bin/wkhtmltoimage-i386'),
    ],
];

return [

    /*
    |--------------------------------------------------------------------------
    | Snappy PDF / Image Configuration
    |--------------------------------------------------------------------------
    |
    | This option contains settings for PDF generation.
    |
    | Enabled:
    |
    |    Whether to load PDF / Image generation.
    |
    | Binary:
    |
    |    The file path of the wkhtmltopdf / wkhtmltoimage executable.
    |
    | Timout:
    |
    |    The amount of time to wait (in seconds) before PDF / Image generation is stopped.
    |    Setting this to false disables the timeout (unlimited processing time).
    |
    | Options:
    |
    |    The wkhtmltopdf command options. These are passed directly to wkhtmltopdf.
    |    See https://wkhtmltopdf.org/usage/wkhtmltopdf.txt for all options.
    |
    | Env:
    |
    |    The environment variables to set while running the wkhtmltopdf process.
    |
    */

    'pdf' => [
        'enabled' => true,
        'binary'  => $snappyDriver["pdf"][env('SNAPPY_DRIVER','windows')],
        'timeout' => 36000,
        'options' => [],
        'env'     => [],
    ],

    'image' => [
        'enabled' => true,
        'binary'  => $snappyDriver["image"][env('SNAPPY_DRIVER','windows')],
        'timeout' => 36000,
        'options' => [],
        'env'     => [],
    ],

];
