# Repository-specific development configuration

Last verified: 2026-11-18. This repository did not contain `.chatgpt/osingle.md` or a `.github/workflows/` directory at the time of inspection. Re-check both before relying on this snapshot.

## Runtime and framework
- PHP requirement: `^8.2`.
- Laravel: 11.x.
- Filament: 3.x.
- Livewire: 3.x.
- PHPUnit: 11.x.
- Laravel Pint: 1.x.
- Frontend: Vite 5, Tailwind CSS 3, Alpine.js.
- Node.js version and package-manager version are not specified by the inspected repository files. Inspect the available runtime and lockfiles before installing dependencies.
- No `.github/workflows/tests.yml` or `.github/workflows/` directory was found during this inspection.

## Current validation status
- `composer.json` does not define project-level `test`, `lint`, or static-analysis Composer scripts.
- `package.json` defines `npm run build` and `npm run dev`.
- No repository CI test/build workflow was found at the inspected path. Do not claim automated tests, static analysis, migrations, frontend tests, or security audits are enforced by GitHub Actions until a workflow is added and verified.
- Inspect the current repository for test files and lockfiles before choosing local commands.

## Recommended local checks pending CI standardization
- Install PHP dependencies using the committed Composer lockfile, if present.
- Run the existing PHPUnit suite using the installed PHPUnit binary if tests are present.
- Run `npm ci` only if a committed `package-lock.json` exists; otherwise use the package manager indicated by the repository's actual lockfile.
- Run `npm run build`.
- Run Pint if it is installed and configured.
- Do not invent missing scripts or claim checks are CI gates.

## Upgrade and standardization notes
- This repository is on an older framework generation than the Laravel 13 / Filament 5 / Livewire 4 baseline used by the newer repositories.
- Treat framework upgrades as explicit, separately scoped work. Do not upgrade major framework versions as incidental cleanup.
- Add a CI workflow and explicit quality gates as a separate engineering task after inspecting the full repository and its deployment constraints.
