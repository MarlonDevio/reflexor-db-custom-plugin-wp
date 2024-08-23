<?php

namespace FP\Assets;

use FP\Assets\Resolver;
use WC_Product;
use WC_Product_Attribute;

class Assets
{
    use Resolver;

    /**
     * @action wp_enqueue_scripts
     * @action wp_enqueue_style
     */
    public function front(): void
    {
// Get the global product object
//        global $product;
//        if (!$product) {
//            return;
//        }
//        $real_product = null;
//
//        // Check if the product object is valid
//        if (!$product || !$product instanceof WC_Product) {
//            $product_id = get_the_ID(); // Get the current post ID
//            $real_product = wc_get_product($product_id); // Get the product object
//        }
//        if (!$product instanceof WC_Product) {
//            echo "Product is a WC_Product";
//        }
//
//        // Get all attributes of the current product
//        $attributes = $real_product->get_attributes();
//
//        foreach ($attributes as $attribute) {
//            $attribute_name = $attribute->get_name();
//            $attribute_value = $attribute->get_options();
//
//            echo "Attribute Name: " . $attribute_name . " Attribute Value: " . $attribute_value;
//
//        }
        // Check if the product object is valid


        // Get all attributes of the current product
        if (is_product()) {
            wp_enqueue_script('fp-shop', $this->resolve('scripts/scripts.js'), [], fp()->config()->get('version'), true);
            wp_enqueue_style('fp-shop-style', $this->resolve('styles/style.css'), [], fp()->config()->get('version'));
        }
    }
}
