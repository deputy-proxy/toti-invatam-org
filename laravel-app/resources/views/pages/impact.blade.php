<x-layouts.app title="Impact — Împreună Învățăm">
    <section class="container-page py-16 md:py-24 max-w-4xl">
        <div class="section-kicker mb-4">Impactul nostru</div>
        <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-ink-900">Măsurăm ce contează. Comunicăm ce s-a schimbat.</h1>
    </section>

    <section class="container-page pb-16 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
        @foreach ($metrics as $m)
            <div class="card p-6 text-center">
                <x-icon-badge :icon="$m->icon ?: 'sparkles'" :color="$m->color ?: 'brand'" size="lg" class="mx-auto" />
                <div class="mt-4 text-3xl md:text-4xl font-semibold text-ink-900">{{ $m->numeric_value }}<span class="text-brand-600">{{ $m->suffix }}</span></div>
                <div class="mt-1 text-sm text-ink-500">{{ $m->title }}</div>
            </div>
        @endforeach
    </section>

    @if ($projects->count())
    <section class="bg-ink-50/60 py-20">
        <div class="container-page">
            <x-section-heading title="Proiecte cu impact" subtitle="Fiecare proiect deschide uși pentru cineva." />
            <div class="mt-14 grid md:grid-cols-3 gap-6">
                @foreach ($projects as $project)
                    <x-project-card :project="$project" />
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if ($testimonials->count())
    <section class="container-page py-20">
        <x-section-heading title="Povești din ecosistem" />
        <div class="mt-14 grid md:grid-cols-3 gap-6">
            @foreach ($testimonials as $t) <x-testimonial-card :testimonial="$t" /> @endforeach
        </div>
    </section>
    @endif
</x-layouts.app>
