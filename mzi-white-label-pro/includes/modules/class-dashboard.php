<?php

if (!defined('ABSPATH')) {
    exit;
}

class MZI_White_Label_Pro_Dashboard {

    public function __construct() {
        add_action('wp_dashboard_setup', [$this, 'remove_widgets'], 99);
        add_action('wp_dashboard_setup', [$this, 'register_widget']);
    }

    public function remove_widgets() {
        if (!MZI_White_Label_Pro_Settings::enabled('dashboard_hide_selected_widgets')) {
            return;
        }

        $widgets = MZI_White_Label_Pro_Settings::get('dashboard_hidden_widgets', []);
        $widgets = is_array($widgets) ? $widgets : [];

        foreach ($widgets as $widget_id) {
            remove_meta_box($widget_id, 'dashboard', 'normal');
            remove_meta_box($widget_id, 'dashboard', 'side');
        }
    }

    public function register_widget() {
        if (!MZI_White_Label_Pro_Settings::enabled('dashboard_widget_enabled', true)) {
            return;
        }

        wp_add_dashboard_widget(
            'mzi_dashboard_widget',
            $this->widget_title(),
            [$this, 'render_widget']
        );
    }

    public function render_widget() {
        $content = MZI_White_Label_Pro_Settings::get('dashboard_widget_content');

        if ('' === $content) {
            $cms_name = MZI_White_Label_Pro_Settings::get('cms_name', 'MZI CMS');
            $content = '<h2>' . esc_html($cms_name) . '</h2><p>Powered by PT Mikrotek Zemiro Indonesia</p>';

            echo $content;
            return;
        }

        echo wp_kses_post(wpautop($content));
    }

    private function widget_title() {
        $title = MZI_White_Label_Pro_Settings::get('dashboard_widget_title', 'Welcome');

        return '' === $title ? 'Welcome' : $title;
    }
}
