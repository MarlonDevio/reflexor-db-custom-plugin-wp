<?php
/*
 * Plugin Name: FP Reflexor Admin Dashboard
 */
require __DIR__ . '/vendor/autoload.php';
require_once 'config.php';

use FpReflexorDashboard\FpReflexorDashboardInitializer;

$rd = FpReflexorDashboardInitializer::getInstance();
