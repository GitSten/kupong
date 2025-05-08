<?php
/**
* Plugin Name: WooCommerce - Disable Coupon for Specific SKUs
* Description: Takistab kupongi kasutamist määratud SKU-ga toodetele, võimalik määrata kas kehtib logged_in kasutajale või mõlemale.
* Version: 1.1
* Author: Sten
* 
*/

if (!defined('ABSPATH')) {
    exit; // Vältida otsest ligipääsu
}

// Hook kupongi allahindluse filtreerimiseks
add_filter('woocommerce_coupon_get_discount_amount', 'dcfs_exclude_specific_sku_from_discount', 10, 5);

function dcfs_exclude_specific_sku_from_discount($discount, $discounting_amount, $cart_item, $single, $coupon) {
    $excluded_skus = get_option('dcfs_excluded_skus', []);
    $only_logged_in = get_option('dcfs_only_logged_in', 0);

    if (!is_array($excluded_skus)) {
        $excluded_skus = [];
    }

    $product = $cart_item['data'];
    $sku = $product ? $product->get_sku() : '';

    if (!$sku) {
        return $discount;
    }

    // Kui piirang kehtib ainult sisseloginud kasutajatele
    if ($only_logged_in) {
        if (is_user_logged_in() && in_array($sku, $excluded_skus)) {
            return 0;
        }
    } else {
        if (in_array($sku, $excluded_skus)) {
            return 0;
        }
    }

    return $discount;
}

// Lisa admin menüüsse seadete leht
add_action('admin_menu', 'dcfs_add_admin_menu');

function dcfs_add_admin_menu() {
    add_menu_page(
        'Kupongi SKU välistus',
        'Kupongi SKU välistus',
        'manage_options',
        'dcfs_settings',
        'dcfs_settings_page'
    );
}

// Administreerimise vaade
function dcfs_settings_page() {
    ?>
    <div class="wrap">
        <h2>Välista SKU-d kupongidest</h2>
        <?php settings_errors(); ?>
        <form method="post" action="options.php">
            <?php
            settings_fields('dcfs_settings_group');
            do_settings_sections('dcfs_settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Registreeri seaded
add_action('admin_init', 'dcfs_register_settings');

function dcfs_register_settings() {
    register_setting('dcfs_settings_group', 'dcfs_excluded_skus', 'dcfs_sanitize_skus');
    register_setting('dcfs_settings_group', 'dcfs_only_logged_in', 'intval');

    add_settings_section('dcfs_section', 'Kupongi välistatud SKU-d', null, 'dcfs_settings');

    add_settings_field(
        'dcfs_excluded_skus_field',
        'Välistatud SKU-d (komaga eraldatud)',
        'dcfs_excluded_skus_field_callback',
        'dcfs_settings',
        'dcfs_section'
    );

    add_settings_field(
        'dcfs_only_logged_in',
        'Ainult sisseloginud kasutajatele',
        'dcfs_only_logged_in_callback',
        'dcfs_settings',
        'dcfs_section'
    );
}

// SKU-de sisestusväli
function dcfs_excluded_skus_field_callback() {
    $excluded_skus = get_option('dcfs_excluded_skus', []);
    if (is_array($excluded_skus)) {
        $excluded_skus = implode(',', $excluded_skus);
    }
    echo '<input type="text" name="dcfs_excluded_skus" value="' . esc_attr($excluded_skus) . '" class="regular-text" />';
    echo '<p class="description">Sisesta SKU-d komaga eraldatult (nt: 4500, 3211).</p>';
}

// Checkbox väli
function dcfs_only_logged_in_callback() {
    $value = get_option('dcfs_only_logged_in', 0);
    echo '<input type="checkbox" name="dcfs_only_logged_in" value="1"' . checked(1, $value, false) . ' />';
    echo '<p class="description">Kui see on märgitud, rakendub piirang ainult sisseloginud kasutajatele.</p>';
}

// Sanitiseerimine
function dcfs_sanitize_skus($input) {
    if (is_array($input)) {
        return array_map('trim', $input);
    } elseif (is_string($input)) {
        $skus = explode(',', $input);
        return array_map('trim', $skus);
    }
    return [];
}
