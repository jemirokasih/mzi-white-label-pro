=== MZI White Label Pro ===
Contributors: mzi
Tags: white label, branding, admin, login, dashboard
Requires at least: 5.8
Tested up to: 6.5
Requires PHP: 7.4
Stable tag: 3.0.1
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Professional white label branding plugin for WordPress agencies and managed client websites.

== Description ==

MZI White Label Pro helps agencies customize the WordPress admin experience for client websites.

Core features include:

* Login logo, background, colors, layout, and custom CSS.
* Admin bar logo replacement.
* Custom CMS name and admin footer text.
* Client Mode for hiding sensitive admin menus from non-administrator users.
* Admin menu hide and rename rules.
* Custom dashboard welcome widget.
* Dashboard widget manager, including WordPress, Yoast SEO, Elementor, and Yoast SEO / Wincher widgets.
* Email sender name and sender email branding.
* Dark admin theme option.
* Advanced controls for Gutenberg, comments, Heartbeat, and XML-RPC.
* Wordfence compatibility guard enabled by default.
* Versioned changelog inside the plugin settings page.

== Installation ==

1. Upload the plugin ZIP from the GitHub release assets.
2. Activate the plugin through the WordPress Plugins screen.
3. Open the MZI White Label menu in WordPress admin.
4. Configure Branding, Login Page, Admin Menus, Dashboard, Security, Email, Admin Theme, Advanced, and Compatibility settings.

Important: use the packaged plugin ZIP, not GitHub's generated source code ZIP.

== Frequently Asked Questions ==

= Will this keep existing settings from older versions? =

Yes. The plugin preserves the existing `mzi_white_label_settings` option.

= Does this conflict with Wordfence? =

The plugin includes a Compatibility tab with Wordfence protection enabled by default. When enabled, Wordfence pages, translated text, protected menu slugs, and heartbeat behavior are not targeted by white-label overrides.

= Can I hide update notices from clients? =

Yes. Enable Client Mode and then enable Hide Update Notices In Client Mode from the Security tab. Administrators still see update notices.

== Changelog ==

= 3.0.1 =

* Added persistent changelog registry.
* Added helper descriptions under every settings option.
* Added dashboard widget hide options for Yoast SEO, Elementor, and Yoast SEO / Wincher.
* Added Client Mode option to hide update notices from non-administrator users.
* Changed changelog tab to render structured version entries.

= 3.0.0 =

* Added modular plugin architecture.
* Added Admin Menu Manager.
* Added Dashboard Widget Manager.
* Added Login Page Customizer.
* Added Compatibility Guard for Wordfence.
* Added separate admin, login, and dark admin assets.
* Preserved existing settings option for upgrade compatibility.
