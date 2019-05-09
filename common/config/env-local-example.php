<?php

return [
    'test' => [
        'skipBug' => true,
    ],
	'url' => [
		'frontend' => 'http://dev.yii/',
		'backend' => 'http://admin.dev.yii/',
        'api' => 'http://api.dev.yii/',
	],
	'servers' => [
        'storage' => [
            'resourceHost' => 'http://dev.yii/',
        ],
        /*'storage' => [
            'apiHost' => 'http://api.storage.srv/',
            'resourceHost' => 'http://storage.srv/',
            'driver' => 'core',
        ],*/
        /*'core' => [
            'host' => 'http://api.core.srv/',
            'partnerName' => 'yumail',
        ],*/
		'db' => [
            'main' => [
                'driver' => 'pgsql',
                'username' => 'postgres',
                'password' => 'postgres',
                'dbname' => 'dev_yii',
                'defaultSchema' => 'common',
            ],
		],
	],
	'mode' => [
		'env' => 'dev',
		'debug' => true,
	],
	'jwt' => [
		'profiles' => [
			'default' => [
				'key' => 'IeWUAWlY55VVPOEOtbp1PH1NXOotU0Wh',
			],
			'auth' => [
				'key' => 'W4PpvVwI82Rfl9fl2R9XeRqBI0VFBHP3',
                'lifetime' => \yii2rails\extension\enum\enums\TimeEnum::SECOND_PER_YEAR,
			],
		],
	],
	'domain' => [
		'driver' => [
			'primary' => 'ar',
			'slave' => 'ar',
		],
	],
	'cookieValidationKey' => [
		'frontend' => 'pypMohIKXLST_s3bCOU-TFLWCwNIuaEr',
		'backend' => 'wQGCG26xibpRH5ezm_cN_zcJARUnKMtl',
	],
];
