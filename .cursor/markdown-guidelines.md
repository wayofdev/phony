# Markdown Guidelines

This document provides guidelines for writing and linting markdown files in this project.

## Quick Reference: Commands

| Command | Purpose |
|---------|---------|
| `make lint-md` | Lint and auto-fix markdown files |
| `make lint-md-dry` | Lint markdown files (dry-run, no fixes) |

## Linting Configuration

Markdown linting uses [markdownlint-cli2](https://github.com/DavidAnson/markdownlint-cli2) with the configuration at `.github/.markdownlint.json`.

### Current Rules

```json
{
    "line-length": false,
    "no-inline-html": false,
    "first-line-h1": false,
    "no-duplicate-heading": false
}
```

### Excluded Files

- `CHANGELOG.md` - Auto-generated, excluded from linting
- `vendor/` - Third-party code, excluded from linting

## Common Lint Errors and Fixes

### MD040: Fenced code blocks should have a language specified

**Bad:**

````markdown
```
some code here
```
````

**Good:**

````markdown
```php
some code here
```
````

For non-code blocks (like directory trees), use `text`:

````markdown
```text
directory/
└── file.txt
```
````

### MD032: Lists should be surrounded by blank lines

**Bad:**

```markdown
Some text:
- Item 1
- Item 2
More text.
```

**Good:**

```markdown
Some text:

- Item 1
- Item 2

More text.
```

### MD012: No multiple consecutive blank lines

**Bad:**

```markdown
First paragraph.


Second paragraph.
```

**Good:**

```markdown
First paragraph.

Second paragraph.
```

## Pre-commit Integration

When pre-commit hooks are installed (`make hooks`), markdown files are automatically linted on commit using the `markdownlint-cli2` Docker image.

The pre-commit hook configuration in `.pre-commit-config.yaml`:

```yaml
- repo: local
  hooks:
    - id: markdownlint
      name: markdownlint-cli2
      description: Run markdownlint-cli2 on your Markdown files using the docker image
      language: docker_image
      types: [markdown]
      entry: davidanson/markdownlint-cli2-rules:latest
```

## Valid Language Identifiers

Common language identifiers for fenced code blocks:

| Language | Identifier |
|----------|------------|
| PHP | `php` |
| Bash/Shell | `bash` or `shell` |
| JSON | `json` |
| YAML | `yaml` |
| Plain text | `text` |
| Diff | `diff` |
| Markdown | `markdown` |

## Best Practices

1. **Always specify language** for fenced code blocks
2. **Use blank lines** before and after lists
3. **Use blank lines** before and after code blocks
4. **Single blank line** between sections (never multiple)
5. **Run `make lint-md-dry`** before committing to check for errors
6. **Install pre-commit hooks** to catch errors automatically

## Editor Integration

For real-time linting in your editor, install the markdownlint extension:

- **VS Code / Cursor**: [markdownlint extension](https://marketplace.visualstudio.com/items?itemName=DavidAnson.vscode-markdownlint)

The extension will automatically use the `.github/.markdownlint.json` configuration.
