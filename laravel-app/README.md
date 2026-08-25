# Împreună Învățăm — Foundation Platform

Platformă Laravel 11 pentru fundația **Împreună Învățăm** (impreuna.invatam.org).
Combină un website public modern cu un panou CMS complet construit pe **Filament v3**.

**Stack:** Laravel 11 · PHP 8.2+ · MySQL 8 · Blade · Livewire 3 · Alpine.js · Tailwind 3 · Filament 3

---

## 🚀 Instalare rapidă

Cerințe: `PHP 8.2+`, `Composer 2`, `Node 20+`, `MySQL 8` (sau MariaDB 10.11+).

```bash
# 1. Clonează / descarcă proiectul
cd laravel-app

# 2. Instalează dependințele
composer install
yarn install     # sau npm install

# 3. Configurare mediu
cp .env.example .env
php artisan key:generate

# Editează .env și setează DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 4. Migrează + populează baza de date cu date demo (Romanian)
php artisan migrate --seed

# 5. Storage symlink (pentru upload-uri publice)
php artisan storage:link

# 6. Compilează asset-urile
yarn build       # sau npm run build
# ...sau, pentru dev:
yarn dev

# 7. Rulează serverul
php artisan serve
```

Deschide `http://localhost:8000` pentru site-ul public și `http://localhost:8000/admin` pentru panoul de administrare.

### Conturi seed (schimbă-le în producție!)
| Rol           | Email                              | Parolă              |
|---------------|------------------------------------|---------------------|
| Administrator | `admin@impreuna.invatam.org`       | `parolaSchimba123!` |
| Editor        | `editor@impreuna.invatam.org`      | `parolaSchimba123!` |

---

## 📁 Structura codului

```
app/
├── Filament/              # Panou admin (resources, widgets, pages)
│   ├── Resources/         # 18 resurse Filament pentru toate entitățile
│   └── Widgets/OverviewStats.php
├── Http/
│   ├── Controllers/       # PageController, ProjectController, DonationController, ...
│   └── Middleware/
├── Livewire/              # ContactForm, VolunteerForm, PartnershipForm, BeneficiaryRequestForm
├── Models/                # 22 modele Eloquent
├── Providers/
│   ├── AppServiceProvider.php
│   └── Filament/AdminPanelProvider.php
└── Services/PaymentService.php   # Layer abstract pentru plăți

database/
├── migrations/            # Toate schemele
└── seeders/DatabaseSeeder.php    # Date demo romanești

resources/
├── css/app.css            # Tailwind + design tokens
├── js/app.js              # Alpine.js
└── views/
    ├── components/        # header, footer, section-heading, project-card, etc.
    ├── layouts/           # componenta layout principală
    ├── livewire/          # view-uri Livewire pentru formulare
    └── pages/             # pagini publice (home, about, projects/, news/, ...)

routes/web.php             # Toate rutele publice
```

---

## 🎨 Design system

- **Brand color:** deep electric blue (`#1f4bff` la scale `brand-*` în `tailwind.config.js`)
- **Font:** Instrument Sans (Bunny Fonts CDN — GDPR-friendly)
- **Componente reutilizabile:** vezi `resources/views/components/`
- **Nu se folosesc emoji-uri ca iconițe** — toate icon-urile sunt SVG (Heroicons stroke) prin componenta `<x-heroicon />`

Culorile secundare (accent) pentru diferențierea categoriilor:
- `accent-yellow` — companii/parteneri profesioniști
- `accent-green` — comunități/beneficiari
- `accent-purple` — cei care au nevoie
- `accent-pink` — donatori/susținători

---

## 🔌 Modele și relații

**Ecosistem** (supply + demand):
`Organization`, `Partner`, `Person`, `EducatorProfile`, `VolunteerApplication`,
`Beneficiary`, `EducationalNeed`

**Programe:**
`Project` ⇔ `ProjectCategory`, `ProjectPartner`, `ProjectEducator`, `ProjectBeneficiary`,
`ImpactMetric`, `Testimonial`

**Conținut:** `Resource`, `Event`, `NewsArticle`, `AnnualReport`

**Submisii:** `Donation`, `PartnershipInquiry`, `BeneficiaryRequest`, `ContactMessage`

**Configurare:** `SiteSetting` (key-value cu tipuri, cached)

Toate relațiile many-to-many sunt implementate corect prin pivot tables cu date suplimentare (rol, contribuție, număr beneficiari etc.).

---

## 💳 Plăți (abstract)

`App\Services\PaymentService` este layer-ul abstract. În `.env` setează:

```env
PAYMENT_PROVIDER=null     # sau 'stripe' sau 'netopia'
```

- `null` — donațiile se salvează cu status `pending` și o referință manuală (util pentru testare & bonific bancar).
- `stripe`, `netopia` — sunt placeholder-i gata să fie completați cu integrarea reală (SDK-ul provider-ului).

Fluxul de donație (`DonationController::store`) e complet și rulează prin acest service, deci înlocuirea provider-ului nu necesită modificări în restul aplicației.

---

## 📝 Formulare

Toate formularele sunt **Livewire 3** cu validare Laravel + CSRF + persistență + stare success (fără JS custom):
- `/contact` → `ContactForm`
- `/voluntariat` → `VolunteerForm` (cu upload CV)
- `/pentru-companii` → `PartnershipForm`
- `/beneficiari` → `BeneficiaryRequestForm`

Formularul de donație (`/doneaza`) folosește un POST clasic pentru a merge prin `PaymentService`.

---

## 🔐 Admin Filament

Accesează `/admin`. Panoul include:
- **Dashboard** cu widget de statistici (proiecte active, voluntari pending, cereri sprijin, donații total)
- **18 resurse** cu formulare & tabele complete: Proiecte, Categorii, Organizații, Parteneri, Persoane, Beneficiari, Testimoniale, Metrici de impact, Voluntari, Cereri parteneriat, Cereri sprijin, Mesaje contact, Donații, Resurse, Evenimente, Noutăți, Rapoarte anuale, Utilizatori, Setări site
- **Badge-uri de notificare** în navigare (ex: nr. cereri noi de voluntariat)
- **Reorderable** pentru testimoniale, metrici, parteneri
- **File uploads** pentru logo-uri, imagini de proiect, CV-uri, PDF-uri rapoarte

---

## 🌐 SEO

- Meta title/description per pagină (prop-uri pe `<x-layouts.app>`)
- Open Graph + canonical URL automat
- `robots.txt` în `public/`
- Slug-uri curate (`Str::slug` auto pe create pentru proiecte, resurse, evenimente, articole)
- Ready pentru `spatie/laravel-sitemap` (dependință deja adăugată în composer.json)

---

## ⚡ Performanță

- **Cache:** database (schimbă în `.env` la `redis` în producție)
- **Sessions:** database
- **Queue:** database (rulează `php artisan queue:work` pentru joburi async)
- **Eager loading** aplicat în controllere (`with(...)`) pentru a evita N+1
- **Cache pentru SiteSetting** (invalidat automat la save)

---

## ♿ Accesibilitate

- Landmarks semantice (`<header>`, `<main>`, `<footer>`, `<article>`, `<nav>`)
- Focus states vizibile
- `aria-hidden` pe SVG-uri decorative
- `alt` pe imagini din baza de date
- Contrast WCAG AA pentru text principal pe fundal alb și brand-700 pe alb

---

## 🚢 Deployment

### Recomandat: Laravel Forge / VPS
1. Push pe GitHub.
2. Configurează serverul (LEMP: Nginx + PHP 8.2-FPM + MySQL).
3. Rulează `composer install --no-dev --optimize-autoloader`.
4. Rulează `yarn build`.
5. Migrează: `php artisan migrate --force`.
6. Cache: `php artisan config:cache route:cache view:cache filament:cache-components`.

### Note importante
- **Nu commite `.env`**. Include-l în `.env.example`.
- Pentru upload-uri publice, rulează `php artisan storage:link` pe server.
- Setează `APP_DEBUG=false` în producție.
- `APP_ENV=production` va forța HTTPS (vezi `AppServiceProvider::boot`).

---

## 🧪 Date demo

Rulează seeder-ul pentru a popula cu ~50 înregistrări realiste românești (10 organizații, 6 proiecte, 8 articole, 10 resurse, 5 evenimente, 5 metrici de impact, 3 testimoniale, 3 rapoarte anuale, categorii de proiecte, beneficiari, persoane). Toate sunt marcate ca demo în cod și pot fi editate/șterse din admin.

---

## 📜 Licență

Cod: MIT.
Conținut & branding Împreună Învățăm: © Fundația Împreună Învățăm.
