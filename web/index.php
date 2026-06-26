<?php

use Blade\Blade;

require_once __DIR__ . '/../vendor/autoload.php';

define('VIEW_DIR', realpath(__DIR__ . '/../resources/views/'));
define('CACHE_DIR', realpath(__DIR__ . '/../.cache/'));

if (!is_dir(CACHE_DIR) && !mkdir(CACHE_DIR)) {
    die("Cannot create cache directory");
}

$blade = new Blade(VIEW_DIR, CACHE_DIR);

$blade->setEnvironment(fn () => 'development');


echo $blade->render('index');
