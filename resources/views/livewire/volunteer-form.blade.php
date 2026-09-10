<div>
    @if ($sent)
        <div class="card p-8 text-center" data-testid="volunteer-success">
            <x-icon-badge icon="heart" color="accent-green" size="lg" class="mx-auto" />
            <h3 class="mt-4 text-xl font-semibold text-ink-900">Îți mulțumim că ni te alături!</h3>
            <p class="mt-2 text-ink-500">Am primit cererea ta. Un coordonator te va contacta în curând.</p>
        </div>
    @else
        <form wire:submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 gap-4" enctype="multipart/form-data" data-testid="volunteer-form">
            <x-form-field label="Nume complet" name="name" required wire:model.lazy="name" />
            <x-form-field label="Email" name="email" type="email" required wire:model.lazy="email" />
            <x-form-field label="Telefon" name="phone" wire:model.lazy="phone" />
            <x-form-field label="Profesie" name="profession" wire:model.lazy="profession" />
            <div class="md:col-span-2">
                <x-form-field label="Competențe" name="skills" type="textarea" rows="3" wire:model.lazy="skills" placeholder="Ex: engleză, matematică, programare, coaching..." />
            </div>
            <div class="md:col-span-2">
                <x-form-field label="De ce vrei să te alături?" name="motivation" type="textarea" rows="4" required wire:model.lazy="motivation" />
            </div>
            <x-form-field label="Disponibilitate" name="availability" wire:model.lazy="availability" placeholder="Ex: 2 ore/săptămână, weekend, seara" />
            <div>
                <label class="form-label">CV (opțional, PDF/DOC)</label>
                <input type="file" wire:model="cv" class="form-input" accept=".pdf,.doc,.docx">
                @error('cv')<p class="form-error">{{ $message }}</p>@enderror
            </div>
            <div class="md:col-span-2 flex justify-end">
                <button type="submit" class="btn-primary" data-testid="volunteer-submit">
                    <span wire:loading.remove wire:target="submit">Trimite cererea</span>
                    <span wire:loading wire:target="submit">Se trimite...</span>
                </button>
            </div>
        </form>
    @endif
</div>
