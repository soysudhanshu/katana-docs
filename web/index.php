<?php

use App\Document;
use App\Route;

require_once __DIR__ . '/../vendor/autoload.php';

define('ROOT_DIR', realpath(__DIR__ . '/../'));
define('DOC_DIR', ROOT_DIR . '/docs');
define('VIEW_DIR', ROOT_DIR . '/resources/views/');
define('CACHE_DIR', ROOT_DIR . '/.cache/');

if (!is_dir(CACHE_DIR) && !mkdir(CACHE_DIR)) {
    die("Cannot create cache directory");
}

Route::get('/', fn() => view('index'));

$response = Route::dispatch();

if ($response === null) {
    http_response_code(404);
    echo '404';
} else {
    echo $response;
}
