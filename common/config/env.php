<?php

use yii2rails\app\domain\commands\ApiVersion;
use yii2rails\app\domain\commands\RunBootstrap;
use yii2rails\app\domain\filters\config\LoadConfig;
use yii2rails\app\domain\filters\config\LoadModuleConfig;
use yii2rails\app\domain\filters\config\LoadRouteConfig;
use yii2rails\domain\filters\LoadDomainConfig;
use yii2rails\app\domain\enums\YiiEnvEnum;

return [
	'api' => [
		'defaultVersion' => 1,
	],
	'aliases' => [],
	'cache' => [
		'enable' => false, //YII_ENV == YiiEnvEnum::PROD,
	],
	'servers' => [
		/*'storage' => [
			'apiHost' => 'http://api.storage.srv/',
			'resourceHost' => 'http://storage.srv/',
			'driver' => 'core',
		],
		'core' => [
			'host' => 'http://api.core.srv/',
		],*/
		'socket' => [
			'tcp' => [
				'host' => 'tcp://127.0.0.1:1234',
			],
			'ws' => [
				'host' => 'websocket://0.0.0.0:8000',
				'context' => [
					/*'ssl' => array(
						'local_cert'  => '/your/path/of/server.pem',
						'local_pk'    => '/your/path/of/server.key',
						'verify_peer' => false,
					)*/
				],
			],
		],
		'static' => [
			'profiles' => [
				'storage' => [
					'path' => 'storage',
				],
			],
		],
		'db' => [
			'main' => [
				'driver' => 'sqlite',
				'dbname' => '@common/runtime/sqlite/main.db',
				'map' => [
					'user_assignment' => 'user.assignment',
					'user_confirm' => 'user.confirm',
					'user_person' => 'user.person',
					'users' => 'user.login',
					'user_login' => 'user.login',
					'user_activity' => 'user.activity',
					'user_token' => 'user.token',
					'user_contact' => 'user.contact',
					'user_security' => 'user.security',
					
					'rest_collection' => 'common.rest',
					'language' => 'common.language',
				],
			],
			'test' => [
				'driver' => 'sqlite',
				'dbname' => '@common/runtime/sqlite/test.db',
			],
			'filedb' => [
				'path' => '@common/data',
			],
		],
	],
	'app' => [
		'commands' => [
			[
				'class' => RunBootstrap::class,
				'app' => COMMON,
			],
			[
				'class' => RunBootstrap::class,
				'app' => APP,
			],
			[
				'class' => ApiVersion::class,
				'isEnabled' => APP == API,
			],
			[
				'class' => 'yii2rails\domain\filters\DefineDomainLocator',
				'filters' => [
					[
						'class' => LoadDomainConfig::class,
						'app' => COMMON,
						'name' => 'domains',
						'withLocal' => true,
					],
				],
			],
			/*[
				'class' => 'yii2module\offline\domain\filters\IsOffline',
				'exclude' => [
					CONSOLE,
					BACKEND,
				],
			],*/
		],
	],
	'config' => [
		'filters' => [
			[
				'class' => LoadConfig::class,
				'app' => COMMON,
				'name' => 'main',
				'withLocal' => true,
			],
			[
				'class' => LoadConfig::class,
				'app' => APP,
				'name' => 'main',
				'withLocal' => true,
			],
			
			[
				'class' => LoadModuleConfig::class,
				'app' => COMMON,
				'name' => 'modules',
				'withLocal' => true,
			],
			[
				'class' => LoadModuleConfig::class,
				'app' => APP,
				'name' => 'modules',
				'withLocal' => true,
			],
			
			[
				'class' => LoadRouteConfig::class,
				'app' => APP,
				'name' => 'routes',
				'withLocal' => true,
			],
			
			[
				'class' => LoadConfig::class,
				'app' => COMMON,
				'name' => 'params',
				'withLocal' => true,
				'assignTo' => 'params',
			],
			[
				'class' => LoadConfig::class,
				'app' => APP,
				'name' => 'params',
				'withLocal' => true,
				'assignTo' => 'params',
			],
			
			[
				'class' => LoadConfig::class,
				'app' => COMMON,
				'name' => 'install',
			],
			[
				'class' => LoadConfig::class,
				'app' => APP,
				'name' => 'install',
			],
			
			[
				'class' => LoadConfig::class,
				'app' => COMMON,
				'name' => 'test',
				'withLocal' => true,
				'isEnabled' => YII_ENV == YiiEnvEnum::TEST,
			],
			[
				'class' => LoadConfig::class,
				'app' => APP,
				'name' => 'test',
				'withLocal' => true,
				'isEnabled' => YII_ENV == YiiEnvEnum::TEST,
			],
			
			'migration' => [
				'class' => 'yii2lab\db\domain\filters\migration\SetPath',
				'path' => [
					'@vendor/yii2bundle/yii2-rbac/src/domain/migrations',
					'@vendor/yii2tool/yii2-restclient/src/domain/migrations',
					'@vendor/yii2bundle/yii2-lang/src/domain/migrations',
					//'@vendor/yii2bundle/yii2-geo/src/domain/migrations',
					'@vendor/yii2bundle/yii2-account/src/domain/v3/migrations',
					'@vendor/yiisoft/yii2/log/migrations',
				],
				'scan' => [
					'@domain',
				],
			],
			
			'yii2rails\app\domain\filters\config\StandardConfigMutations',
			'yii2rails\app\domain\filters\config\DebugModule',
		],
	],
];
