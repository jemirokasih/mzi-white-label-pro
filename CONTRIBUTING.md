# Contributing

Thanks for helping improve MZI White Label Pro.

## Development Guidelines

- Keep features modular inside `mzi-white-label-pro/includes/modules/`.
- Preserve the existing option name: `mzi_white_label_settings`.
- Avoid changes that interfere with Wordfence admin pages or security workflows.
- Keep client-facing controls opt-in where they hide important WordPress signals.
- Run PHP syntax checks before submitting changes.

## PHP Syntax Check

```bash
find mzi-white-label-pro -name '*.php' -print -exec php -l {} \;
```

## Build Release ZIP

```bash
zip -r mzi-white-label-pro-v3.0.2.zip mzi-white-label-pro -x '*.DS_Store' '*.git*'
```

The release ZIP should contain `mzi-white-label-pro/` as the top-level folder.
