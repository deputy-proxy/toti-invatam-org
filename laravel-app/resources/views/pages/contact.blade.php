@php use App\Models\SiteSetting; @endphp
<x-layouts.app title="Contact — Împreună Învățăm">
    <section class="container-page py-16 md:py-24 grid lg:grid-cols-2 gap-14 items-start">
        <div>
            <div class="section-kicker mb-4">Contact</div>
            <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-ink-900">Hai să vorbim.</h1>
            <p class="mt-6 text-lg text-ink-500 leading-relaxed">Ne poți contacta pentru orice întrebare, propunere sau colaborare.</p>

            <div class="mt-10 space-y-5">
                <div class="flex items-center gap-4">
                    <x-icon-badge icon="chat-bubble" />
                    <div>
                        <div class="text-sm text-ink-500">Email</div>
                        <a href="mailto:{{ SiteSetting::get('foundation_email') }}" class="font-medium text-ink-900 hover:text-brand-700">{{ SiteSetting::get('foundation_email') }}</a>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <x-icon-badge icon="briefcase" color="accent-yellow" />
                    <div>
                        <div class="text-sm text-ink-500">Telefon</div>
                        <div class="font-medium text-ink-900">{{ SiteSetting::get('foundation_phone') }}</div>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <x-icon-badge icon="map-pin" color="accent-green" />
                    <div>
                        <div class="text-sm text-ink-500">Adresă</div>
                        <div class="font-medium text-ink-900">{{ SiteSetting::get('foundation_address') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="card p-8">
                <h2 class="text-2xl font-semibold text-ink-900">Trimite-ne un mesaj</h2>
                <div class="mt-6">
                    @livewire('contact-form')
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
