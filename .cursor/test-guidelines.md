# Test Guidelines

This document provides best practices for testing in this PHP project.

## Quick Reference: Test Commands

| Command | Purpose | Configuration |
|---------|---------|---------------|
| `make test` | Run all tests (unit + arch) | - |
| `make test-unit` | Run PHPUnit/Pest unit tests | `phpunit.xml.dist` |
| `make test-arch` | Run Pest architecture tests | `pest.xml.dist` |
| `make test-cc` | Run tests with code coverage | Outputs to `.build/` |
| `make infect` | Run mutation tests | `infection.json.dist` |
| `make lint-stan` | Run PHPStan static analysis | `phpstan.neon.dist` |

## Test Directory Structure

```
tests/
└── src/
    ├── Arch/           # Architecture tests (Pest DSL)
    │   └── DebugTest.php
    ├── Functional/     # Functional/integration tests
    │   └── TestCase.php
    └── Unit/           # Unit tests (PHPUnit style)
        └── Result/
```

### Test Categories

1. **Unit Tests** (`tests/src/Unit/`)
   - Test individual classes in isolation
   - Use PHPUnit with `#[Test]` attributes
   - Fast execution, no external dependencies

2. **Functional Tests** (`tests/src/Functional/`)
   - Test feature workflows and integrations
   - Extend from `WayOfDev\Tests\Functional\TestCase`

3. **Architecture Tests** (`tests/src/Arch/`)
   - Use Pest's architecture testing DSL
   - Enforce coding standards and architectural rules
   - Example: Prevent debug functions in production code

## Writing Unit Tests

### Test Class Template

```php
<?php

declare(strict_types=1);

namespace WayOfDev\Tests\Unit;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use WayOfDev\TBP\YourClass;

#[CoversClass(YourClass::class)]
final class YourClassTest extends TestCase
{
    #[Test]
    public function returns_expected_value(): void
    {
        $instance = new YourClass();

        self::assertSame('expected', $instance->getValue());
    }
}
```

### Conventions

1. **Attributes over prefixes**: Use `#[Test]` attribute instead of `test` method prefix
2. **Method naming**: Use `snake_case` for test method names (e.g., `returns_expected_value`)
3. **Coverage attribute**: Always add `#[CoversClass(ClassName::class)]` to test classes
4. **Static assertions**: Use `self::assert*()` instead of `$this->assert*()`
5. **Final classes**: Mark test classes as `final`

## Writing Architecture Tests (Pest)

Architecture tests use Pest's expressive DSL:

```php
<?php

declare(strict_types=1);

// Prevent debug functions in production code
arch('do not forget dumps in your production code')
    ->expect(['trap', 'dd', 'dump', 'exit', 'die', 'print_r', 'var_dump', 'echo', 'print'])
    ->not
    ->toBeUsed();

// Ensure all classes in src/ are final
arch('all classes should be final')
    ->expect('WayOfDev\TBP')
    ->classes()
    ->toBeFinal();
```

## PHPStan Compatibility

This project uses PHPStan at **level: max**. Tests are analyzed too (`tests/` is in paths).

### Common Pitfalls to Avoid

#### 1. Redundant `assertInstanceOf()` Calls

**Bad** - PHPStan error: "will always evaluate to true"

```php
#[Test]
public function can_be_created(): void
{
    $package = Package::fromName('vendor/package');
    
    // Error: Type is already known from return type declaration
    self::assertInstanceOf(Package::class, $package);
}
```

**Good** - Test actual behavior instead:

```php
#[Test]
public function returns_name(): void
{
    $package = Package::fromName('vendor/package');
    
    self::assertSame('vendor/package', $package->name());
}
```

#### 2. Avoid "Can Be Instantiated" Tests

If a class can be instantiated (constructor doesn't throw), other tests will implicitly verify this. Focus on testing behavior, not existence.

#### 3. Type-Related Assertions

When testing return types that are already declared:
- Skip `assertInstanceOf()` for typed returns
- Skip `assertIsArray()` for `array` returns
- Skip `assertIsString()` for `string` returns

Instead, test the **contents** and **behavior**.

## Mutation Testing (Infection)

Mutation testing verifies that your tests actually catch bugs by introducing small changes (mutants) to the code.

### Running Mutation Tests

```bash
make infect          # Local run
make infect-ci       # CI mode with GitHub output
```

### Configuration

See `infection.json.dist`:
- `minMsi`: 60 - Minimum Mutation Score Indicator
- `minCoveredMsi`: 60 - Minimum MSI for covered code
- Source directory: `src/`

### Understanding Results

```
.: killed by tests     # Good - test caught the mutant
M: escaped             # Bad - mutant survived, test gap
U: uncovered           # Not covered by tests
A: killed by SA        # Killed by static analysis
```

### Known Limitations

1. **Enums**: String values in enums have limited mutability - mutations on enum string values rarely produce meaningful tests
2. **Placeholder code**: Empty arrays or commented-out code will generate "escaped" mutants - these are acceptable false positives
3. **Method removal**: Removing calls to methods that have no observable side effects will escape

## Debugging Test Failures

### Verbose Output

```bash
# Run with verbose output
docker compose run --rm --no-deps app vendor/bin/pest -v

# Run specific test file
docker compose run --rm --no-deps app vendor/bin/pest tests/src/Unit/PackageTest.php

# Run specific test method (filter)
docker compose run --rm --no-deps app vendor/bin/pest --filter="returns_name"
```

### Coverage Reports

After running `make test-cc`:
- HTML report: `.build/coverage/index.html`
- Text report: `.build/coverage.txt`
- Clover XML: `.build/phpunit/logs/clover.xml`

### Infection Logs

After running `make infect`:
- Detailed log: `.build/infection/infection-log.txt`

## Common Workflows

### Adding a New Class

1. Create the class in `src/`
2. Create corresponding test in `tests/src/Unit/`
3. Run `make test-unit` to verify tests pass
4. Run `make lint-stan` to verify PHPStan passes
5. Run `make infect` to verify mutation coverage

### Before Committing

```bash
make test          # Run all tests
make lint-stan     # Static analysis
make infect        # Mutation testing
```

### Investigating Mutation Test Failures

1. Check `.build/infection/infection-log.txt` for escaped mutants
2. Identify which mutation escaped
3. Add assertions that would catch the mutation
4. Re-run `make infect`

## Framework Versions

- **PHPUnit**: 12.x
- **Pest**: 4.x (runs on top of PHPUnit)
- **Infection**: 0.32.x (via roave/infection-static-analysis-plugin)
- **PHPStan**: 2.x (level: max)

