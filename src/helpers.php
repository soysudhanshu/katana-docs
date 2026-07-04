<?php

use Blade\Blade;

if (!function_exists('view')) {
    function view(string $view, array $data = []): Stringable
    {
        static $blade = null;

        if ($blade === null) {
            $blade = new Blade(VIEW_DIR, CACHE_DIR);
            $blade->setEnvironment(fn() => 'development');
        }

        return $blade->render($view, $data);
    }
}
