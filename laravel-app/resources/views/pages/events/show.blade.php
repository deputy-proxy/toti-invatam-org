<x-layouts.app :title="$event->title.' — Împreună Învățăm'" :description="$event->description">
    <article class="container-page py-12 max-w-3xl">
        <a href="{{ route('events.index') }}" class="text-sm text-ink-500 hover:text-brand-700 inline-flex items-center gap-1 mb-8">
            <x-heroicon name="arrow-right" class="w-4 h-4 rotate-180" /> Toate evenimentele
        </a>
        <div class="chip">{{ $event->online ? 'Online' : 'Fizic' }}</div>
        <h1 class="mt-4 text-4xl md:text-5xl font-semibold tracking-tight text-ink-900">{{ $event->title }}</h1>
        <div class="mt-4 text-lg text-brand-700 font-semibold">{{ $event->start_at->translatedFormat('l, d M Y, H:i') }}</div>
        @if ($event->location)<div class="mt-2 text-ink-500 flex items-center gap-1"><x-heroicon name="map-pin" class="w-5 h-5" />{{ $event->location }}</div>@endif
        @if ($event->description)<div class="prose max-w-none mt-8">{!! nl2br(e($event->description)) !!}</div>@endif
        @if ($event->event_url)<a href="{{ $event->event_url }}" target="_blank" class="btn-primary mt-6">Înregistrează-te</a>@endif
    </article>
</x-layouts.app>
