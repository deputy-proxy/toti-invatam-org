@props(['project'])
<a href="{{ route('projects.show', $project) }}" class="card card-hover block overflow-hidden group">
    <div class="aspect-[16/10] bg-ink-100 overflow-hidden">
        @if ($project->featured_image)
            <img src="{{ asset('storage/'.$project->featured_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        @else
            <div class="w-full h-full bg-gradient-to-br from-brand-100 to-brand-50 grid place-content-center text-brand-700">
                <x-heroicon name="academic-cap" class="w-12 h-12" />
            </div>
        @endif
    </div>
    <div class="p-6">
        @if ($project->category)
            <span class="chip mb-3">{{ $project->category->name }}</span>
        @endif
        <h3 class="text-lg font-semibold text-ink-900 leading-snug">{{ $project->title }}</h3>
        <p class="mt-2 text-sm text-ink-500 line-clamp-3">{{ $project->short_description }}</p>
        <div class="mt-4 flex items-center justify-between text-xs text-ink-500">
            <span class="flex items-center gap-1"><x-heroicon name="map-pin" class="w-4 h-4" />{{ $project->location ?: 'România' }}</span>
            <span class="text-brand-700 font-medium inline-flex items-center gap-1">
                Vezi proiectul <x-heroicon name="arrow-right" class="w-4 h-4" />
            </span>
        </div>
    </div>
</a>
