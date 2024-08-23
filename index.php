<?php

/* plugin name: FP Reflexor Dashboard */

if (!defined('ABSPATH')) {
    exit;
}

// Include the functions file where constants are defined
require_once __DIR__ . '/resources/functions.php';

// Include the bootstrap file
require_once FP_PATH . '/inc/bootstrap.php';

// Include the bootstrap file
fp();

add_action('woocommerce_before_add_to_cart_button', 'display_bulk_variation_grid');

function display_bulk_variation_grid(): void
{
    global $product;

    if ($product->is_type('variable')) {

        $variations = $product->get_available_variations();
        echo $variations;

        echo '<table class="bulk-variation-grid">';
        echo '<tr>';
        foreach ($variations as $variation) {
            echo '<td>';
            echo '<label>' . $variation['attributes']['attribute_pa_size'] . '</label>';
            echo '<input type="number" name="bulk_quantity[' . $variation['variation_id'] . ']" min="0">';
            echo '</td>';
        }
        echo '</tr>';
        echo '</table>';
    }
}

add_action('woocommerce_add_to_cart', 'handle_bulk_add_to_cart');

function handle_bulk_add_to_cart($cart_item_data)
{
    if (isset($_POST['bulk_quantity'])) {
        foreach ($_POST['bulk_quantity'] as $variation_id => $quantity) {
            if ($quantity > 0) {
                WC()->cart->add_to_cart(get_the_ID(), $quantity, $variation_id);
            }
        }
        // Prevent the standard add-to-cart behavior
        return false;
    }
    return $cart_item_data;
}
