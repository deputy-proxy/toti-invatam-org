<x-layouts.app title="Rapoarte anuale — Împreună Învățăm">
    <section class="container-page py-16 md:py-20 max-w-3xl">
        <div class="section-kicker mb-4">Transparență</div>
        <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-ink-900">Rapoarte anuale.</h1>
        <p class="mt-4 text-lg text-ink-500">Descarcă rapoartele noastre pentru a vedea impactul măsurabil an de an.</p>
    </section>

    <section class="container-page pb-24">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($reports as $report)
                <div class="card p-6">
                    <div class="text-4xl font-semibold text-brand-600">{{ $report->year }}</div>
                    <h3 class="mt-3 font-semibold text-ink-900">{{ $report->title }}</h3>
                    @if ($report->description)<p class="text-sm text-ink-500 mt-2">{{ $report->description }}</p>@endif
                    @if ($report->file_path)
                        <a href="{{ asset('storage/'.$report->file_path) }}" class="btn-secondary mt-4">Descarcă PDF</a>
                    @endif
                </div>
            @empty
                <div class="col-span-full text-center py-20 text-ink-400">Nu au fost publicate rapoarte încă.</div>
            @endforelse
        </div>
    </section>
</x-layouts.app>
