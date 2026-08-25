<x-layouts.app title="Mulțumim — Împreună Învățăm">
    <section class="container-page py-24 max-w-2xl mx-auto text-center">
        <x-icon-badge icon="heart" color="accent-green" size="lg" class="mx-auto" />
        <h1 class="mt-6 text-4xl font-semibold text-ink-900">Îți mulțumim, {{ $donation->donor_name }}!</h1>
        <p class="mt-4 text-lg text-ink-500">
            Donația ta de <span class="font-semibold text-ink-900">{{ number_format($donation->amount, 0, ',', '.') }} {{ $donation->currency }}</span> a fost înregistrată.
            @if ($donation->status === 'pending')
                Vei primi în curând instrucțiunile pentru finalizarea plății pe emailul <b>{{ $donation->donor_email }}</b>.
            @endif
        </p>

        <p class="mt-6 text-ink-500">Referință: <code class="bg-ink-100 px-2 py-1 rounded">{{ $donation->payment_reference ?? '—' }}</code></p>

        <a href="{{ route('home') }}" class="btn-primary mt-10">Înapoi la pagina principală</a>
    </section>
</x-layouts.app>
