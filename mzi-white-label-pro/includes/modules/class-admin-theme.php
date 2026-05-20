<?php

if (!defined('ABSPATH')) {
    exit;
}

class MZI_White_Label_Pro_Admin_Theme {

    public function __construct() {
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_theme']);
    }

    public function enqueue_admin_theme() {
        if (empty(MZI_White_Label_Pro_Settings::get('dark_admin'))) {
            return;
        }

        wp_enqueue_style(
            'mzi-wlp-admin-dark',
            MZI_WLP_URL . 'assets/css/admin-dark.css',
            [],
            MZI_WLP_VERSION
        );
    }
}
