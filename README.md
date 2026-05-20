# MZI White Label Pro

Professional white label branding plugin for WordPress, built for agencies and managed client websites.

MZI White Label Pro helps replace default WordPress branding, simplify the admin experience for clients, customize the login page, manage dashboard widgets, and keep sensitive update/security notices away from non-administrator users.

## Features

- Modular v3 architecture for easier maintenance.
- Login logo, background, favicon, title, and styling controls.
- Admin bar logo replacement.
- Custom admin footer and CMS naming.
- Admin menu hide/rename rules for Client Mode.
- Dashboard widget manager with support for hiding selected WordPress, Yoast SEO, Elementor, and Yoast SEO / Wincher widgets.
- Custom dashboard welcome widget.
- Email sender name and sender email branding.
- Dark admin theme option.
- Advanced toggles for Gutenberg, comments, Heartbeat, and XML-RPC.
- Client Mode for hiding sensitive menus and update notices from non-administrator users.
- Wordfence compatibility guard enabled by default.
- Versioned changelog registry inside the plugin admin page.

## Requirements

- WordPress 5.8 or newer.
- PHP 7.4 or newer.
- Administrator access to install and configure the plugin.

## Installation

1. Download the plugin release ZIP from the GitHub Releases page.
2. In WordPress admin, open **Plugins > Add New > Upload Plugin**.
3. Upload `mzi-white-label-pro-v3.0.1.zip`.
4. Activate **MZI White Label Pro**.
5. Open **MZI White Label** in the admin menu and configure the settings.

The ZIP must contain the `mzi-white-label-pro/` folder directly at the root. GitHub's default "Source code" ZIP is not recommended for WordPress upload.

## Upgrade Notes

Version 3.x preserves the existing option name:

```text
mzi_white_label_settings
```

This means settings from earlier versions remain available after upgrading.

Before installing on a production client site, make a normal WordPress backup or test on staging first.

## Wordfence Compatibility

The plugin includes a Compatibility tab with **Protect Wordfence Areas** enabled by default.

When enabled, MZI White Label Pro avoids changing Wordfence admin pages, Wordfence translated text, protected Wordfence menu slugs, and Wordfence heartbeat behavior.

## Release Assets

Use the packaged plugin ZIP for WordPress installs:

```text
mzi-white-label-pro-v3.0.1.zip
```

Do not upload GitHub's generated source archive directly unless you repackage it so `mzi-white-label-pro.php` is inside the top-level plugin folder.

## Development

Current structure:

```text
mzi-white-label-pro/
├── assets/
│   ├── css/
│   └── js/
├── includes/
│   ├── class-admin.php
│   ├── class-changelog.php
│   ├── class-plugin.php
│   ├── class-settings.php
│   └── modules/
└── mzi-white-label-pro.php
```

Run a PHP syntax check before release:

```bash
find mzi-white-label-pro -name '*.php' -print -exec php -l {} \;
```

Build a WordPress-ready ZIP:

```bash
zip -r mzi-white-label-pro-v3.0.1.zip mzi-white-label-pro -x '*.DS_Store' '*.git*'
```

## License

GPL-2.0. See [LICENSE](LICENSE).

## Author

PT Mikrotek Zemiro Indonesia  
Website: https://mzi.co.id
