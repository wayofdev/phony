<?php

declare(strict_types=1);

namespace WayOfDev\Tests\Unit\Result;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use WayOfDev\TBP\Result\Severity;

#[CoversClass(Severity::class)]
final class SeverityTest extends TestCase
{
    #[Test]
    public function error_has_correct_value(): void
    {
        self::assertSame('error', Severity::Error->value);
    }

    #[Test]
    public function warning_has_correct_value(): void
    {
        self::assertSame('warning', Severity::Warning->value);
    }

    #[Test]
    public function info_has_correct_value(): void
    {
        self::assertSame('info', Severity::Info->value);
    }

    #[Test]
    public function can_create_from_string(): void
    {
        self::assertSame(Severity::Error, Severity::from('error'));
        self::assertSame(Severity::Warning, Severity::from('warning'));
        self::assertSame(Severity::Info, Severity::from('info'));
    }

    #[Test]
    public function has_three_cases(): void
    {
        self::assertCount(3, Severity::cases());
    }
}
