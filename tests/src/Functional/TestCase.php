<?php

declare(strict_types=1);

namespace WayOfDev\Tests\Functional;

use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }
}
