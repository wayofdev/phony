<?php

declare(strict_types=1);

namespace WayOfDev\Tests\Unit;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use WayOfDev\Phony\Package;

#[CoversClass(Package::class)]
final class PackageTest extends TestCase
{
    #[Test]
    public function returns_name(): void
    {
        $package = Package::fromName('vendor/package');

        self::assertSame('vendor/package', $package->name());
    }

    #[Test]
    public function handles_different_names(): void
    {
        $package1 = Package::fromName('wayofdev/phony');
        $package2 = Package::fromName('symfony/console');

        self::assertSame('wayofdev/phony', $package1->name());
        self::assertSame('symfony/console', $package2->name());
    }
}
