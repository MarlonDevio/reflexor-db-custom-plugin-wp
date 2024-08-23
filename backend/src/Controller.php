<?php

namespace FpReflexorDashboard;

class Controller
{
  private static ?Controller $instance = null;

  public static function getInstance(): Controller
  {
    if (self::$instance === null) {
      self::$instance = new Controller();
    }
    return self::$instance;
  }

  private function __construct()
  {
    $this->init();
  }

  public function init(): void
  {
    add_action('wp', [$this, 'conditionallyInjectJs']);
  }


  public function conditionallyInjectJs(): void
  {

      echo FP_ASSETS_URI;

    $manifest_path = FP_REFLEXOR_MANIFEST_PATH;
    $manifest_array = json_decode(file_get_contents($manifest_path), true);
    $js_file = $manifest_array['index.html']['file'];
    $path = FP_REFLEXOR_PLUGIN_URL . 'frontend/dist/' . $js_file;

    if (is_product()) {
      add_action('wp_footer', function () use ($path) {
        echo '<script src="' . $path . '"></script>';
      });
    }
  }
}
