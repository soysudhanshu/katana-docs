<?php

use Blade\Blade;

require_once __DIR__ . '/../vendor/autoload.php';

define('ROOT_DIR', realpath(__DIR__ . '/../'));
define('DOC_DIR', ROOT_DIR . '/docs');
define('VIEW_DIR', ROOT_DIR . '/resources/views/');
define('CACHE_DIR', ROOT_DIR . '/.cache/');

if (!is_dir(CACHE_DIR) && !mkdir(CACHE_DIR)) {
    die("Cannot create cache directory");
}

$blade = new Blade(VIEW_DIR, CACHE_DIR);

$blade->setEnvironment(fn () => 'development');


echo $blade->render('index');
