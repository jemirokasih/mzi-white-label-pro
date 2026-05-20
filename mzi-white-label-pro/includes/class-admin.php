<?php

if (!defined('ABSPATH')) {
    exit;
}

class MZI_White_Label_Pro_Admin {

    private $tabs = [
        'branding'  => 'Branding',
        'login'     => 'Login Page',
        'menus'     => 'Admin Menus',
        'dashboard' => 'Dashboard',
        'security'  => 'Security',
        'email'     => 'Email',
        'theme'     => 'Admin Theme',
        'advanced'  => 'Advanced',
        'compat'    => 'Compatibility',
        'system'    => 'System Info',
        'changelog' => 'Change Log',
    ];

    private $fields = [
        'branding' => [
            'login_logo'       => ['label' => 'Login Logo', 'type' => 'image'],
            'admin_logo'       => ['label' => 'Admin Logo', 'type' => 'image'],
            'favicon'          => ['label' => 'Favicon', 'type' => 'image'],
            'login_background' => ['label' => 'Login Background', 'type' => 'image'],
            'cms_name'         => ['label' => 'CMS Name', 'type' => 'text'],
            'footer_text'      => ['label' => 'Footer Text', 'type' => 'text'],
            'login_title'      => ['label' => 'Login Title', 'type' => 'text'],
        ],
        'login' => [
            'login_logo_width'          => ['label' => 'Logo Width', 'type' => 'number', 'suffix' => 'px'],
            'login_logo_height'         => ['label' => 'Logo Height', 'type' => 'number', 'suffix' => 'px'],
            'login_background_color'    => ['label' => 'Background Color', 'type' => 'color'],
            'login_button_color'        => ['label' => 'Button Color', 'type' => 'color'],
            'login_form_position'       => [
                'label'   => 'Form Position',
                'type'    => 'select',
                'choices' => [
                    'center' => 'Center',
                    'left'   => 'Left',
                    'right'  => 'Right',
                ],
            ],
            'hide_login_back_to_site'   => ['label' => 'Hide Back To Site Link', 'type' => 'checkbox'],
            'hide_login_language_switcher' => ['label' => 'Hide Language Switcher', 'type' => 'checkbox'],
            'login_custom_css'          => ['label' => 'Custom Login CSS', 'type' => 'textarea'],
        ],
        'menus' => [
            'hidden_menus' => [
                'label'   => 'Hide Menus In Client Mode',
                'type'    => 'checkbox_group',
                'choices' => [
                    'index.php'                => 'Dashboard',
                    'edit.php'                 => 'Posts',
                    'upload.php'               => 'Media',
                    'edit.php?post_type=page'  => 'Pages',
                    'edit-comments.php'        => 'Comments',
                    'themes.php'               => 'Appearance',
                    'plugins.php'              => 'Plugins',
                    'users.php'                => 'Users',
                    'tools.php'                => 'Tools',
                    'options-general.php'      => 'Settings',
                ],
                'description' => 'Only applies when Client Mode is enabled and the current user is not an administrator.',
            ],
            'custom_hidden_menus' => [
                'label'       => 'Custom Menu Slugs',
                'type'        => 'textarea',
                'description' => 'One menu slug per line, for example: edit.php?post_type=product',
            ],
            'menu_renames' => [
                'label'       => 'Rename Menus',
                'type'        => 'textarea',
                'description' => 'One rule per line using slug|New Label, for example: edit.php|Articles',
            ],
        ],
        'dashboard' => [
            'dashboard_widget_enabled' => ['label' => 'Show Custom Welcome Widget', 'type' => 'checkbox'],
            'dashboard_widget_title'   => ['label' => 'Widget Title', 'type' => 'text'],
            'dashboard_widget_content' => ['label' => 'Widget Content', 'type' => 'textarea'],
            'dashboard_hide_selected_widgets' => ['label' => 'Hide Selected Widgets', 'type' => 'checkbox'],
            'dashboard_hidden_widgets' => [
                'label'   => 'Dashboard Widgets',
                'type'    => 'checkbox_group',
                'choices' => [
                    'dashboard_primary'      => 'WordPress Events and News',
                    'dashboard_quick_press'  => 'Quick Draft',
                    'dashboard_activity'     => 'Activity',
                    'dashboard_right_now'    => 'At a Glance',
                    'dashboard_site_health'  => 'Site Health Status',
                ],
            ],
        ],
        'security' => [
            'client_mode' => ['label' => 'Enable Client Mode', 'type' => 'checkbox'],
        ],
        'email' => [
            'mail_name'  => ['label' => 'Sender Name', 'type' => 'text'],
            'mail_email' => ['label' => 'Sender Email', 'type' => 'email'],
        ],
        'theme' => [
            'dark_admin' => ['label' => 'Enable Dark Admin', 'type' => 'checkbox'],
        ],
        'advanced' => [
            'disable_gutenberg' => ['label' => 'Disable Gutenberg', 'type' => 'checkbox'],
            'disable_comments'  => ['label' => 'Disable Comments', 'type' => 'checkbox'],
            'disable_heartbeat' => ['label' => 'Disable Heartbeat', 'type' => 'checkbox'],
            'disable_xmlrpc'    => ['label' => 'Disable XMLRPC', 'type' => 'checkbox'],
        ],
        'compat' => [
            'protect_wordfence' => [
                'label'       => 'Protect Wordfence Areas',
                'type'        => 'checkbox',
                'default'     => '1',
                'description' => 'Recommended. Keeps Wordfence pages, text, and heartbeat behavior outside white-label overrides.',
            ],
        ],
    ];

    public function __construct() {
        add_action('admin_menu', [$this, 'register_menu']);
        add_action('admin_init', [$this, 'register_settings']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_assets']);
    }

    public function register_menu() {
        add_menu_page(
            'MZI White Label',
            'MZI White Label',
            'manage_options',
            'mzi-white-label',
            [$this, 'settings_page'],
            'dashicons-admin-customizer',
            2
        );
    }

    public function register_settings() {
        register_setting(
            'mzi_white_label_group',
            MZI_White_Label_Pro_Settings::option_name(),
            [
                'sanitize_callback' => ['MZI_White_Label_Pro_Settings', 'sanitize'],
            ]
        );
    }

    public function enqueue_assets($hook) {
        if ('toplevel_page_mzi-white-label' !== $hook) {
            return;
        }

        wp_enqueue_media();
        wp_enqueue_style(
            'mzi-wlp-admin',
            MZI_WLP_URL . 'assets/css/admin.css',
            [],
            MZI_WLP_VERSION
        );
        wp_enqueue_script(
            'mzi-wlp-admin',
            MZI_WLP_URL . 'assets/js/admin.js',
            ['jquery'],
            MZI_WLP_VERSION,
            true
        );
        wp_localize_script(
            'mzi-wlp-admin',
            'mziWlpMedia',
            [
                'title'      => __('Select Image', 'mzi-white-label-pro'),
                'buttonText' => __('Use this image', 'mzi-white-label-pro'),
            ]
        );
    }

    public function settings_page() {
        $settings = MZI_White_Label_Pro_Settings::all();
        $active_tab = isset($_GET['tab']) ? sanitize_key($_GET['tab']) : 'branding';

        if (!isset($this->tabs[$active_tab])) {
            $active_tab = 'branding';
        }

        ?>
        <div class="wrap mzi-wlp-wrap">
            <h1>MZI White Label Pro v<?php echo esc_html(MZI_WLP_VERSION); ?></h1>

            <nav class="nav-tab-wrapper">
                <?php foreach ($this->tabs as $tab => $label) : ?>
                    <a href="<?php echo esc_url(admin_url('admin.php?page=mzi-white-label&tab=' . $tab)); ?>"
                       class="nav-tab <?php echo $active_tab === $tab ? 'nav-tab-active' : ''; ?>">
                        <?php echo esc_html($label); ?>
                    </a>
                <?php endforeach; ?>
            </nav>

            <?php
            if (isset($this->fields[$active_tab])) {
                $this->render_fields_tab($active_tab, $settings);
            } elseif ('system' === $active_tab) {
                $this->render_system_tab();
            } elseif ('changelog' === $active_tab) {
                $this->render_changelog_tab();
            }
            ?>
        </div>
        <?php
    }

    private function render_fields_tab($tab, $settings) {
        $fields = $this->fields[$tab];

        $this->open_form(array_keys($fields));
        ?>
        <table class="form-table mzi-wlp-form-table">
            <?php foreach ($fields as $key => $field) : ?>
                <tr>
                    <th scope="row"><?php echo esc_html($field['label']); ?></th>
                    <td><?php $this->render_field($key, $field, $settings); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php
        submit_button();
        $this->close_form();
    }

    private function render_field($key, $field, $settings) {
        $value = isset($settings[$key]) ? $settings[$key] : (isset($field['default']) ? $field['default'] : '');

        switch ($field['type']) {
            case 'checkbox':
                $this->checkbox_field($key, $value);
                break;
            case 'checkbox_group':
                $this->checkbox_group_field($key, $value, $field);
                break;
            case 'color':
                $this->input_field($key, $value, 'text', 'mzi-wlp-color-field');
                break;
            case 'email':
                $this->input_field($key, $value, 'email');
                break;
            case 'number':
                $this->number_field($key, $value, $field);
                break;
            case 'image':
                $this->image_field($key, $value);
                break;
            case 'select':
                $this->select_field($key, $value, $field);
                break;
            case 'textarea':
                $this->textarea_field($key, $value);
                break;
            case 'text':
            default:
                $this->input_field($key, $value, 'text');
                break;
        }

        if (!empty($field['description'])) {
            echo '<p class="description">' . esc_html($field['description']) . '</p>';
        }
    }

    private function render_system_tab() {
        ?>
        <table class="widefat striped mzi-wlp-system-table">
            <tbody>
                <tr>
                    <td><strong>PHP Version</strong></td>
                    <td><?php echo esc_html(phpversion()); ?></td>
                </tr>
                <tr>
                    <td><strong>WordPress Version</strong></td>
                    <td><?php echo esc_html(get_bloginfo('version')); ?></td>
                </tr>
                <tr>
                    <td><strong>Memory Limit</strong></td>
                    <td><?php echo esc_html(ini_get('memory_limit')); ?></td>
                </tr>
                <tr>
                    <td><strong>Server Software</strong></td>
                    <td><?php echo esc_html(isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : '-'); ?></td>
                </tr>
            </tbody>
        </table>
        <?php
    }

    private function render_changelog_tab() {
        ?>
        <div class="mzi-wlp-changelog">
<pre>
MZI White Label Pro v3.0.0

[Changed]
- Modular plugin architecture
- Lightweight bootstrap file
- Shared settings manager
- Field registry for admin settings
- Admin menu manager for client mode
- Dashboard widget manager
- Login page customizer
- Separate assets for admin JavaScript, login branding, and admin theme CSS
- Separate modules for branding, dashboard, security, email, advanced controls, and admin theme

[Compatibility]
- Existing mzi_white_label_settings option is preserved
- Wordfence admin pages, text, and heartbeat behavior are protected by default
</pre>
        </div>
        <?php
    }

    private function open_form($fields) {
        ?>
        <form method="post" action="options.php">
            <?php settings_fields('mzi_white_label_group'); ?>
            <input type="hidden" name="mzi_wlp_fields" value="<?php echo esc_attr(implode(',', $fields)); ?>">
        <?php
    }

    private function close_form() {
        ?>
        </form>
        <?php
    }

    private function input_field($key, $value, $type, $class = '') {
        ?>
        <input type="<?php echo esc_attr($type); ?>"
               class="regular-text <?php echo esc_attr($class); ?>"
               name="<?php echo esc_attr(MZI_White_Label_Pro_Settings::field_name($key)); ?>"
               value="<?php echo esc_attr($value); ?>">
        <?php
    }

    private function checkbox_field($key, $value) {
        ?>
        <label>
            <input type="checkbox"
                   name="<?php echo esc_attr(MZI_White_Label_Pro_Settings::field_name($key)); ?>"
                   value="1"
                   <?php checked($value, '1'); ?>>
            <?php esc_html_e('Enabled', 'mzi-white-label-pro'); ?>
        </label>
        <?php
    }

    private function checkbox_group_field($key, $value, $field) {
        $value = is_array($value) ? $value : [];
        ?>
        <fieldset class="mzi-wlp-checkbox-group">
            <?php foreach ($field['choices'] as $choice_value => $label) : ?>
                <label>
                    <input type="checkbox"
                           name="<?php echo esc_attr(MZI_White_Label_Pro_Settings::option_name() . '[' . $key . '][]'); ?>"
                           value="<?php echo esc_attr($choice_value); ?>"
                           <?php checked(in_array($choice_value, $value, true)); ?>>
                    <?php echo esc_html($label); ?>
                </label>
            <?php endforeach; ?>
        </fieldset>
        <?php
    }

    private function number_field($key, $value, $field) {
        ?>
        <input type="number"
               class="small-text"
               min="0"
               name="<?php echo esc_attr(MZI_White_Label_Pro_Settings::field_name($key)); ?>"
               value="<?php echo esc_attr($value); ?>">
        <?php if (!empty($field['suffix'])) : ?>
            <span><?php echo esc_html($field['suffix']); ?></span>
        <?php endif; ?>
        <?php
    }

    private function select_field($key, $value, $field) {
        ?>
        <select name="<?php echo esc_attr(MZI_White_Label_Pro_Settings::field_name($key)); ?>">
            <?php foreach ($field['choices'] as $choice_value => $label) : ?>
                <option value="<?php echo esc_attr($choice_value); ?>" <?php selected($value, $choice_value); ?>>
                    <?php echo esc_html($label); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php
    }

    private function textarea_field($key, $value) {
        ?>
        <textarea class="large-text code mzi-wlp-textarea"
                  rows="6"
                  name="<?php echo esc_attr(MZI_White_Label_Pro_Settings::field_name($key)); ?>"><?php echo esc_textarea($value); ?></textarea>
        <?php
    }

    private function image_field($key, $value) {
        ?>
        <div class="mzi-wlp-media-field">
            <input type="text"
                   class="regular-text mzi-wlp-media-url"
                   name="<?php echo esc_attr(MZI_White_Label_Pro_Settings::field_name($key)); ?>"
                   id="<?php echo esc_attr($key); ?>"
                   value="<?php echo esc_attr($value); ?>">

            <button type="button" class="button mzi-upload-button" data-target="<?php echo esc_attr($key); ?>">
                <?php esc_html_e('Upload', 'mzi-white-label-pro'); ?>
            </button>
            <button type="button" class="button mzi-remove-button" data-target="<?php echo esc_attr($key); ?>">
                <?php esc_html_e('Remove', 'mzi-white-label-pro'); ?>
            </button>

            <div class="mzi-wlp-preview-wrap">
                <img id="<?php echo esc_attr($key); ?>_preview"
                     class="mzi-wlp-image-preview"
                     src="<?php echo esc_url($value); ?>"
                     alt="">
            </div>
        </div>
        <?php
    }
}
