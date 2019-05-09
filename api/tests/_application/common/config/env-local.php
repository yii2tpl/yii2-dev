<?php

return [
    /*'url' => [
        'test-api' => 'http://api.yumail.project/index-test.php',
    ],*/
    'mode' => [
        'env' => 'test',
        'debug' => true,
    ],
    'jwt' => [
        'profiles' => [
            'auth' => [
                'key' => 'W4PpvVwI82Rfl9fl2R9XeRqBI0VFBHP3',
            ],
        ],
    ],
    'domain' => [
        'driver' => [
            'primary' => 'ar',
            'slave' => 'ar',
        ],
    ],
];

/*$config = [

];

$parentConfig = include(__DIR__ . '/../../../../../vendor/yubundle/yii2-common/src/project/common/config/env-local.php');
return \yii\helpers\ArrayHelper::merge($parentConfig, $config);*/