<?php

return [
	'mainMenu' => [
		'yii2tool\restclient\web\helpers\Menu',
		[
			'label' => 'Qiwi',
			'module' => 'qiwi',
			'url' => 'qiwi',
		],
	],
	'rightMenu' => [
		'yii2module\account\module\helpers\Menu',
	],
];