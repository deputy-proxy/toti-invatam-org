<x-layouts.app title="Cum funcționează — Împreună Învățăm">
    <section class="container-page py-16 md:py-24 max-w-4xl">
        <div class="section-kicker mb-4">Cum funcționează</div>
        <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-ink-900">De la nevoie la impact — pas cu pas.</h1>
    </section>

    <section class="container-page pb-24 space-y-14">
        @php
            $steps = [
                ['Identificăm nevoile','users','Ascultăm comunități, școli, ONG-uri și instituții pentru a înțelege lipsurile educaționale reale.'],
                ['Conectăm','puzzle','Găsim educatorii, companiile sau profesioniștii potriviți pentru fiecare nevoie identificată.'],
                ['Potrivim','sparkles','Aliniem calendarele, formatul, resursele și obiectivele astfel încât programul să funcționeze.'],
                ['Facilităm','plant','Oferim coordonarea, infrastructura și logistica de care are nevoie fiecare program.'],
                ['Livrăm','book-open','Programele educaționale ajung în școli, comunități și în viețile beneficiarilor.'],
                ['Măsurăm impactul','chart-bar','Colectăm date, feedback și povești pentru a demonstra că schimbarea este reală.'],
            ];
        @endphp
        @foreach ($steps as $idx => [$title, $icon, $desc])
            <div class="grid md:grid-cols-[80px_1fr] gap-6 items-start">
                <div class="text-4xl font-semibold text-brand-600">{{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}</div>
                <div>
                    <div class="flex items-center gap-4"><x-icon-badge :icon="$icon" size="lg" /><h2 class="text-2xl font-semibold text-ink-900">{{ $title }}</h2></div>
                    <p class="mt-3 text-ink-500 leading-relaxed max-w-3xl">{{ $desc }}</p>
                </div>
            </div>
        @endforeach
    </section>

    <section class="bg-ink-50/60 py-16">
        <div class="container-page grid md:grid-cols-2 gap-8">
            <div class="card p-8">
                <div class="section-kicker mb-3">Pentru cei care oferă</div>
                <h3 class="text-2xl font-semibold text-ink-900">Ești educator sau profesionist?</h3>
                <p class="mt-3 text-ink-500 leading-relaxed">Îți alegi cauza. Noi găsim beneficiarii. Îți dăm structura pentru a livra impact real.</p>
                <a href="{{ route('volunteer') }}" class="btn-primary mt-6">Devino voluntar</a>
            </div>
            <div class="card p-8">
                <div class="section-kicker mb-3">Pentru cei care au nevoie</div>
                <h3 class="text-2xl font-semibold text-ink-900">Reprezinți o școală sau comunitate?</h3>
                <p class="mt-3 text-ink-500 leading-relaxed">Descrie-ne nevoia și lasă-ne să găsim resursele educaționale potrivite pentru tine.</p>
                <a href="{{ route('beneficiaries') }}" class="btn-secondary mt-6">Solicită sprijin</a>
            </div>
        </div>
    </section>
</x-layouts.app>
