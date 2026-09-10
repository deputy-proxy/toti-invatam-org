<x-layouts.app title="Proiecte — Împreună Învățăm">
    <section class="container-page py-16 md:py-20">
        <div class="section-kicker mb-4">Proiecte</div>
        <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-ink-900">Programe în derulare și de impact.</h1>

        <form method="GET" class="mt-10 flex flex-wrap gap-3 items-center">
            <select name="category" class="form-select max-w-[220px]" onchange="this.form.submit()">
                <option value="">Toate categoriile</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->slug }}" @selected(request('category') === $cat->slug)>{{ $cat->name }}</option>
                @endforeach
            </select>
            <select name="status" class="form-select max-w-[180px]" onchange="this.form.submit()">
                <option value="">Toate stările</option>
                @foreach (\App\Models\Project::STATUSES as $k => $l)
                    <option value="{{ $k }}" @selected(request('status') === $k)>{{ $l }}</option>
                @endforeach
            </select>
        </form>
    </section>

    <section class="container-page pb-24">
        @if ($projects->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($projects as $project)
                    <x-project-card :project="$project" />
                @endforeach
            </div>
            <div class="mt-10">{{ $projects->links() }}</div>
        @else
            <div class="text-center py-20 text-ink-400">Nu am găsit proiecte care să corespundă filtrelor.</div>
        @endif
    </section>
</x-layouts.app>
