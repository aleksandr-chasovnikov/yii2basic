<?php
// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// comment out the following two lines when deployed to production
// defined('YII_DEBUG') or define('YII_DEBUG', true);
// defined('YII_ENV') or define('YII_ENV', 'dev');

define('LINK_COURS', 'https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=3');
include_once (__DIR__ .'/../yii2basic/components/functions/get_course.php');


require(__DIR__ . '/../yii2basic/vendor/autoload.php');
require(__DIR__ . '/../yii2basic/vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../yii2basic/config/web.php');

(new yii\web\Application($config))->run();
