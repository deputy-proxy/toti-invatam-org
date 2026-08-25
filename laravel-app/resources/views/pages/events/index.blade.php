<x-layouts.app title="Evenimente — Împreună Învățăm">
    <section class="container-page py-16 md:py-20">
        <div class="section-kicker mb-4">Evenimente</div>
        <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-ink-900">Momente în care ne întâlnim.</h1>
    </section>
    <section class="container-page pb-24">
        @if ($upcoming->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($upcoming as $event)
                    <a href="{{ route('events.show', $event) }}" class="card p-6 card-hover block">
                        <div class="chip mb-3">{{ $event->online ? 'Online' : 'Fizic' }}</div>
                        <div class="text-brand-700 font-semibold">{{ $event->start_at->translatedFormat('d M Y, H:i') }}</div>
                        <h3 class="mt-2 text-lg font-semibold text-ink-900">{{ $event->title }}</h3>
                        <p class="text-sm text-ink-500 mt-2 line-clamp-3">{{ $event->description }}</p>
                        <div class="mt-4 text-xs text-ink-400 flex items-center gap-1"><x-heroicon name="map-pin" class="w-4 h-4" />{{ $event->location }}</div>
                    </a>
                @endforeach
            </div>
            <div class="mt-10">{{ $upcoming->links() }}</div>
        @else
            <div class="text-center py-20 text-ink-400">Nu există evenimente programate.</div>
        @endif
    </section>
</x-layouts.app>
