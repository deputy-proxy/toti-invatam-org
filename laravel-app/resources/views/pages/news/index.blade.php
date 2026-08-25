<x-layouts.app title="Noutăți — Împreună Învățăm">
    <section class="container-page py-16 md:py-20">
        <div class="section-kicker mb-4">Noutăți</div>
        <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-ink-900">Ce se întâmplă în fundație.</h1>
    </section>
    <section class="container-page pb-24">
        @if ($articles->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($articles as $a) <x-news-card :article="$a" /> @endforeach
            </div>
            <div class="mt-10">{{ $articles->links() }}</div>
        @else
            <div class="text-center py-20 text-ink-400">Nu există articole publicate.</div>
        @endif
    </section>
</x-layouts.app>
