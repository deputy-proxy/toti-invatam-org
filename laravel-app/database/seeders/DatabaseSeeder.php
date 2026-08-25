<?php

namespace Database\Seeders;

use App\Models\AnnualReport;
use App\Models\Beneficiary;
use App\Models\Event;
use App\Models\ImpactMetric;
use App\Models\NewsArticle;
use App\Models\Organization;
use App\Models\Partner;
use App\Models\Person;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Resource;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // -------- Admin users --------
        User::updateOrCreate(
            ['email' => 'admin@impreuna.invatam.org'],
            ['name' => 'Administrator', 'password' => Hash::make('parolaSchimba123!'), 'role' => 'admin', 'active' => true]
        );
        User::updateOrCreate(
            ['email' => 'editor@impreuna.invatam.org'],
            ['name' => 'Editor Fundație', 'password' => Hash::make('parolaSchimba123!'), 'role' => 'editor', 'active' => true]
        );

        // -------- Site settings --------
        $settings = [
            ['hero_headline', 'Conectăm cunoașterea cu cei care au nevoie de ea.', 'string', 'homepage'],
            ['hero_description', 'Împreună Învățăm este fundația care construiește punți între educatori, companii și profesioniști și cei care nu au acces la oportunități de învățare.', 'text', 'homepage'],
            ['hero_cta_primary', 'Descoperă cum funcționează', 'string', 'homepage'],
            ['hero_cta_secondary', 'Implică-te', 'string', 'homepage'],
            ['final_cta_headline', 'Împreună putem deschide uși spre viitor.', 'string', 'homepage'],
            ['final_cta_description', 'Alătură-te comunității care face educația accesibilă pentru toți.', 'text', 'homepage'],
            ['foundation_email', 'contact@impreuna.invatam.org', 'string', 'contact'],
            ['foundation_phone', '+40 712 345 678', 'string', 'contact'],
            ['foundation_address', 'București, România', 'string', 'contact'],
            ['social_facebook', 'https://facebook.com/', 'string', 'social'],
            ['social_instagram', 'https://instagram.com/', 'string', 'social'],
            ['social_linkedin', 'https://linkedin.com/', 'string', 'social'],
            ['social_youtube', 'https://youtube.com/', 'string', 'social'],
            ['seo_default_title', 'Împreună Învățăm — Conectăm cunoașterea cu cei care au nevoie', 'string', 'seo'],
            ['seo_default_description', 'Fundația care construiește punți între cei care pot oferi educație și cei care au nevoie de ea.', 'text', 'seo'],
        ];
        foreach ($settings as [$k, $v, $t, $g]) SiteSetting::set($k, $v, $t, $g);

        // -------- Impact metrics (homepage) --------
        $metrics = [
            ['Beneficiari conectați', '5.000', '+', 'Copii, tineri și adulți care au primit sprijin educațional prin programele noastre.', 'users', 'brand', 1],
            ['Educatori și voluntari implicați', '350', '+', 'Profesori, formatori și profesioniști care contribuie activ.', 'academic-cap', 'accent-yellow', 2],
            ['Companii și parteneri', '70', '+', 'Organizații care cred în misiunea noastră și ne susțin proiectele.', 'building-office', 'accent-green', 3],
            ['Proiecte și ateliere derulate', '200', '+', 'Programe educaționale duse la bun sfârșit în comunități diverse.', 'book-open', 'accent-purple', 4],
            ['Județe în care activăm', '25', '', 'Prezență națională în comunități urbane și rurale.', 'map-pin', 'accent-pink', 5],
        ];
        foreach ($metrics as [$t, $v, $s, $d, $i, $c, $o]) {
            ImpactMetric::updateOrCreate(
                ['title' => $t, 'project_id' => null],
                ['numeric_value' => $v, 'suffix' => $s, 'description' => $d, 'icon' => $i, 'color' => $c, 'display_order' => $o, 'active' => true]
            );
        }

        // -------- Project categories --------
        $categories = [
            ['Limbi străine', 'languages', 'globe-alt'],
            ['STEM', 'stem', 'beaker'],
            ['Alfabetizare digitală', 'digital-literacy', 'computer-desktop'],
            ['Carieră', 'career', 'briefcase'],
            ['Life skills', 'life-skills', 'sparkles'],
            ['Dezvoltarea profesorilor', 'teacher-development', 'academic-cap'],
            ['Antreprenoriat', 'entrepreneurship', 'chart-bar'],
            ['Arte', 'arts', 'paint-brush'],
        ];
        foreach ($categories as [$n, $s, $i]) {
            ProjectCategory::updateOrCreate(['slug' => $s], ['name' => $n, 'icon' => $i, 'active' => true]);
        }

        // -------- Partner organisations (demo) --------
        $orgs = [
            ['Edventure', 'company', 'https://edventure.ro'],
            ['Google România', 'company', 'https://google.com'],
            ['BRD Groupe Société Générale', 'company', 'https://brd.ro'],
            ['Microsoft România', 'company', 'https://microsoft.com'],
            ['BCR', 'company', 'https://bcr.ro'],
            ['Universitatea din București', 'university', 'https://unibuc.ro'],
            ['ASE București', 'university', 'https://ase.ro'],
            ['Școala Gimnazială nr. 12 Cluj', 'school', null],
            ['Asociația Teach for Romania', 'ngo', 'https://teachforromania.ro'],
            ['Ministerul Educației', 'public_institution', 'https://edu.ro'],
        ];
        foreach ($orgs as [$n, $t, $w]) {
            $org = Organization::updateOrCreate(
                ['name' => $n],
                ['slug' => Str::slug($n), 'type' => $t, 'website' => $w, 'country' => 'Romania', 'active' => true,
                 'description' => "Organizație demo. $n este un exemplu de partener; datele sunt fictive și editabile din admin."]
            );
            Partner::updateOrCreate(
                ['organization_id' => $org->id],
                ['partner_type' => 'strategic', 'active' => true, 'featured' => true, 'display_order' => $org->id]
            );
        }

        // -------- People (educators) --------
        $people = [
            ['Maria', 'Popescu', 'Director Școală Gimnazială'],
            ['Andrei', 'Ionescu', 'Software Engineer'],
            ['Elena', 'Constantinescu', 'Studentă'],
            ['Ioana', 'Radu', 'Profesor limba engleză'],
            ['Mihai', 'Georgescu', 'Formator STEM'],
        ];
        foreach ($people as [$f, $l, $p]) {
            Person::updateOrCreate(['email' => Str::slug("$f.$l").'@example.org'],
                ['first_name' => $f, 'last_name' => $l, 'profession' => $p, 'city' => 'București', 'county' => 'București', 'active' => true]);
        }

        // -------- Testimonials --------
        $testimonials = [
            ['Maria Popescu', 'Director Școală Gimnazială', null, 'beneficiar',
             'Prin Împreună Învățăm, am găsit voluntari minunați care ajută pe elevii noștri să viseze mai măreț.'],
            ['Andrei Ionescu', 'Voluntar & Software Engineer', null, 'voluntar',
             'Ca profesionist, am descoperit bucuria de a da mai departe cunoștințele mele și de a inspira viitorul.'],
            ['Elena, 16 ani', 'Beneficiar', null, 'beneficiar',
             'Datorită programelor, acum pot să învăț engleză și să îmi construiesc un viitor mai bun.'],
        ];
        foreach ($testimonials as $idx => [$n, $r, $o, $c, $q]) {
            Testimonial::updateOrCreate(['name' => $n, 'quote' => $q],
                ['role' => $r, 'organisation' => $o, 'category' => $c, 'featured' => true, 'active' => true, 'display_order' => $idx + 1]);
        }

        // -------- Projects --------
        $projects = [
            ['Engleză pentru mediul rural', 'stem-english-rural', 'Un program prin care voluntari din companii tech oferă lecții de engleză elevilor din comunități rurale.', 'active', 'languages', 'Cluj', 'Cluj'],
            ['Ateliere STEM în școli defavorizate', 'ateliere-stem', 'Ateliere interactive de știință și tehnologie susținute în școli cu resurse limitate.', 'active', 'stem', 'Iași', 'Iași'],
            ['Digital pentru profesori', 'digital-profesori', 'Program de formare a profesorilor în competențe digitale și pedagogii moderne.', 'active', 'teacher-development', 'Național', null],
            ['Carieră și orientare pentru liceeni', 'cariera-liceeni', 'Sesiuni de mentorat unu-la-unu între profesioniști și elevi de liceu.', 'active', 'career', 'București', 'București'],
            ['Life skills în orfelinat', 'life-skills-orfelinat', 'Program de dezvoltare a abilităților de viață pentru tineri din centrele de plasament.', 'completed', 'life-skills', 'Brașov', 'Brașov'],
            ['Antreprenoriat pentru tineri', 'antreprenoriat-tineri', 'Curs de antreprenoriat aplicat pentru elevii de clasa a XI-a și a XII-a.', 'upcoming', 'entrepreneurship', 'Timișoara', 'Timiș'],
        ];
        foreach ($projects as $idx => [$t, $s, $d, $st, $catSlug, $loc, $co]) {
            $cat = ProjectCategory::where('slug', $catSlug)->first();
            Project::updateOrCreate(['slug' => $s], [
                'project_category_id' => $cat?->id,
                'title' => $t, 'short_description' => $d, 'description' => $d.' Descriere detaliată editabilă din admin.',
                'problem' => 'Multe comunități nu au acces la aceste oportunități.',
                'solution' => 'Aducem laolaltă voluntari, resurse și infrastructură.',
                'objectives' => 'Îmbunătățirea accesului la educație de calitate.',
                'impact' => 'Sute de beneficiari sprijiniți.',
                'status' => $st, 'location' => $loc, 'county' => $co,
                'featured' => $idx < 3, 'published_at' => now()->subDays($idx * 15),
                'start_date' => now()->subMonths(6)->toDateString(),
                'end_date' => now()->addMonths(6)->toDateString(),
            ]);
        }

        // -------- News articles --------
        $news = [
            'Lansăm programul de mentorat pentru liceeni în București',
            'Peste 500 de elevi au participat la atelierele STEM',
            'Parteneriat nou cu Universitatea din București',
            'Raport anual 2024 disponibil pentru descărcare',
            'Comunitatea de voluntari a depășit 350 de membri activi',
            'Cum funcționează procesul de matching între educatori și nevoi',
            'Ateliere digitale pentru profesorii din mediul rural',
            'Ediția a doua a programului „Engleză pentru comunitate"',
        ];
        foreach ($news as $idx => $title) {
            NewsArticle::updateOrCreate(['title' => $title], [
                'excerpt' => Str::limit("Un articol despre $title și impactul asupra comunității.", 180),
                'content' => "Text complet demonstrativ pentru articolul: {$title}. Editabil din admin.\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit.",
                'author' => 'Echipa Împreună Învățăm',
                'category' => $idx % 2 === 0 ? 'Comunitate' : 'Programe',
                'published_at' => now()->subDays($idx * 5),
                'featured' => $idx < 3,
                'active' => true,
            ]);
        }

        // -------- Resources --------
        $types = ['guide','worksheet','video','article','presentation'];
        for ($i = 1; $i <= 10; $i++) {
            Resource::updateOrCreate(['title' => "Resursă educațională demo #$i"], [
                'description' => "Descriere pentru resursa #$i — material demonstrativ pentru profesori și facilitatori.",
                'content' => "Conținut detaliat al resursei #$i.",
                'resource_type' => $types[array_rand($types)],
                'audience' => $i % 2 === 0 ? 'educatori' : 'ong',
                'category' => 'Educație',
                'author' => 'Împreună Învățăm',
                'published_at' => now()->subDays($i * 3),
                'active' => true,
            ]);
        }

        // -------- Events --------
        for ($i = 1; $i <= 5; $i++) {
            Event::updateOrCreate(['title' => "Eveniment #$i — Împreună Învățăm"], [
                'description' => "Descriere pentru evenimentul demo #$i.",
                'location' => $i % 2 === 0 ? 'București' : 'Online',
                'online' => $i % 2 === 1,
                'start_at' => now()->addDays($i * 10),
                'end_at' => now()->addDays($i * 10)->addHours(3),
                'capacity' => 100,
                'registration_required' => true,
                'active' => true,
            ]);
        }

        // -------- Beneficiaries (demo) --------
        $beneficiaryData = [
            ['school', 'Școala Gimnazială Rurală Sânnicoara', 'Cluj'],
            ['ngo', 'Asociația pentru Copii', 'București'],
            ['community', 'Comunitate rurală Botoșani', 'Botoșani'],
            ['school', 'Liceul Tehnologic Târgu Mureș', 'Mureș'],
        ];
        foreach ($beneficiaryData as [$t, $n, $co]) {
            Beneficiary::updateOrCreate(['name' => $n], [
                'type' => $t, 'city' => $co, 'county' => $co, 'active' => true,
                'needs' => 'Necesități educaționale diverse identificate în comunitate.',
                'description' => 'Beneficiar demo — datele sunt fictive și editabile din admin.',
            ]);
        }

        // -------- Annual reports --------
        foreach ([2022, 2023, 2024] as $y) {
            AnnualReport::updateOrCreate(['year' => $y], [
                'title' => "Raport anual $y",
                'description' => "Sumar al activității Fundației Împreună Învățăm în anul $y.",
                'published_at' => now()->setYear($y)->setMonth(3)->setDay(1),
                'active' => true,
            ]);
        }
    }
}
