<x-layouts.app title="Pentru companii — Împreună Învățăm">
    <section class="container-page py-16 md:py-24 grid lg:grid-cols-2 gap-14 items-start">
        <div>
            <div class="section-kicker mb-4">Pentru companii</div>
            <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-ink-900">Compania ta poate deschide uși pentru mii de oameni.</h1>
            <p class="mt-6 text-lg text-ink-500 leading-relaxed">
                Construim programe de parteneriat prin care companiile contribuie cu timp, expertiză și resurse către comunități care au nevoie de educație.
            </p>

            <div class="mt-10 grid sm:grid-cols-2 gap-4">
                @foreach ([
                    ['Sponsorizare','briefcase','Sprijină financiar programe cu impact.'],
                    ['Voluntariat corporate','user-group','Angajații tăi devin mentori și profesori.'],
                    ['Expertiză','sparkles','Contribuie cu know-how specializat.'],
                    ['Programe CSR/ESG','plant','Integrează educația în strategia ta de sustenabilitate.'],
                ] as [$t,$i,$d])
                    <div class="card p-5">
                        <x-icon-badge :icon="$i" />
                        <div class="mt-3 font-semibold text-ink-900">{{ $t }}</div>
                        <div class="text-sm text-ink-500 mt-1">{{ $d }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <div>
            <div class="card p-8">
                <h2 class="text-2xl font-semibold text-ink-900">Hai să vorbim.</h2>
                <p class="text-sm text-ink-500 mt-1">Ne bucurăm să explorăm împreună un parteneriat.</p>
                <div class="mt-6">
                    @livewire('partnership-form')
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
