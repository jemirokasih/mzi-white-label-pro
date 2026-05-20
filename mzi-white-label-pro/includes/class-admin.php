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
            'login_logo'       => ['label' => 'Login Logo', 'type' => 'image', 'description' => 'Logo yang tampil di halaman login WordPress. Gunakan gambar PNG/SVG dengan background transparan untuk hasil rapi.'],
            'admin_logo'       => ['label' => 'Admin Logo', 'type' => 'image', 'description' => 'Logo kecil yang menggantikan logo WordPress di admin bar.'],
            'favicon'          => ['label' => 'Favicon', 'type' => 'image', 'description' => 'Icon browser untuk area admin dan login. Ukuran umum: 32x32 atau 512x512.'],
            'login_background' => ['label' => 'Login Background', 'type' => 'image', 'description' => 'Gambar background halaman login. Akan ditampilkan cover memenuhi layar.'],
            'cms_name'         => ['label' => 'CMS Name', 'type' => 'text', 'description' => 'Nama CMS/brand yang menggantikan teks WordPress di area yang aman untuk white label.'],
            'footer_text'      => ['label' => 'Footer Text', 'type' => 'text', 'description' => 'Teks footer di dashboard admin. Bisa diisi nama agensi atau support brand.'],
            'login_title'      => ['label' => 'Login Title', 'type' => 'text', 'description' => 'Teks tooltip/title pada logo login. Default mengikuti nama website.'],
        ],
        'login' => [
            'login_logo_width'          => ['label' => 'Logo Width', 'type' => 'number', 'suffix' => 'px', 'description' => 'Lebar logo login dalam pixel. Kosongkan atau isi 0 untuk memakai ukuran default.'],
            'login_logo_height'         => ['label' => 'Logo Height', 'type' => 'number', 'suffix' => 'px', 'description' => 'Tinggi area logo login dalam pixel. Berguna jika logo terlihat terlalu kecil atau terpotong.'],
            'login_background_color'    => ['label' => 'Background Color', 'type' => 'color', 'description' => 'Warna background fallback jika tidak memakai gambar background. Format: #123456.'],
            'login_button_color'        => ['label' => 'Button Color', 'type' => 'color', 'description' => 'Warna tombol utama di halaman login. Format: #123456.'],
            'login_form_position'       => [
                'label'   => 'Form Position',
                'type'    => 'select',
                'description' => 'Posisi form login di layar. Pilih kiri/kanan jika background punya area visual khusus.',
                'choices' => [
                    'center' => 'Center',
                    'left'   => 'Left',
                    'right'  => 'Right',
                ],
            ],
            'hide_login_back_to_site'   => ['label' => 'Hide Back To Site Link', 'type' => 'checkbox', 'description' => 'Menyembunyikan link kembali ke website dari halaman login.'],
            'hide_login_language_switcher' => ['label' => 'Hide Language Switcher', 'type' => 'checkbox', 'description' => 'Menyembunyikan dropdown bahasa WordPress di halaman login.'],
            'login_custom_css'          => ['label' => 'Custom Login CSS', 'type' => 'textarea', 'description' => 'CSS tambahan khusus halaman login. Gunakan hanya untuk penyesuaian kecil.'],
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
                'description' => 'Hanya berlaku saat Client Mode aktif dan user bukan administrator. Menu Wordfence tetap dilindungi jika Compatibility Guard aktif.',
            ],
            'custom_hidden_menus' => [
                'label'       => 'Custom Menu Slugs',
                'type'        => 'textarea',
                'description' => 'Satu slug menu per baris. Contoh: edit.php?post_type=product',
            ],
            'menu_renames' => [
                'label'       => 'Rename Menus',
                'type'        => 'textarea',
                'description' => 'Satu aturan per baris dengan format slug|Label Baru. Contoh: edit.php|Articles',
            ],
        ],
        'dashboard' => [
            'dashboard_widget_enabled' => ['label' => 'Show Custom Welcome Widget', 'type' => 'checkbox', 'description' => 'Menampilkan widget welcome custom di halaman Dashboard WordPress.'],
            'dashboard_widget_title'   => ['label' => 'Widget Title', 'type' => 'text', 'description' => 'Judul widget welcome custom. Jika kosong, default-nya Welcome.'],
            'dashboard_widget_content' => ['label' => 'Widget Content', 'type' => 'textarea', 'description' => 'Isi widget welcome. Mendukung teks sederhana dan HTML aman WordPress.'],
            'dashboard_hide_selected_widgets' => ['label' => 'Hide Selected Widgets', 'type' => 'checkbox', 'description' => 'Aktifkan untuk menyembunyikan widget dashboard yang dipilih di bawah.'],
            'dashboard_hidden_widgets' => [
                'label'   => 'Dashboard Widgets',
                'type'    => 'checkbox_group',
                'description' => 'Pilih widget dashboard bawaan/plugin yang ingin disembunyikan dari tampilan dashboard.',
                'choices' => [
                    'dashboard_primary'      => 'WordPress Events and News',
                    'dashboard_quick_press'  => 'Quick Draft',
                    'dashboard_activity'     => 'Activity',
                    'dashboard_right_now'    => 'At a Glance',
                    'dashboard_site_health'  => 'Site Health Status',
                    'wpseo-dashboard-overview' => 'Yoast SEO Posts Overview',
                    'e-dashboard-overview'      => 'Elementor Overview',
                    'wpseo-wincher-dashboard-overview' => 'Yoast SEO / Wincher: Top Keyphrases',
                ],
            ],
        ],
        'security' => [
            'client_mode' => ['label' => 'Enable Client Mode', 'type' => 'checkbox', 'description' => 'Mode aman untuk client: menyembunyikan menu sensitif dari user non-administrator.'],
            'hide_update_notices' => ['label' => 'Hide Update Notices In Client Mode', 'type' => 'checkbox', 'description' => 'Menyembunyikan notifikasi update agar user client tidak panik. Administrator tetap bisa melihat update.'],
        ],
        'email' => [
            'mail_name'  => ['label' => 'Sender Name', 'type' => 'text', 'description' => 'Nama pengirim default untuk email WordPress.'],
            'mail_email' => ['label' => 'Sender Email', 'type' => 'email', 'description' => 'Alamat email pengirim default. Pastikan domain email sesuai agar deliverability tetap baik.'],
        ],
        'theme' => [
            'dark_admin' => ['label' => 'Enable Dark Admin', 'type' => 'checkbox', 'description' => 'Mengaktifkan tampilan gelap sederhana untuk area admin WordPress.'],
        ],
        'advanced' => [
            'disable_gutenberg' => ['label' => 'Disable Gutenberg', 'type' => 'checkbox', 'description' => 'Mematikan block editor untuk post agar editor klasik bisa digunakan oleh tema/plugin yang membutuhkannya.'],
            'disable_comments'  => ['label' => 'Disable Comments', 'type' => 'checkbox', 'description' => 'Menutup komentar dan ping baru di frontend. Tidak menghapus komentar lama.'],
            'disable_heartbeat' => ['label' => 'Disable Heartbeat', 'type' => 'checkbox', 'description' => 'Mematikan WordPress Heartbeat untuk mengurangi request admin. Halaman Wordfence tetap dilindungi.'],
            'disable_xmlrpc'    => ['label' => 'Disable XMLRPC', 'type' => 'checkbox', 'description' => 'Mematikan XML-RPC jika website tidak memakai aplikasi/layanan yang membutuhkannya.'],
        ],
        'compat' => [
            'protect_wordfence' => [
                'label'       => 'Protect Wordfence Areas',
                'type'        => 'checkbox',
                'default'     => '1',
                'description' => 'Direkomendasikan. Menjaga halaman, teks, menu, dan heartbeat Wordfence agar tidak terkena white-label override.',
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
        // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only tab routing in the admin page URL.
        $active_tab = isset($_GET['tab']) ? sanitize_key(wp_unslash($_GET['tab'])) : 'branding';

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
                    <td><?php echo esc_html($this->server_software()); ?></td>
                </tr>
            </tbody>
        </table>
        <?php
    }

    private function render_changelog_tab() {
        foreach (MZI_White_Label_Pro_Changelog::entries() as $version => $groups) :
            ?>
            <div class="mzi-wlp-changelog">
                <h2><?php echo esc_html('MZI White Label Pro v' . $version); ?></h2>

                <?php foreach ($groups as $group => $items) : ?>
                    <h3><?php echo esc_html($group); ?></h3>
                    <ul>
                        <?php foreach ($items as $item) : ?>
                            <li><?php echo esc_html($item); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endforeach; ?>
            </div>
            <?php
        endforeach;
    }

    private function open_form($fields) {
        ?>
        <form method="post" action="options.php">
            <?php settings_fields('mzi_white_label_group'); ?>
            <input type="hidden"
                   name="<?php echo esc_attr(MZI_White_Label_Pro_Settings::field_name('__fields')); ?>"
                   value="<?php echo esc_attr(implode(',', $fields)); ?>">
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

    private function server_software() {
        if (empty($_SERVER['SERVER_SOFTWARE'])) {
            return '-';
        }

        return sanitize_text_field(wp_unslash($_SERVER['SERVER_SOFTWARE']));
    }
}
