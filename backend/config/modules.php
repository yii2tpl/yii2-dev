<?php

return [
	'error' => 'yii2module\error\module\Module',
	'rbac' => \yii2lab\rbac\admin\helpers\ModuleHelper::config(),
	
	'vendor' => 'yii2module\vendor\admin\Module',
	'notify' => 'yii2lab\notify\admin\Module',
	'user' => 'yii2module\account\module\BackendModule',
	
	'dashboard' => 'yii2module\dashboard\admin\Module',
];
