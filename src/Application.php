<?php

declare(strict_types=1);

namespace WayOfDev\TBP;

use Symfony\Component\Console\Application as BaseApplication;

// use TBP\Command\Composer\CheckCommand as ComposerCheckCommand;
// use TBP\Command\Composer\NormalizeCommand;
// use TBP\Command\Style\CheckCommand as StyleCheckCommand;
// use TBP\Command\Style\FixCommand;

final class Application extends BaseApplication
{
    public const string NAME = 'tbp';

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
