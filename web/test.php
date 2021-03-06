<?php

// Set Error Reporting Levels
error_reporting(-1);
ini_set('display_errors', 'true');
date_default_timezone_set('UTC');

// Definitions
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
defined('BASEDIR') or define('BASEDIR', __DIR__ . DS . '..' . DS);
defined('YII_DEBUG') or define('YII_DEBUG',true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

if (!isset($_SERVER['CIIMS_ENV']))
	$_SERVER['CIIMS_ENV'] = 'main';

$config = require BASEDIR.'protected'.DS.'config'.DS.$_SERVER['CIIMS_ENV'].'.php';
$defaultConfig = require BASEDIR.'protected'.DS.'config'.DS.'main.default.php';

// Load Yii and Composer extensions
require_once BASEDIR.'vendor'.DS.'yiisoft'.DS.'yii'.DS.'framework'.DS.'yii.php';
require_once BASEDIR.'vendor'.DS.'autoload.php';

Yii::setPathOfAlias('vendor', BASEDIR.'vendor');
Yii::setPathOfAlias('base', BASEDIR);
Yii::setPathOfAlias('ext.yiinfinite-scroll.YiinfiniteScroller', Yii::getPathOfAlias('vendor.charlesportwoodii.ciinfinite-scroll.YiinfiniteScroller'));

$config = CMap::mergeArray($defaultConfig, $config);

$_SERVER['SERVER_NAME'] = 'localhost';

// Set the request component in the test script
$config['components']['request'] = array(
	'class' => 'vendor.codeception.YiiBridge.web.CodeceptionHttpRequest'
);

// Return for Codeception
return array(
	'class' => 'CWebApplication',
	'config' => $config
);
