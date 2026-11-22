# Repository-specific development configuration

Last verified: 2026-11-22. Re-check manifests, lockfiles, and workflows before each implementation.

## Runtime and resolved framework versions

- Composer PHP constraint: ^8.4; Composer platform is pinned to 8.4.1 so dependency resolution matches the minimum supported CI runtime.
- CI runs PHP 8.4.
- Laravel constraint: ^13.7; lockfile resolves Laravel 13.43.0. Laravel 13.7.0 has published security advisories, so the lockfile intentionally uses the latest patched Laravel 13 release.
- Filament 5.11.4; Livewire 4.4.8.
- PHPUnit 13.3.4; Laravel Pint 1.32.3.
- PHPStan 2.3.7; Larastan 3.15.0.
- Node.js 22 in CI.
- npm lockfile resolves Vite 8.3.5, Tailwind CSS 4.3.5, Laravel Vite plugin 3.2.0, @tailwindcss/vite 4.3.5, Alpine.js 3.17.2, and Axios 1.20.0.
- npm audit currently reports no vulnerabilities. The unused Tailwind Typography plugin was removed because its dependency tree retained a vulnerable postcss-selector-parser release.

## Framework migration notes

- Filament 3 resources were migrated to the Filament 5 schema API. Resource forms now accept Filament\Schemas\Schema; layout components use Filament\Schemas\Components; row actions use recordActions() and bulk actions use toolbarActions().
- Filament file storage remains on the public disk by default via config/filament.php (FILAMENT_FILESYSTEM_DISK, default public) to preserve existing upload and image URLs.
- Filament assets and caches are refreshed by the filament:upgrade Composer post-autoload script.
- Livewire 4 uses wire:submit; wire:model.lazy remains backward compatible. No custom Livewire endpoint routes are configured.
- Tailwind CSS 4 theme tokens and source scanning are defined in resources/css/app.css. Vite uses @tailwindcss/vite; the old Tailwind 3 and PostCSS config files have been removed.
- config/cache.php disables serialized cache classes (serializable_classes => false) per Laravel 13 security defaults. Existing cache keys and session serialization behavior are retained.

## GitHub Actions CI

Workflow: .github/workflows/ci.yml.

Triggers:
- Pull requests targeting main.
- Pushes to main.
- Manual workflow_dispatch.

The workflow uses read-only contents permissions and does not require production secrets. It contains independent jobs:

1. PHP tests and migrations: PHP 8.4, installs from composer.lock, runs all Laravel migrations against SQLite in-memory, then runs the PHPUnit suite.
2. PHP static analysis: PHP 8.4, runs PHPStan with Larastan at level 5.
3. PHP code style: PHP 8.4, runs Laravel Pint in check-only mode.
4. Frontend production build: Node.js 22, installs from package-lock.json with npm ci, and runs the Vite production build.

## Local validation

Install dependencies: composer install and npm ci.

Run the same checks used by CI:
- php artisan migrate --force (with DB_CONNECTION=sqlite and DB_DATABASE=:memory:)
- composer validate --strict
- composer audit --locked
- composer test
- composer analyse
- composer format:check
- npm audit --audit-level=moderate
- npm run build

The test environment is configured in phpunit.xml and .env.testing to use SQLite in-memory, array cache/session/mail, synchronous queues, and a low bcrypt work factor. No production secrets are needed.

## Static analysis

- Configuration: phpstan.neon.
- Analysis level: 5.
- Analyzed paths: app/.
- Larastan extension: vendor/larastan/larastan/extension.neon.
- Composer entry point: composer analyse.
- No baseline is configured. Findings are fixed rather than suppressed.

## Composer scripts

- composer test: runs php artisan test using the configured PHPUnit suite.
- composer analyse: runs PHPStan/Larastan with the committed configuration.
- composer format:check: runs vendor/bin/pint --test without modifying source files.

## Notes

- The PHPUnit feature suite includes homepage and Filament admin-login smoke tests and runs migrations through Laravel's RefreshDatabase trait.
- The existing PHP source is formatted with the repository's locked Pint version. CI only runs Pint in check-only mode.
