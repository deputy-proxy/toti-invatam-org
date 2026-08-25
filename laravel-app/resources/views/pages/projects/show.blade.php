<x-layouts.app :title="$project->title.' — Împreună Învățăm'" :description="$project->short_description">
    <section class="container-page pt-12 pb-6">
        <a href="{{ route('projects.index') }}" class="text-sm text-ink-500 hover:text-brand-700 inline-flex items-center gap-1">
            <x-heroicon name="arrow-right" class="w-4 h-4 rotate-180" /> Toate proiectele
        </a>
    </section>

    <section class="container-page grid lg:grid-cols-[1fr_320px] gap-14 pb-24 items-start">
        <div>
            @if ($project->featured_image)
                <div class="aspect-[16/9] rounded-3xl overflow-hidden bg-ink-100 mb-8">
                    <img src="{{ asset('storage/'.$project->featured_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                </div>
            @endif

            @if ($project->category)<span class="chip mb-4">{{ $project->category->name }}</span>@endif
            <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-ink-900">{{ $project->title }}</h1>
            <p class="mt-4 text-lg text-ink-500 leading-relaxed">{{ $project->short_description }}</p>

            <div class="prose max-w-none mt-10">
                @if ($project->description)<p>{!! nl2br(e($project->description)) !!}</p>@endif

                @foreach (['problem' => 'Problema', 'solution' => 'Soluția', 'objectives' => 'Obiective', 'impact' => 'Impact'] as $field => $label)
                    @if ($project->{$field})
                        <h2 class="text-2xl font-semibold text-ink-900 mt-10">{{ $label }}</h2>
                        <p>{!! nl2br(e($project->{$field})) !!}</p>
                    @endif
                @endforeach
            </div>
        </div>

        <aside class="lg:sticky lg:top-24 space-y-4">
            <div class="card p-6 text-sm">
                <div class="section-kicker mb-3">Detalii</div>
                <dl class="space-y-3">
                    <div><dt class="text-ink-400">Stare</dt><dd class="font-medium text-ink-900">{{ \App\Models\Project::STATUSES[$project->status] ?? $project->status }}</dd></div>
                    @if ($project->location)<div><dt class="text-ink-400">Locație</dt><dd class="font-medium text-ink-900">{{ $project->location }}</dd></div>@endif
                    @if ($project->start_date)<div><dt class="text-ink-400">Perioadă</dt><dd class="font-medium text-ink-900">{{ $project->start_date->format('M Y') }}{{ $project->end_date ? ' – '.$project->end_date->format('M Y') : '' }}</dd></div>@endif
                </dl>
            </div>

            @if ($project->partners->count())
                <div class="card p-6 text-sm">
                    <div class="section-kicker mb-3">Parteneri</div>
                    <ul class="space-y-2">
                        @foreach ($project->partners as $partner)
                            <li class="text-ink-800">{{ $partner->name }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <a href="{{ route('donate', ['project' => $project->id]) }}" class="btn-primary w-full">Susține acest proiect</a>
        </aside>
    </section>

    @if ($related->count())
    <section class="bg-ink-50/60 py-16">
        <div class="container-page">
            <x-section-heading title="Proiecte similare" align="left" />
            <div class="mt-8 grid md:grid-cols-3 gap-6">
                @foreach ($related as $r) <x-project-card :project="$r" /> @endforeach
            </div>
        </div>
    </section>
    @endif
</x-layouts.app>
