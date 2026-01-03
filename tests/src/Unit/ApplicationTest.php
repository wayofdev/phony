<?php

declare(strict_types=1);

namespace WayOfDev\Tests\Unit;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use WayOfDev\TBP\Application;

#[CoversClass(Application::class)]
final class ApplicationTest extends TestCase
{
    #[Test]
    public function can_be_instantiated(): void
    {
        $application = new Application();

        self::assertInstanceOf(Application::class, $application);
    }

    #[Test]
    public function has_correct_name(): void
    {
        $application = new Application();

        self::assertSame(Application::NAME, $application->getName());
    }

    #[Test]
    public function has_correct_version(): void
    {
        $application = new Application();

        self::assertSame(Application::VERSION, $application->getVersion());
    }
}
