<x-layouts.app title="Donează — Împreună Învățăm">
    <section class="container-page py-16 md:py-24 grid lg:grid-cols-2 gap-14 items-start">
        <div>
            <div class="section-kicker mb-4">Donează</div>
            <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-ink-900">Fiecare donație este o punte spre un viitor mai bun.</h1>
            <p class="mt-6 text-lg text-ink-500 leading-relaxed">
                Fondurile pe care le donezi susțin programe educaționale reale, în comunități care altfel nu ar avea acces.
            </p>
            <div class="mt-8 card p-6">
                <div class="section-kicker mb-2">Ce înseamnă donația ta</div>
                <ul class="space-y-2 text-ink-700">
                    <li>• 50 RON — 1 atelier pentru un elev</li>
                    <li>• 250 RON — o zi de mentorat</li>
                    <li>• 1.000 RON — un program complet pentru o clasă</li>
                </ul>
            </div>
        </div>

        <div>
            <form method="POST" action="{{ route('donate.store') }}" class="card p-8 space-y-5" data-testid="donation-form">
                @csrf
                <h2 class="text-2xl font-semibold text-ink-900">Contribuie acum</h2>

                <div>
                    <label class="form-label">Sumă (RON)</label>
                    <div class="grid grid-cols-4 gap-2" x-data="{amount: '{{ old('amount', 100) }}'}">
                        @foreach ([50, 100, 250, 500] as $preset)
                            <button type="button" @click="amount = '{{ $preset }}'; document.getElementById('amount').value='{{ $preset }}'"
                                    class="rounded-xl border border-ink-200 py-3 hover:border-brand-500 hover:text-brand-700"
                                    :class="{ 'border-brand-500 bg-brand-50 text-brand-700': amount == '{{ $preset }}' }">
                                {{ $preset }}
                            </button>
                        @endforeach
                    </div>
                    <input id="amount" name="amount" type="number" min="1" step="1" value="{{ old('amount', 100) }}"
                           class="form-input mt-3" placeholder="Sumă personalizată">
                    @error('amount')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="form-label">Tip donație</label>
                    <div class="flex gap-2">
                        <label class="flex-1 rounded-xl border border-ink-200 p-3 flex items-center gap-2 has-[:checked]:border-brand-500 has-[:checked]:bg-brand-50">
                            <input type="radio" name="type" value="individual" @checked(old('type','individual') === 'individual')> Individuală
                        </label>
                        <label class="flex-1 rounded-xl border border-ink-200 p-3 flex items-center gap-2 has-[:checked]:border-brand-500 has-[:checked]:bg-brand-50">
                            <input type="radio" name="type" value="company" @checked(old('type') === 'company')> Companie
                        </label>
                    </div>
                </div>

                <label class="flex items-center gap-2 text-sm text-ink-700">
                    <input type="checkbox" name="recurring" value="1" class="rounded" @checked(old('recurring'))>
                    Vreau ca donația să se repete lunar
                </label>

                <div>
                    <label class="form-label">Proiect (opțional)</label>
                    <select name="project_id" class="form-select">
                        <option value="">— Program general —</option>
                        @foreach ($projects as $p)
                            <option value="{{ $p->id }}" @selected(old('project_id', $preselected) == $p->id)>{{ $p->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <x-form-field label="Nume complet" name="donor_name" required value="{{ old('donor_name') }}" />
                    <x-form-field label="Email" name="donor_email" type="email" required value="{{ old('donor_email') }}" />
                </div>

                <input type="hidden" name="currency" value="RON">

                <button type="submit" class="btn-primary w-full" data-testid="donate-submit">Continuă spre plată</button>

                <p class="text-xs text-ink-400 text-center">
                    Datele tale sunt protejate conform GDPR. Plata este procesată printr-un partener securizat.
                </p>
            </form>
        </div>
    </section>
</x-layouts.app>
