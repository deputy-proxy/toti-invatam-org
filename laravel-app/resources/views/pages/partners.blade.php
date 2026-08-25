@php use App\Models\Organization; @endphp
<x-layouts.app title="Parteneri — Împreună Învățăm">
    <section class="container-page py-16 md:py-20">
        <div class="section-kicker mb-4">Parteneri</div>
        <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-ink-900">Ecosistemul care face lucrurile posibile.</h1>
    </section>

    <section class="container-page pb-24 space-y-14">
        @forelse ($partners as $type => $group)
            <div>
                <h2 class="text-2xl font-semibold text-ink-900 mb-6">{{ Organization::TYPES[$type] ?? $type }}</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($group as $partner)
                        <div class="card p-6 text-center">
                            @if ($partner->organization->logo)
                                <img src="{{ asset('storage/'.$partner->organization->logo) }}" alt="{{ $partner->organization->name }}" class="h-12 mx-auto object-contain">
                            @else
                                <div class="text-brand-700 font-semibold">{{ $partner->organization->name }}</div>
                            @endif
                            @if ($partner->organization->website)
                                <a href="{{ $partner->organization->website }}" target="_blank" rel="noopener" class="mt-3 text-xs text-ink-400 hover:text-brand-700 inline-block">Vizitează</a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="text-center py-20 text-ink-400">Nu au fost adăugați parteneri.</div>
        @endforelse

        <div class="card p-10 bg-brand-50 border-brand-100 text-center">
            <h3 class="text-2xl font-semibold text-ink-900">Vrei să fii următorul partener?</h3>
            <p class="mt-2 text-ink-500">Hai să construim împreună un program cu impact real.</p>
            <a href="{{ route('corporate') }}" class="btn-primary mt-6">Devino partener</a>
        </div>
    </section>
</x-layouts.app>
