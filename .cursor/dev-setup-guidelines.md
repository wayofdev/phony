# Development Setup Guidelines

This document provides instructions for setting up a local development environment.

## Prerequisites

Before starting, ensure you have the following installed:

| Tool | Purpose | Installation |
|------|---------|--------------|
| Docker | Container runtime | [docker.com](https://docs.docker.com/get-docker/) |
| Docker Compose | Container orchestration | Included with Docker Desktop |
| pre-commit | Git hooks manager | `pip install pre-commit` or `brew install pre-commit` |
| pnpm (optional) | Node package manager | `npm install -g pnpm` |

## Quick Start

Run the default make target to set up everything:

```bash
make
```

This single command executes:

1. `env` - Creates `.env` file from `.env.example`
2. `prepare` - Creates build directories
3. `install` - Installs Composer dependencies
4. `hooks` - Installs pre-commit git hooks
5. `phive` - Installs PHIVE dependencies
6. `up` - Starts Docker containers

## Step-by-Step Setup

### 1. Clone the Repository

```bash
git clone https://github.com/wayofdev/to-better-php.git
cd to-better-php
```

### 2. Create Environment File

```bash
make env
```

To force recreate the `.env` file:

```bash
make env FORCE=true
```

### 3. Install Dependencies

```bash
make install
```

### 4. Install Pre-commit Hooks

Pre-commit hooks are **essential** for maintaining code quality. They automatically run checks before each commit.

```bash
make hooks
```

This installs:

- **pre-commit hooks** - Run on `git commit`
- **commit-msg hooks** - Validate commit message format (Conventional Commits)

The hooks will:

- Fix trailing whitespace
- Ensure files end with a newline
- Check for large files
- Validate commit messages (Conventional Commits format)
- Run PHP CS Fixer on PHP files
- Lint markdown files with markdownlint-cli2

### 5. Start Docker Containers

```bash
make up
```

## Pre-commit: What Gets Checked

When you commit, pre-commit automatically runs these checks:

| Hook | What it does |
|------|--------------|
| `trailing-whitespace` | Removes trailing whitespace |
| `end-of-file-fixer` | Ensures files end with a newline |
| `check-added-large-files` | Prevents files > 600KB |
| `commitizen` | Validates commit message format |
| `php-cs-fixer` | Fixes PHP code style |
| `markdownlint` | Lints markdown files |

### If a Hook Fails

1. Pre-commit will show the error
2. Some hooks (like `php-cs-fixer`) auto-fix issues
3. Stage the fixed files: `git add .`
4. Commit again: `git commit`

### Bypassing Hooks (Emergency Only)

```bash
git commit --no-verify -m "emergency fix"
```

**Warning**: Only use this in emergencies. Bypassing hooks can introduce code quality issues.

## Available Make Commands

### Docker Commands

| Command | Purpose |
|---------|---------|
| `make up` | Start containers |
| `make down` | Stop and remove containers |
| `make stop` | Stop containers (keep them) |
| `make restart` | Restart containers |
| `make ps` | List running containers |
| `make logs` | Show container logs |
| `make ssh` | SSH into the app container |

### Development Commands

| Command | Purpose |
|---------|---------|
| `make install` | Install Composer dependencies |
| `make update` | Update Composer dependencies |

### Quality Commands

| Command | Purpose |
|---------|---------|
| `make lint` | Run all linters |
| `make lint-php` | Fix PHP code style |
| `make lint-stan` | Run PHPStan |
| `make lint-psalm` | Run Psalm |
| `make lint-md` | Fix markdown files |
| `make refactor` | Run Rector refactoring |

### Testing Commands

| Command | Purpose |
|---------|---------|
| `make test` | Run all tests |
| `make test-unit` | Run unit tests |
| `make test-arch` | Run architecture tests |
| `make test-cc` | Run tests with coverage |
| `make infect` | Run mutation tests |

See `make help` for the full list of commands.

## Troubleshooting

### Pre-commit Not Found

If `make hooks` fails with "pre-commit: command not found":

```bash
# macOS
brew install pre-commit

# Linux/Windows (with Python)
pip install pre-commit

# Verify installation
pre-commit --version
```

### Docker Permission Issues

If you see "permission denied" errors:

```bash
# Add your user to the docker group (Linux)
sudo usermod -aG docker $USER

# Log out and log back in, then verify
docker ps
```

### Git Safe Directory Warning

If you see "detected dubious ownership" warnings:

```bash
git config --global --add safe.directory /app
```

### Composer Version Warning

The warning "Composer could not detect the root package version" is normal in Docker and can be ignored.

## Recommended Editor Setup

### VS Code / Cursor Extensions

- **PHP Intelephense** - PHP intelligence
- **PHPStan** - Static analysis integration
- **markdownlint** - Markdown linting
- **EditorConfig** - Consistent coding styles

### Settings

Add to your `.vscode/settings.json`:

```json
{
    "php.validate.enable": false,
    "intelephense.diagnostics.enable": true,
    "editor.formatOnSave": true
}
```

## Workflow Summary

```text
1. Clone repo
2. make (full setup)
3. Create feature branch
4. Make changes
5. make test && make lint-stan
6. git commit (pre-commit runs automatically)
7. Push and create PR
```

## Related Documentation

- [Test Guidelines](test-guidelines.md) - Testing best practices
- [Markdown Guidelines](markdown-guidelines.md) - Markdown linting rules
