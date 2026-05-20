<?php

if (!defined('ABSPATH')) {
    exit;
}

class MZI_White_Label_Pro_Email {

    public function __construct() {
        add_filter('wp_mail_from_name', [$this, 'custom_mail_name']);
        add_filter('wp_mail_from', [$this, 'custom_mail_email']);
    }

    public function custom_mail_name() {
        return MZI_White_Label_Pro_Settings::get('mail_name', get_bloginfo('name'));
    }

    public function custom_mail_email() {
        return MZI_White_Label_Pro_Settings::get('mail_email', get_option('admin_email'));
    }
}
