<?php

use Illuminate\Database\Capsule\Manager as Capsule;

define('ROOTPATH', str_replace('public', '', __DIR__));
define("NS_APP_CONTROLLERS", "app\\controllers\\");

// autoload 自动加载
require ROOTPATH . '/vendor/autoload.php';

// 引入Eloquent ORM
$capsule = new Capsule();
$capsule->addConnection(require ROOTPATH . '/config/database.php');
$capsule->bootEloquent();


require ROOTPATH . '/routes/router.php';
