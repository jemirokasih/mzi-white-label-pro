<?php

if (!defined('ABSPATH')) {
    exit;
}

class MZI_White_Label_Pro_Compatibility {

    public static function protect_wordfence() {
        return MZI_White_Label_Pro_Settings::enabled('protect_wordfence', true);
    }

    public static function is_wordfence_context($domain = '') {
        if (!self::protect_wordfence()) {
            return false;
        }

        if (is_string($domain) && false !== stripos($domain, 'wordfence')) {
            return true;
        }

        // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only admin page detection.
        if (!is_admin() || empty($_GET['page'])) {
            return false;
        }

        // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only admin page detection.
        return self::is_wordfence_page(wp_unslash($_GET['page']));
    }

    public static function is_protected_menu_slug($slug) {
        if (!self::protect_wordfence()) {
            return false;
        }

        return self::is_wordfence_page($slug);
    }

    private static function is_wordfence_page($page) {
        $page = sanitize_text_field(wp_unslash($page));

        return 0 === stripos($page, 'wordfence');
    }
}
