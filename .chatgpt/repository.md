# Repository-specific development configuration

Last verified: 2026-11-19. Exact resolved versions are recorded in the cross-repository matrix at [Cr8or](https://github.com/deputy-proxy/cr8or/blob/main/.chatgpt/repository-versions.md). Re-check manifests, lockfiles, and workflows before each implementation.

## Runtime and resolved framework versions
- PHP constraint: `^8.2`.
- Laravel 11.56.1; Filament 3.3.55; Livewire 3.8.8.
- PHPUnit 11.5.56; Pint 1.32.1.
- Pest and Larastan are not currently installed.
- No Node version is defined in the inspected GitHub Actions workflows.
- npm lockfile resolves Vite 5.4.21, Tailwind CSS 3.4.19, Laravel Vite plugin 1.3.0, Alpine.js 3.17.2, and Axios 1.20.0.

## Current CI validation
- No `.github/workflows/` directory or tests workflow was found during inspection.
- Composer manifest does not define project-level test, lint, or static-analysis scripts.
- `package.json` defines `npm run build` and `npm run dev`.
- Do not claim automated tests, static analysis, migrations, frontend tests, or dependency audits are enforced by GitHub Actions until a workflow is added and verified.

## Local validation
- Install PHP dependencies using the committed Composer lockfile.
- Run the existing PHPUnit suite using the installed PHPUnit binary if tests are present.
- Use `npm ci` when the committed `package-lock.json` is present, then `npm run build`.
- Run Pint if installed and configured. Do not invent missing scripts.

## Upgrade and standardization notes
- This repository remains on Laravel 11 / Filament 3 / Livewire 3, unlike the Laravel 13 / Filament 5 / Livewire 4 baseline used by the newer repositories.
- Treat framework upgrades and CI introduction as explicitly scoped work, after inspecting deployment constraints and existing tests.
