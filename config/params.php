<?php

return [
    'adminEmail' => '',
    'supportEmail' => '',

    'file' => [
        'extensions' => 'png, jpg',
        'maxSize' => 25*1024*1024,
        'maxFiles' => 50,
        'path' => dirname(__DIR__) . '/files',
    ],
    'image' => [
        'path' => 'image',
        'jpeg_quality' => 85,
        'convert' => false,
        'watermark' => [
            'enabled' => false,
            'absolute' => false,
            'file' => '@webroot/img/watermark.png',
            'x' => 50,
            'y' => 50,
        ],
        'none' => '/img/none.png',
        'size' => [
            'small' => [
                'width' => 320,
                'height' => 240,
                'method' => 'crop',
            ],
            'normal' => [
                'width' => 640,
                'height' => 480,
                'method' => 'clip',
            ],
            'big' => [
                'width' => 1200,
                'height' => 900,
                'method' => 'clip',
            ],
            'member' => [
                'width' => 250,
                'height' => 320,
                'method' => 'crop',
                'watermark' => [
                    'enabled' => false,
                ],
            ],
            'cover' => [
                'width' => 400,
                'height' => 400,
                'method' => 'crop',
                'watermark' => [
                    'enabled' => false,
                ],
            ],
            'fill' => [
                'width' => 400,
                'height' => 400,
                'method' => 'fill',
                'watermark' => [
                    'enabled' => false,
                ],
            ],
        ],
    ],

];
