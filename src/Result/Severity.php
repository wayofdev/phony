<?php

declare(strict_types=1);

namespace WayOfDev\TBP\Result;

enum Severity: string
{
    case Error = 'error';

    case Warning = 'warning';

    case Info = 'info';
}
