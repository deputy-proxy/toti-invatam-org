<x-layouts.app :title="$article->title.' — Împreună Învățăm'" :description="$article->excerpt">
    <article class="container-page py-12 max-w-3xl">
        <a href="{{ route('news.index') }}" class="text-sm text-ink-500 hover:text-brand-700 inline-flex items-center gap-1 mb-8">
            <x-heroicon name="arrow-right" class="w-4 h-4 rotate-180" /> Toate noutățile
        </a>
        <div class="text-xs text-ink-400 mb-3 flex gap-3">
            @if ($article->category)<span class="chip">{{ $article->category }}</span>@endif
            <span>{{ $article->published_at?->translatedFormat('d M Y') }}</span>
        </div>
        <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-ink-900">{{ $article->title }}</h1>
        @if ($article->featured_image)
            <img src="{{ asset('storage/'.$article->featured_image) }}" alt="{{ $article->title }}" class="mt-8 rounded-3xl w-full">
        @endif
        <div class="prose max-w-none mt-8">
            {!! nl2br(e($article->content)) !!}
        </div>
    </article>

    @if ($related->count())
    <section class="bg-ink-50/60 py-16 mt-16">
        <div class="container-page">
            <x-section-heading title="Mai multe articole" align="left" />
            <div class="mt-8 grid md:grid-cols-3 gap-6">
                @foreach ($related as $r) <x-news-card :article="$r" /> @endforeach
            </div>
        </div>
    </section>
    @endif
</x-layouts.app>
