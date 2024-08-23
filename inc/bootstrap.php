<?php

$composer = FP_PATH . '/vendor/autoload.php';

if (!file_exists($composer)) {
    wp_die(wp_kses_post(__('Error locating autoloader. Please run <code>composer install</code>.', 'fp')));
}

require $composer;

if (!function_exists('fp')) {
    function fp(): FP\App
    {
        return FP\App::get();
    }
}
