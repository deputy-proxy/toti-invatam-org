@php use App\Models\SiteSetting; @endphp
<footer class="mt-20 border-t border-ink-100 bg-ink-50">
    <div class="container-page py-14 grid gap-10 md:grid-cols-2 lg:grid-cols-5">
        <div class="lg:col-span-2 max-w-sm">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-brand-600 grid place-content-center text-white font-bold">Îi</div>
                <div class="leading-tight">
                    <div class="font-semibold text-ink-900">ÎMPREUNĂ ÎNVĂȚĂM</div>
                    <div class="text-xs uppercase tracking-widest text-brand-700">Fundație</div>
                </div>
            </div>
            <p class="text-ink-500 text-sm leading-relaxed">
                Construim punți între educatori, resurse și cei care au nevoie de educație.
            </p>
            <div class="mt-5 flex items-center gap-3 text-brand-700">
                <a href="{{ SiteSetting::get('social_facebook','#') }}" class="hover:text-brand-800" aria-label="Facebook"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12a10 10 0 1 0-11.6 9.9v-7H8v-3h2.4V9.5c0-2.4 1.4-3.7 3.6-3.7 1 0 2.1.2 2.1.2v2.3h-1.2c-1.2 0-1.5.7-1.5 1.5V12h2.6l-.4 3h-2.2v7A10 10 0 0 0 22 12"/></svg></a>
                <a href="{{ SiteSetting::get('social_instagram','#') }}" class="hover:text-brand-800" aria-label="Instagram"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2 0 1.8.2 2.2.4.6.2 1 .5 1.4.9.4.4.7.8.9 1.4.2.4.4 1 .4 2.2.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c0 1.2-.2 1.8-.4 2.2-.2.6-.5 1-.9 1.4-.4.4-.8.7-1.4.9-.4.2-1 .4-2.2.4-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2 0-1.8-.2-2.2-.4-.6-.2-1-.5-1.4-.9-.4-.4-.7-.8-.9-1.4-.2-.4-.4-1-.4-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.9c0-1.2.2-1.8.4-2.2.2-.6.5-1 .9-1.4.4-.4.8-.7 1.4-.9.4-.2 1-.4 2.2-.4C8.4 2.2 8.8 2.2 12 2.2M12 0C8.7 0 8.3 0 7.1.1 5.8.1 5 .3 4.2.6c-.8.3-1.5.7-2.2 1.4C1.3 2.7.9 3.4.6 4.2.3 5 .1 5.8.1 7.1 0 8.3 0 8.7 0 12s0 3.7.1 4.9c0 1.3.2 2.1.5 2.9.3.8.7 1.5 1.4 2.2.7.7 1.4 1.1 2.2 1.4.8.3 1.6.5 2.9.5C8.3 24 8.7 24 12 24s3.7 0 4.9-.1c1.3 0 2.1-.2 2.9-.5.8-.3 1.5-.7 2.2-1.4.7-.7 1.1-1.4 1.4-2.2.3-.8.5-1.6.5-2.9C24 15.7 24 15.3 24 12s0-3.7-.1-4.9c0-1.3-.2-2.1-.5-2.9-.3-.8-.7-1.5-1.4-2.2-.7-.7-1.4-1.1-2.2-1.4-.8-.3-1.6-.5-2.9-.5C15.7 0 15.3 0 12 0zm0 5.8a6.2 6.2 0 1 0 0 12.4 6.2 6.2 0 0 0 0-12.4zm0 10.2a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm7.9-10.4a1.4 1.4 0 1 1-2.9 0 1.4 1.4 0 0 1 2.9 0"/></svg></a>
                <a href="{{ SiteSetting::get('social_linkedin','#') }}" class="hover:text-brand-800" aria-label="LinkedIn"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.5 2h-17A1.5 1.5 0 0 0 2 3.5v17A1.5 1.5 0 0 0 3.5 22h17a1.5 1.5 0 0 0 1.5-1.5v-17A1.5 1.5 0 0 0 20.5 2M8 19H5V9h3v10M6.5 7.7a1.7 1.7 0 1 1 0-3.4 1.7 1.7 0 0 1 0 3.4M19 19h-3v-5.5c0-1.3-.5-1.9-1.5-1.9-1.1 0-1.8.7-1.8 1.9V19h-3V9h3v1.3s.9-1.5 3-1.5c2.4 0 3.3 1.3 3.3 4V19"/></svg></a>
                <a href="{{ SiteSetting::get('social_youtube','#') }}" class="hover:text-brand-800" aria-label="YouTube"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.6A3 3 0 0 0 .5 6.2C0 8.1 0 12 0 12s0 3.9.5 5.8a3 3 0 0 0 2.1 2.1c1.9.6 9.4.6 9.4.6s7.5 0 9.4-.6a3 3 0 0 0 2.1-2.1c.5-1.9.5-5.8.5-5.8s0-3.9-.5-5.8M9.6 15.6V8.4l6.2 3.6-6.2 3.6"/></svg></a>
            </div>
        </div>

        <div>
            <h4 class="font-semibold text-ink-900 mb-3">Despre noi</h4>
            <ul class="space-y-2 text-sm text-ink-500">
                <li><a href="{{ route('about') }}" class="hover:text-brand-700">Cine suntem</a></li>
                <li><a href="{{ route('about') }}#misiune" class="hover:text-brand-700">Misiune și valori</a></li>
                <li><a href="{{ route('about') }}#echipa" class="hover:text-brand-700">Echipa</a></li>
                <li><a href="{{ route('annual-reports') }}" class="hover:text-brand-700">Raport anual</a></li>
            </ul>
        </div>

        <div>
            <h4 class="font-semibold text-ink-900 mb-3">Implică-te</h4>
            <ul class="space-y-2 text-sm text-ink-500">
                <li><a href="{{ route('donate') }}" class="hover:text-brand-700">Donează</a></li>
                <li><a href="{{ route('volunteer') }}" class="hover:text-brand-700">Devino voluntar</a></li>
                <li><a href="{{ route('corporate') }}" class="hover:text-brand-700">Pentru companii</a></li>
                <li><a href="{{ route('partners') }}" class="hover:text-brand-700">Parteneriate</a></li>
            </ul>
        </div>

        <div>
            <h4 class="font-semibold text-ink-900 mb-3">Resurse</h4>
            <ul class="space-y-2 text-sm text-ink-500">
                <li><a href="{{ route('projects.index') }}" class="hover:text-brand-700">Proiecte</a></li>
                <li><a href="{{ route('resources.index') }}" class="hover:text-brand-700">Materiale educaționale</a></li>
                <li><a href="{{ route('events.index') }}" class="hover:text-brand-700">Evenimente</a></li>
                <li><a href="{{ route('news.index') }}" class="hover:text-brand-700">Noutăți</a></li>
            </ul>
        </div>
    </div>

    <div class="border-t border-ink-100">
        <div class="container-page py-6 flex flex-col md:flex-row justify-between gap-4 text-xs text-ink-500">
            <div>© {{ date('Y') }} Împreună Învățăm — Fundație pentru educație și dezvoltare. Toate drepturile rezervate.</div>
            <div class="flex gap-6">
                <a href="{{ route('legal.privacy') }}" class="hover:text-brand-700">Politica de confidențialitate</a>
                <a href="{{ route('legal.terms') }}" class="hover:text-brand-700">Termeni și condiții</a>
                <a href="{{ route('legal.cookies') }}" class="hover:text-brand-700">Cookies</a>
            </div>
        </div>
    </div>
</footer>
