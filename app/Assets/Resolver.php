<?php

namespace FP\Assets;

use Illuminate\Contracts\Filesystem\FileNotFoundException;

trait Resolver
{
    private array $manifest = [];

    /**
     * @action wp_enqueue_scripts 1
     * @throws FileNotFoundException
     */
    public function load(): void
    {
        $path = fp()->config()->get('manifest.path');
        if (empty($path) || !file_exists($path)) {
            wp_die(wp_kses_post(__('Run <code> npm run build </code> in your application', 'fp')));
        }

        $data = fp()->filesystem()->get($path);
        if (!empty($data)) {
            $this->manifest = json_decode($data, true);
        }
    }

    /**
     * @filter script_loader_tag 1 3
     */
    public function module(string $tag, string $handle, string $url): string
    {
        if ((str_contains($url, FP_HMR_HOST)) || (str_contains($url, FP_ASSETS_URI))) {
            $tag = str_replace('<script ', '<script type="module" ', $tag);
        }

        return $tag;
    }

    public function resolve(string $path): string
    {
        $url = '';

        if (!empty($this->manifest["resources/{$path}"])) {
            $url = FP_ASSETS_URI . "/{$this->manifest["resources/{$path}"]['file']}";
        }

        return apply_filters('fp_assets_resolver_url', $url, $path);
    }
}
