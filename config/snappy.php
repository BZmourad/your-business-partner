<?php

return [
    'pdf' => [
        'enabled' => true,
        'binary' => base_path(env('WKHTML_PDF_BINARY', 'public/wkhtmltox/bin/wkhtmltopdf.exe')),
        'timeout' => false,
        'options' => [
            'enable-local-file-access' => true,
            'images' => true,
            'page-size' => 'A4',
            'encoding' => 'UTF-8',
        ],
        'env' => [],
    ],
    'image' => [
        'enabled' => true,
        'binary' => base_path(env('WKHTML_IMG_BINARY', 'public/wkhtmltox/bin/wkhtmltoimage.exe')),
        'timeout' => false,
        'options' => [],
        'env' => [],
    ],
];