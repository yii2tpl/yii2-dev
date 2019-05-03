<?php

use yii2lab\applicationTemplate\common\helpers\CommonModuleHelper;

return [
	'lang' => 'yii2module\lang\module\Module',
	'debug' => CommonModuleHelper::getConfig('debug'),
	'gii' => CommonModuleHelper::getConfig('gii'),
];
