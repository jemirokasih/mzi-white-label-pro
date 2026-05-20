<?php

if (!defined('ABSPATH')) {
    exit;
}

class MZI_White_Label_Pro_Advanced {

    public function __construct() {
        add_filter('xmlrpc_enabled', [$this, 'xmlrpc_control']);
        add_filter('use_block_editor_for_post', [$this, 'gutenberg_control']);
        add_action('init', [$this, 'comments_control']);
        add_action('init', [$this, 'heartbeat_control'], 1);
    }

    public function xmlrpc_control($enabled) {
        if (!empty(MZI_White_Label_Pro_Settings::get('disable_xmlrpc'))) {
            return false;
        }

        return $enabled;
    }

    public function gutenberg_control($enabled) {
        if (!empty(MZI_White_Label_Pro_Settings::get('disable_gutenberg'))) {
            return false;
        }

        return $enabled;
    }

    public function comments_control() {
        if (empty(MZI_White_Label_Pro_Settings::get('disable_comments'))) {
            return;
        }

        add_filter('comments_open', '__return_false', 20, 2);
        add_filter('pings_open', '__return_false', 20, 2);
    }

    public function heartbeat_control() {
        if (empty(MZI_White_Label_Pro_Settings::get('disable_heartbeat'))) {
            return;
        }

        if (MZI_White_Label_Pro_Compatibility::is_wordfence_context()) {
            return;
        }

        wp_deregister_script('heartbeat');
    }
}
