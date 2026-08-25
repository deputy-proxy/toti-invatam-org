<x-layouts.app title="Implică-te — Împreună Învățăm">
    <section class="container-page py-16 md:py-24 max-w-4xl">
        <div class="section-kicker mb-4">Implică-te</div>
        <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-ink-900">Există un loc pentru tine în ecosistem.</h1>
        <p class="mt-6 text-lg text-ink-500 max-w-2xl">
            Poți contribui în multe feluri. Alege ce ți se potrivește — noi facem restul.
        </p>
    </section>

    <section class="container-page pb-24 grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @php
            $paths = [
                ['Donează','heart','brand','Sprijină financiar programele care schimbă vieți.', route('donate')],
                ['Devino voluntar','user-group','accent-yellow','Împărtășește din cunoștințele și timpul tău.', route('volunteer')],
                ['Devino partener','briefcase','accent-green','Compania ta poate contribui cu resurse, expertiză și oameni.', route('corporate')],
                ['Oferă expertiză','sparkles','accent-purple','Poți susține un atelier, un curs sau un program.', route('volunteer')],
                ['Adu un proiect','rocket','brand','Ai o idee de program educațional? Hai să-l aducem la viață.', route('contact')],
                ['Solicită sprijin','plant','accent-pink','Reprezinți o școală, ONG sau comunitate care are nevoie de resurse.', route('beneficiaries')],
            ];
        @endphp
        @foreach ($paths as [$title, $icon, $color, $desc, $link])
            <a href="{{ $link }}" class="card p-7 card-hover block">
                <x-icon-badge :icon="$icon" :color="$color" size="lg" />
                <h3 class="mt-5 font-semibold text-ink-900 text-lg">{{ $title }}</h3>
                <p class="mt-2 text-ink-500">{{ $desc }}</p>
                <span class="mt-4 inline-flex items-center gap-1 text-sm font-semibold text-brand-700">Începe <x-heroicon name="arrow-right" class="w-4 h-4" /></span>
            </a>
        @endforeach
    </section>
</x-layouts.app>
