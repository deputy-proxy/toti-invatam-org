<x-layouts.app title="Voluntariat — Împreună Învățăm">
    <section class="container-page py-16 md:py-24 grid lg:grid-cols-2 gap-14 items-start">
        <div>
            <div class="section-kicker mb-4">Voluntariat</div>
            <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-ink-900">Împărtășește din tine, transformă vieți.</h1>
            <p class="mt-6 text-lg text-ink-500 leading-relaxed">
                Voluntarii sunt inima ecosistemului. Fie că ești profesor, student, profesionist sau doar cineva care vrea să ajute — există un loc pentru tine.
            </p>
            <ul class="mt-8 space-y-3 text-ink-700">
                <li class="flex gap-3"><x-heroicon name="sparkles" class="w-5 h-5 text-brand-600 mt-1" /> Alegi cauza și formatul care ți se potrivește</li>
                <li class="flex gap-3"><x-heroicon name="user-group" class="w-5 h-5 text-brand-600 mt-1" /> Faci parte dintr-o comunitate națională</li>
                <li class="flex gap-3"><x-heroicon name="chart-bar" class="w-5 h-5 text-brand-600 mt-1" /> Îți vezi impactul concret în datele proiectelor</li>
            </ul>
        </div>
        <div>
            <div class="card p-8">
                <h2 class="text-2xl font-semibold text-ink-900">Aplică ca voluntar</h2>
                <p class="text-sm text-ink-500 mt-1">Completează formularul și te contactăm în cel mai scurt timp.</p>
                <div class="mt-6">
                    @livewire('volunteer-form')
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
