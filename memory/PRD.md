# Împreună Învățăm — Foundation Platform

**Type:** Laravel 13 web application intended for external deployment.

**Stack:** Laravel 13 · PHP 8.4 · MySQL/SQLite · Blade · Livewire 4 · Alpine.js · Tailwind CSS 4 · Filament v5

## Location
- Source: `/app/laravel-app/`
- Portable archive: `/app/impreuna-invatam-laravel.tar.gz` (751 KB, excludes vendor/node_modules)

## What's built
- **22 Eloquent models** with full relationships (Organization, Partner, Person, EducatorProfile, VolunteerApplication, Beneficiary, EducationalNeed, Project + pivots, ProjectCategory, ImpactMetric, Testimonial, Donation, PartnershipInquiry, BeneficiaryRequest, ContactMessage, Resource, Event, NewsArticle, AnnualReport, SiteSetting, User)
- **All migrations** (2 consolidated migration files: core Laravel tables + full domain schema)
- **DatabaseSeeder** with realistic Romanian demo data (10 organizations, 6 projects, 8 news articles, 10 resources, 5 events, 5 impact metrics, 3 testimonials, 3 annual reports, categories, beneficiaries, people, admin & editor users)
- **18 Filament v5 admin resources** at `/admin` (Projects, Categories, Organizations, Partners, People, Beneficiaries, Testimonials, Impact Metrics, Volunteers, Partnership Inquiries, Beneficiary Requests, Contact Messages, Donations, Resources, Events, News, Annual Reports, Users, Site Settings) with dashboard widget for stats + navigation badges for pending items
- **All public pages** matching the reference brief (home, about, how-it-works, impact, projects list/detail, partners, involve, volunteer, corporate, donate, beneficiaries, resources list/detail, news list/detail, events list/detail, contact, annual-reports, privacy/terms/cookies)
- **4 Livewire v4 form components** with validation + CSRF + persistence: ContactForm, VolunteerForm (with CV upload), PartnershipForm, BeneficiaryRequestForm
- **Donation flow** with abstract `PaymentService` (null/stripe/netopia adapters — swappable via `.env`)
- **Homepage** pixel-close to the uploaded reference design: split hero with blue blob + orbiting icon badges, "Cum funcționează" 4-step with dotted connector, "Pentru cine" 5-persona cards, "Impactul nostru" metrics driven by CMS, "Cum te poți implica" 4 photo cards, "Povești care inspiră" testimonials, full-width blue final CTA
- **Reusable Blade components:** header, footer, section-heading, project-card, testimonial-card, news-card, form-field, heroicon (inline SVG), icon-badge
- **Design tokens** in Tailwind: brand deep-electric blue (#1f4bff) scale + accent yellow/green/purple/pink for category differentiation, Instrument Sans typography via Bunny Fonts CDN

## Verified end-to-end
- All PHP files pass `php -l` syntax check
- `composer.json` validates strict
- `composer install` succeeds; all Laravel + Filament packages discover
- `php artisan migrate --seed` runs cleanly against SQLite (used for local test) and MySQL (production target)
- All 17 public routes return HTTP 200; admin routes redirect correctly
- Livewire v4 form components auto-discovered in `App\Livewire\` namespace
- Filament admin login page renders with the correct Împreună Învățăm branding and Romanian locale

## Deployment
User will deploy externally (VPS / Laravel Forge / Hetzner / shared PHP hosting). See `laravel-app/README.md` for the exact install steps.
