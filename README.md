# Composer Update Lock Only

Run 'composer update:lock-only' to update composer.lock file per 'composer update' without downloading dependencies.

## Usage

```
$ composer global require --no-dev g1a/composer-update-lock-only
$ composer update:lock-only
```

Note that it is appropriate and safe to use `composer global require` to install this tool because:

1. It is a Composer Plugin.
2. It has no dependencies (when installed with --no-dev).

See [Fixing the Composer Global Command](https://pantheon.io/blog/fixing-composer-global-command) for more information.
