<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('type')->default('other'); // company, school, university, ngo, public_institution, educational_organization, other
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('county')->nullable();
            $table->string('country')->default('Romania');
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->index(['type', 'active']);
        });

        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->string('partner_type')->default('general'); // strategic, sponsor, implementation, media, etc.
            $table->text('partnership_description')->nullable();
            $table->string('contribution_type')->nullable();
            $table->date('start_date')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('featured')->default(false);
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();
            $table->index(['active', 'featured']);
        });

        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('bio')->nullable();
            $table->string('profession')->nullable();
            $table->foreignId('organization_id')->nullable()->constrained()->nullOnDelete();
            $table->string('city')->nullable();
            $table->string('county')->nullable();
            $table->string('profile_photo')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('educator_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained()->cascadeOnDelete();
            $table->string('educator_type')->default('teacher'); // teacher, trainer, mentor, coach, professional
            $table->json('subjects')->nullable();
            $table->json('skills')->nullable();
            $table->text('experience')->nullable();
            $table->string('availability')->nullable();
            $table->json('preferred_age_groups')->nullable();
            $table->json('preferred_locations')->nullable();
            $table->boolean('online_available')->default(false);
            $table->timestamps();
        });

        Schema::create('volunteer_applications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('profession')->nullable();
            $table->text('skills')->nullable();
            $table->text('motivation');
            $table->string('availability')->nullable();
            $table->json('preferred_activities')->nullable();
            $table->string('cv_path')->nullable();
            $table->string('status')->default('pending'); // pending, reviewing, approved, rejected, active, inactive
            $table->text('admin_notes')->nullable();
            $table->timestamps();
            $table->index('status');
        });

        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('individual'); // individual, school, ngo, community, institution, other
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('county')->nullable();
            $table->string('address')->nullable();
            $table->text('needs')->nullable();
            $table->text('accessibility_barriers')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->index(['type', 'active']);
        });

        Schema::create('educational_needs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->foreignId('beneficiary_id')->nullable()->constrained()->nullOnDelete();
            $table->string('subject')->nullable();
            $table->string('target_age')->nullable();
            $table->string('location')->nullable();
            $table->string('urgency')->default('normal'); // low, normal, high, critical
            $table->unsignedInteger('estimated_beneficiaries')->default(0);
            $table->text('required_skills')->nullable();
            $table->text('required_resources')->nullable();
            $table->string('status')->default('submitted'); // submitted, validated, matching, active, fulfilled, archived
            $table->timestamps();
            $table->index(['status', 'urgency']);
        });

        Schema::create('project_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('color')->default('brand');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('short_description', 500)->nullable();
            $table->longText('description')->nullable();
            $table->longText('problem')->nullable();
            $table->longText('solution')->nullable();
            $table->longText('objectives')->nullable();
            $table->longText('impact')->nullable();
            $table->string('featured_image')->nullable();
            $table->json('gallery')->nullable();
            $table->string('status')->default('draft'); // draft, upcoming, active, completed, archived
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('location')->nullable();
            $table->string('county')->nullable();
            $table->boolean('featured')->default(false);
            $table->timestamp('published_at')->nullable();
            // SEO
            $table->string('seo_title')->nullable();
            $table->string('seo_description', 500)->nullable();
            $table->timestamps();
            $table->index(['status', 'featured', 'published_at']);
        });

        Schema::create('project_partners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->string('role')->nullable();
            $table->text('contribution')->nullable();
            $table->boolean('featured')->default(false);
            $table->timestamps();
            $table->unique(['project_id', 'organization_id']);
        });

        Schema::create('project_educators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('person_id')->constrained()->cascadeOnDelete();
            $table->string('role')->nullable();
            $table->unsignedInteger('hours')->default(0);
            $table->text('contribution')->nullable();
            $table->timestamps();
            $table->unique(['project_id', 'person_id']);
        });

        Schema::create('project_beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('beneficiary_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('number_of_beneficiaries')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->unique(['project_id', 'beneficiary_id']);
        });

        Schema::create('impact_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('numeric_value'); // stored as string to allow formatted values like "5.000"
            $table->string('suffix', 20)->nullable(); // e.g. "+", "%"
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('color')->default('brand');
            $table->unsignedInteger('display_order')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->index(['active', 'display_order']);
        });

        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->nullable();
            $table->string('organisation')->nullable();
            $table->string('category')->nullable(); // beneficiar, profesor, voluntar, partener
            $table->text('quote');
            $table->string('photo')->nullable();
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('featured')->default(true);
            $table->boolean('active')->default(true);
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();
        });

        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('donor_name');
            $table->string('donor_email');
            $table->decimal('amount', 12, 2);
            $table->string('currency', 3)->default('RON');
            $table->string('type')->default('individual'); // individual, company
            $table->boolean('recurring')->default(false);
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->string('payment_provider')->nullable();
            $table->string('payment_reference')->nullable();
            $table->string('status')->default('pending'); // pending, completed, failed, refunded
            $table->json('metadata')->nullable();
            $table->timestamp('donated_at')->nullable();
            $table->timestamps();
            $table->index(['status', 'donated_at']);
        });

        Schema::create('partnership_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('organisation_name');
            $table->string('contact_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('organisation_type')->nullable();
            $table->string('partnership_type')->nullable();
            $table->text('message');
            $table->string('budget')->nullable();
            $table->string('status')->default('new'); // new, contacted, negotiating, accepted, rejected, completed
            $table->text('admin_notes')->nullable();
            $table->timestamps();
            $table->index('status');
        });

        Schema::create('beneficiary_requests', function (Blueprint $table) {
            $table->id();
            $table->string('requester_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('beneficiary_type')->default('school');
            $table->text('educational_need');
            $table->string('target_audience')->nullable();
            $table->string('location')->nullable();
            $table->unsignedInteger('estimated_beneficiaries')->default(0);
            $table->text('requested_support')->nullable();
            $table->string('urgency')->default('normal');
            $table->string('status')->default('new');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
            $table->index('status');
        });

        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('subject')->nullable();
            $table->text('message');
            $table->string('status')->default('new'); // new, read, replied
            $table->timestamps();
            $table->index('status');
        });

        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('resource_type')->default('article'); // article, guide, worksheet, video, presentation, external_resource, other
            $table->string('audience')->nullable(); // educatori, elevi, parinti, ong, companii
            $table->string('category')->nullable();
            $table->string('file_path')->nullable();
            $table->string('external_url')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('author')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->index(['active', 'resource_type']);
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('location')->nullable();
            $table->boolean('online')->default(false);
            $table->string('event_url')->nullable();
            $table->timestamp('start_at');
            $table->timestamp('end_at')->nullable();
            $table->unsignedInteger('capacity')->nullable();
            $table->boolean('registration_required')->default(false);
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->index(['active', 'start_at']);
        });

        Schema::create('news_articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->string('author')->nullable();
            $table->string('category')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->index(['active', 'published_at']);
        });

        Schema::create('annual_reports', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedInteger('year')->unique();
            $table->text('description')->nullable();
            $table->string('file_path')->nullable();
            $table->string('cover_image')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->longText('value')->nullable();
            $table->string('type')->default('string'); // string, text, json, boolean, number
            $table->string('group')->default('general');
            $table->string('label')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        foreach ([
            'site_settings', 'annual_reports', 'news_articles', 'events', 'resources',
            'contact_messages', 'beneficiary_requests', 'partnership_inquiries', 'donations',
            'testimonials', 'impact_metrics',
            'project_beneficiaries', 'project_educators', 'project_partners', 'projects', 'project_categories',
            'educational_needs', 'beneficiaries', 'volunteer_applications',
            'educator_profiles', 'people', 'partners', 'organizations',
        ] as $t) {
            Schema::dropIfExists($t);
        }
    }
};
