# Changelog

All notable changes to MZI White Label Pro are documented here.

## [3.0.1] - 2026-05-20

### Added

- Persistent changelog registry so previous release notes stay visible in the plugin admin page.
- Short helper descriptions under every settings option.
- Dashboard widget hide options for:
  - Yoast SEO Posts Overview
  - Elementor Overview
  - Yoast SEO / Wincher: Top Keyphrases
- Client-mode option to hide update notifications from non-administrator users.

### Changed

- Changelog tab now renders versioned entries instead of one overwritten text block.
- Generated plugin ZIP files are ignored by Git.

## [3.0.0] - 2026-05-20

### Added

- Modular plugin architecture.
- Admin Menu Manager for Client Mode.
- Dashboard Widget Manager.
- Login Page Customizer.
- Compatibility Guard for Wordfence.
- Separate admin, login, and dark admin assets.

### Changed

- Main plugin file is now a lightweight bootstrap.
- Settings UI now uses a field registry.
- Existing `mzi_white_label_settings` option is preserved for upgrade compatibility.

### Compatibility

- Wordfence admin pages, translated text, protected menu slugs, and heartbeat behavior are protected by default.
