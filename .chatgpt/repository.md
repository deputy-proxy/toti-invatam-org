# Repository-specific development configuration

Last verified: 2026-11-22. Re-check manifests, lockfiles, and workflows before each implementation.

## Runtime and resolved framework versions

- Composer PHP constraint: `^8.2`.
- CI runs PHP `8.4`. The committed dependency lockfile currently resolves Symfony 8.1 components that require PHP `>=8.4.1`, so PHP 8.4 is the compatible CI runtime for this lockfile.
- Laravel `11.56.1`; Filament `3.3.55`; Livewire `3.8.8`.
- PHPUnit `11.5.56`; Laravel Pint `1.32.1`.
- PHPStan `2.3.7`; Larastan `3.15.0`.
- Node.js `22` in CI.
- npm lockfile resolves Vite `5.4.21`, Tailwind CSS `3.4.19`, Laravel Vite plugin `1.3.0`, Alpine.js `3.17.2`, and Axios `1.20.0`.

## GitHub Actions CI

Workflow: `.github/workflows/ci.yml`.

Triggers:
- Pull requests targeting `main`.
- Pushes to `main`.
- Manual `workflow_dispatch`.

The workflow uses read-only `contents` permissions and does not require production secrets. It contains independent jobs:

1. **PHP tests and migrations**: installs from `composer.lock`, runs all Laravel migrations against SQLite in-memory, then runs the PHPUnit suite.
2. **PHP static analysis**: runs PHPStan with Larastan at level 5.
3. **PHP code style**: runs Laravel Pint in check-only mode.
4. **Frontend production build**: installs from `package-lock.json` with `npm ci` on Node.js 22 and runs the Vite production build.

## Local validation

Install dependencies:
- `composer install`
- `npm ci`

Run the same checks used by CI:
- `php artisan migrate --force` (with `DB_CONNECTION=sqlite` and `DB_DATABASE=:memory:`)
- `composer test`
- `composer analyse`
- `composer format:check`
- `npm run build`

The test environment is configured in `phpunit.xml` and `.env.testing` to use SQLite in-memory, array cache/session/mail, synchronous queues, and a low bcrypt work factor. No production secrets are needed.

## Static analysis

- Configuration: `phpstan.neon`.
- Analysis level: `5`.
- Analyzed paths: `app/`.
- Larastan extension: `vendor/larastan/larastan/extension.neon`.
- Composer entry point: `composer analyse`.
- No baseline is configured. Existing findings discovered during CI setup were fixed rather than suppressed.

## Composer scripts

- `composer test`: runs `php artisan test` using the configured PHPUnit suite.
- `composer analyse`: runs PHPStan/Larastan with the committed configuration.
- `composer format:check`: runs `vendor/bin/pint --test` without modifying source files.

## Notes

- The repository remains on Laravel 11 / Filament 3 / Livewire 3. The separate infrastructure-alignment issue tracks the planned upgrade to the EasyEnglish baseline.
- The existing PHP source was formatted with the repository's locked Pint version to establish a clean formatting baseline. CI only runs Pint in check-only mode.
- The PHPUnit feature suite currently includes a homepage smoke test and runs migrations through Laravel's `RefreshDatabase` trait.
