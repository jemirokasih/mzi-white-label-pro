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
        add_action('admin_init', [$this, 'hide_update_notices']);
        add_action('admin_head', [$this, 'hide_update_notice_styles']);
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

    public function hide_update_notices() {
        if (!$this->should_hide_update_notices()) {
            return;
        }

        remove_action('admin_notices', 'update_nag', 3);
        remove_action('network_admin_notices', 'update_nag', 3);
    }

    public function hide_update_notice_styles() {
        if (!$this->should_hide_update_notices()) {
            return;
        }

        ?>
        <style>
            .update-nag,
            .plugin-update-tr,
            .theme-update-message,
            .update-message,
            .notice.update-message,
            .notice.notice-warning.update-message,
            .wp-list-table .update,
            .wp-menu-name .update-plugins {
                display: none !important;
            }
        </style>
        <?php
    }

    private function should_hide_update_notices() {
        if (!MZI_White_Label_Pro_Settings::enabled('client_mode')) {
            return false;
        }

        if (!MZI_White_Label_Pro_Settings::enabled('hide_update_notices')) {
            return false;
        }

        return !current_user_can('administrator');
    }
}
