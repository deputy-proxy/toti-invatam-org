<x-layouts.app :title="$resource->title.' — Împreună Învățăm'" :description="$resource->description">
    <article class="container-page py-12 max-w-3xl">
        <a href="{{ route('resources.index') }}" class="text-sm text-ink-500 hover:text-brand-700 inline-flex items-center gap-1 mb-8">
            <x-heroicon name="arrow-right" class="w-4 h-4 rotate-180" /> Toate resursele
        </a>
        <span class="chip">{{ $resource->resource_type }}</span>
        <h1 class="mt-4 text-4xl md:text-5xl font-semibold tracking-tight text-ink-900">{{ $resource->title }}</h1>
        @if ($resource->description)<p class="mt-4 text-lg text-ink-500">{{ $resource->description }}</p>@endif

        <div class="mt-6 flex gap-3">
            @if ($resource->file_path)<a href="{{ asset('storage/'.$resource->file_path) }}" class="btn-primary">Descarcă</a>@endif
            @if ($resource->external_url)<a href="{{ $resource->external_url }}" target="_blank" rel="noopener" class="btn-secondary">Deschide sursa externă</a>@endif
        </div>

        @if ($resource->content)
            <div class="prose max-w-none mt-10">{!! nl2br(e($resource->content)) !!}</div>
        @endif
    </article>
</x-layouts.app>
