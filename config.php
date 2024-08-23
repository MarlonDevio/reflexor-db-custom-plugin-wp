
<?php
define('FP_VERSION', '1.0.0');
# /Applications/XAMPP/xamppfiles/htdocs/reflexor/wp-content/plugins/fp-reflexor-dashboard
define('FP_PATH', dirname(__FILE__));
# http://reflexor.localhost/wp-content/plugins/fp-reflexor-dashboard
define('FP_URI', home_url(str_replace(ABSPATH, '', FP_PATH)));

define('FP_HMR_HOST', 'http://localhost:5173');

# /Applications/XAMPP/xamppfiles/htdocs/reflexor/wp-content/plugins/fp-reflexor-dashboard/frontend/dist
define('FP_ASSETS_PATH', FP_PATH . '/frontend/dist');

#http://reflexor.localhost/wp-content/plugins/fp-reflexor-dashboard/frontend/dist
define('FP_ASSETS_URI', FP_URI . '/frontend/dist');

define('FP_RESOURCES_PATH', FP_PATH . '/resources');
define('FP_RESOURCES_URI', FP_URI . '/resources');
define('FP_REFLEXOR_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('FP_REFLEXOR_PLUGIN_URL', plugin_dir_url(__FILE__));
const FP_REFLEXOR_MANIFEST_PATH = FP_REFLEXOR_PLUGIN_URL . 'frontend/dist/.vite/manifest.json';
