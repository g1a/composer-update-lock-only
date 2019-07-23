<?php

namespace ComposerUpdateLockOnly;

use Composer\Plugin\Capability\CommandProvider as CommandProviderCapability;
use ComposerUpdateLockOnly\Commands\UpdateLockCommand;

/**
 * List of all commands provided by this package.
 */
class CommandProvider implements CommandProviderCapability
{
      /**
       * {@inheritdoc}
       */
    public function getCommands()
    {
        return [
            new UpdateLockCommand(),
        ];
    }
}
