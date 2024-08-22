<?php

namespace FpReflexorDashboard;
class FpReflexorDashboardInitializer
{
    private ?Controller $controller = null;
    private static ?FpReflexorDashboardInitializer $instance = null;

    public static function getInstance(): FpReflexorDashboardInitializer
    {
        if (self::$instance === null) {
            self::$instance = new FpReflexorDashboardInitializer();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->init();
        $this->controller = Controller::getInstance();

    }

    private function init(): void
    {
        add_action('admin_menu', [$this, 'addMenu']);
    }

    public function addMenu(): void
    {
        add_menu_page(
            'Reflexor Dashboard',
            'Reflexor Dashboard',
            'manage_options',
            'reflexor-dashboard',
            [$this, 'renderDashboard'],
            'dashicons-admin-generic',
            6
        );
    }

    public function renderDashboard(): void
    {
        echo '<h1>Reflexor Dashboard</h1>';
    }
}
