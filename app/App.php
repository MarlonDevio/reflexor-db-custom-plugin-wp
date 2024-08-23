<?php

namespace FP;

use Exception;
use FP\Assets\Assets;
use FP\Core\Config;
use FP\Core\Hooks;
use FP\Core\Widgets;
use Illuminate\Filesystem\Filesystem;

class App
{
    private static ?App $instance = null;
    private Assets $assets;
    private Config $config;
    private Widgets $widgets;
    private Filesystem $filesystem;


    private function __construct()
    {
        $this->config = self::init(new Config());

        $this->assets = self::init(new Assets());

        $this->widgets = self::init(new Widgets());

        $this->filesystem = new Filesystem();

    }

    public function assets(): Assets
    {
        return $this->assets;
    }

    public function config(): Config
    {
        return $this->config;
    }

    public function widgets(): Widgets
    {
        return $this->widgets;
    }

    public function filesystem(): Filesystem
    {
        return $this->filesystem;
    }

    /**
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a singleton.");
    }

    public static function get(): App
    {
        if (empty(self::$instance)) {
            self::$instance = new App();
        }
        return self::$instance;
    }

    public static function init(object $module): object
    {
        return Hooks::init($module);
    }

}
