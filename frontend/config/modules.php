<?php

use yii2tool\restclient\web\helpers\RestModuleHelper;

$config = [
	'error' => 'yii2module\error\module\Module',
	'user' => 'yii2module\account\module\Module',
	'welcome' => 'yii2module\dashboard\web\Module',
    'guide' => 'yii2module\guide\module\Module',
];

if(YII_ENV_DEV) {
	$config = RestModuleHelper::appendConfig($config);
}

return $config;
