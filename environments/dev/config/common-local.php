<?php

return [
    'name' => 'Site',
    'components' => [
        'db' => [
            'dsn' => 'mysql:host=localhost;dbname=webportal',
            'username' => 'root',
            'password' => '',
            'tablePrefix' => '',
        ],
        'mailer' => [
            'useFileTransport' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
