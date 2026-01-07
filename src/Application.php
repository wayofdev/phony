<?php

declare(strict_types=1);

namespace WayOfDev\Phony;

use Symfony\Component\Console\Application as BaseApplication;

// use Phony\Command\Composer\CheckCommand as ComposerCheckCommand;
// use Phony\Command\Composer\NormalizeCommand;
// use Phony\Command\Style\CheckCommand as StyleCheckCommand;
// use Phony\Command\Style\FixCommand;

final class Application extends BaseApplication
{
    public const string NAME = 'phony';

    public const string VERSION = '0.1.0';

    public function __construct()
    {
        parent::__construct(self::NAME, self::VERSION);

        $this->registerCommands();
    }

    private function registerCommands(): void
    {
        $this->addCommands([
            // new NormalizeCommand(),
            // new ComposerCheckCommand(),
            // new FixCommand(),
            // new StyleCheckCommand(),
        ]);
    }
}
