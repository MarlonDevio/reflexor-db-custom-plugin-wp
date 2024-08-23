<?php
define('FP_VERSION', '0.1.1');
define('FP_ROOT', str_replace(ABSPATH, '/', dirname(__DIR__, 1)));
define('FP_PATH', dirname(__DIR__, 1));
define('FP_URI', home_url(FP_ROOT));
define('FP_HMR_HOST', 'http://localhost:5173');
define('FP_HMR_URI', FP_HMR_HOST . FP_ROOT);
define('FP_ASSETS_PATH', FP_PATH . '/dist');
define('FP_ASSETS_URI', FP_URI . '/dist');

require_once FP_PATH . '/inc/bootstrap.php';
