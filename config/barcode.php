<?php

return [
    'default' => 'svg', // Format output default (svg, png, jpeg)
    
    'formats' => [
        'CODE128' => [
            'type' => 'CODE128',
            'width' => 2,
            'height' => 50,
            'color' => '#000000',
        ],
        'EAN13' => [
            'type' => 'EAN13',
            'width' => 2,
            'height' => 50,
            'color' => '#000000',
        ],
        // Tambahkan format lain sesuai kebutuhan
    ],
    
    'storage' => [
        'path' => 'public/barcodes', // Lokasi penyimpanan barcode
        'disk' => 'local',           // Filesystem disk yang digunakan
    ],
];