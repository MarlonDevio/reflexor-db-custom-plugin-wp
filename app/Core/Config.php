<?php

namespace FP\Core;
class Config
{
    private array $config = [];

    public function __construct()
    {

        $this->config = [
            'version' => wp_get_environment_type() === 'development' ? time() : FP_VERSION,
            'env' => [
                'type' => wp_get_environment_type(),
                'mode' => !str_contains(FP_PATH, ABSPATH . 'wp-content/plugins') ? 'theme' : 'plugin',
            ],
            'hmr' => [
                'uri' => FP_HMR_HOST,
                'client' => FP_HMR_URI . '@vite/client',
                'sources' => FP_HMR_URI . '/resources',
                'active' => wp_get_environment_type() === 'development' && !is_wp_error(wp_remote_get(FP_HMR_URI)),
            ],
            'manifest' => [
                'path' => FP_ASSETS_PATH . '/manifest.json',
            ],
            'cache' => [
                'path' => wp_upload_dir()['basedir'] . '/cache/fp',
            ],
            'resources' => [
                'path' => FP_PATH . '/resources',
            ],
            'views' => [
                'path' => FP_PATH . '/resources/views',
            ],
        ];
    }

    public function get(string $key): mixed
    {
        $value = $this->config;

        foreach (explode('.', $key) as $key) {
            if (isset($value[$key])) {
                $value = $value[$key];
            } else {
                return null;
            }
        }
        return $value;
    }

    public function isTheme(): bool
    {
        return 'theme' === $this->get('env.mode');
    }

    public function isPlugin(): bool
    {
        return 'plugin' === $this->get('env.mode');
    }
}
