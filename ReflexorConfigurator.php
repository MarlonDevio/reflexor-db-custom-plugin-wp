<?php

class ReflexorConfigurator
{
  private static $_pluginDirPath;
  private static $_pluginDirUrl;
  private static $_frontendDirPath;
  private static $_backendDirPath;

  public static function init()
  {
    self::$_pluginDirPath = plugin_dir_path(__FILE__);
    self::$_pluginDirUrl = plugin_dir_url(__FILE__);
    self::$_frontendDirPath = self::$_pluginDirPath . 'frontend';
  }

  public static function getFrontendDirPath()
  {
    return self::$_frontendDirPath;
  }
}
