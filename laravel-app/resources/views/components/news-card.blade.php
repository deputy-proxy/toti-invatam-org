@props(['article'])
<a href="{{ route('news.show', $article) }}" class="card card-hover block overflow-hidden group">
    <div class="aspect-[16/10] bg-ink-100 overflow-hidden">
        @if ($article->featured_image)
            <img src="{{ asset('storage/'.$article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        @else
            <div class="w-full h-full bg-gradient-to-br from-brand-100 to-brand-50 grid place-content-center text-brand-700">
                <x-heroicon name="chat-bubble" class="w-12 h-12" />
            </div>
        @endif
    </div>
    <div class="p-6">
        <div class="flex items-center gap-3 text-xs text-ink-500 mb-3">
            @if ($article->category)<span class="chip">{{ $article->category }}</span>@endif
            <span>{{ $article->published_at?->translatedFormat('d M Y') }}</span>
        </div>
        <h3 class="text-lg font-semibold text-ink-900 leading-snug">{{ $article->title }}</h3>
        @if ($article->excerpt)<p class="mt-2 text-sm text-ink-500 line-clamp-3">{{ $article->excerpt }}</p>@endif
    </div>
</a>
