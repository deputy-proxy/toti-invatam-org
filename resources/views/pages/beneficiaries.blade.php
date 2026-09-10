<x-layouts.app title="Beneficiari — Împreună Învățăm">
    <section class="container-page py-16 md:py-24 grid lg:grid-cols-2 gap-14 items-start">
        <div>
            <div class="section-kicker mb-4">Beneficiari</div>
            <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-ink-900">Ai o nevoie educațională? Suntem aici.</h1>
            <p class="mt-6 text-lg text-ink-500 leading-relaxed">
                Școli, ONG-uri, comunități și organizații pot solicita sprijin educațional. Analizăm fiecare cerere și căutăm resursele potrivite.
            </p>
            <div class="mt-8 card p-6">
                <div class="section-kicker mb-2">Cum funcționează</div>
                <ol class="space-y-3 text-ink-700 list-decimal list-inside">
                    <li>Descrii nevoia ta prin formularul de mai jos</li>
                    <li>Un coordonator te contactează pentru clarificări</li>
                    <li>Căutăm educatori / resurse / parteneri potriviți</li>
                    <li>Începem programul împreună</li>
                </ol>
            </div>
        </div>

        <div>
            <div class="card p-8">
                <h2 class="text-2xl font-semibold text-ink-900">Solicită sprijin</h2>
                <p class="text-sm text-ink-500 mt-1">Toate câmpurile relevante ne ajută să te sprijinim mai bine.</p>
                <div class="mt-6">
                    @livewire('beneficiary-request-form')
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
