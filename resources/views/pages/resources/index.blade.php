<x-layouts.app title="Resurse — Împreună Învățăm">
    <section class="container-page py-16 md:py-20">
        <div class="section-kicker mb-4">Resurse</div>
        <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-ink-900">Bibliotecă educațională deschisă.</h1>

        <form method="GET" class="mt-10 flex flex-wrap gap-3">
            <select name="type" class="form-select max-w-[220px]" onchange="this.form.submit()">
                <option value="">Toate tipurile</option>
                @foreach (['article'=>'Articol','guide'=>'Ghid','worksheet'=>'Fișă','video'=>'Video','presentation'=>'Prezentare'] as $k => $l)
                    <option value="{{ $k }}" @selected(request('type') === $k)>{{ $l }}</option>
                @endforeach
            </select>
            <select name="audience" class="form-select max-w-[220px]" onchange="this.form.submit()">
                <option value="">Toate audiențele</option>
                @foreach (['educatori'=>'Educatori','elevi'=>'Elevi','parinti'=>'Părinți','ong'=>'ONG-uri','companii'=>'Companii'] as $k => $l)
                    <option value="{{ $k }}" @selected(request('audience') === $k)>{{ $l }}</option>
                @endforeach
            </select>
        </form>
    </section>
    <section class="container-page pb-24">
        @if ($resources->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($resources as $r)
                    <a href="{{ route('resources.show', $r) }}" class="card p-6 card-hover block">
                        <span class="chip mb-3">{{ $r->resource_type }}</span>
                        <h3 class="font-semibold text-ink-900">{{ $r->title }}</h3>
                        <p class="text-sm text-ink-500 mt-2 line-clamp-3">{{ $r->description }}</p>
                        <div class="mt-4 text-xs text-ink-400 flex justify-between">
                            <span>{{ $r->audience }}</span><span>{{ $r->published_at?->format('d.m.Y') }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-10">{{ $resources->links() }}</div>
        @else
            <div class="text-center py-20 text-ink-400">Nu există resurse care să corespundă filtrelor.</div>
        @endif
    </section>
</x-layouts.app>
