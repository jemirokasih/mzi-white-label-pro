<?php

if (!defined('ABSPATH')) {
    exit;
}

class MZI_White_Label_Pro_Security {

    public function __construct() {
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');

        add_filter('the_generator', '__return_empty_string');
        add_filter('emoji_svg_url', '__return_false');
        add_action('admin_menu', [$this, 'client_mode_restriction'], 999);
    }

    public function client_mode_restriction() {
        if (empty(MZI_White_Label_Pro_Settings::get('client_mode'))) {
            return;
        }

        if (current_user_can('administrator')) {
            return;
        }

        remove_menu_page('plugins.php');
        remove_menu_page('themes.php');
        remove_menu_page('tools.php');
        remove_menu_page('options-general.php');
    }
}
