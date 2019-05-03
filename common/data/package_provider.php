<?php

use yii\helpers\ArrayHelper;

$collection = [

];

$baseCollection = require_once(__DIR__ . '/../../vendor/yii2rails/yii2-extension/src/package/domain/data/package_provider.php');
return ArrayHelper::merge($baseCollection, $collection);