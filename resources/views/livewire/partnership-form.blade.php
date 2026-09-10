<div>
    @if ($sent)
        <div class="card p-8 text-center" data-testid="partnership-success">
            <x-icon-badge icon="briefcase" color="accent-green" size="lg" class="mx-auto" />
            <h3 class="mt-4 text-xl font-semibold text-ink-900">Îți mulțumim pentru interes!</h3>
            <p class="mt-2 text-ink-500">Am primit solicitarea ta. Un membru al echipei te va contacta în curând.</p>
        </div>
    @else
        <form wire:submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 gap-4" data-testid="partnership-form">
            <x-form-field label="Numele organizației" name="organisation_name" required wire:model.lazy="organisation_name" />
            <x-form-field label="Persoană de contact" name="contact_name" required wire:model.lazy="contact_name" />
            <x-form-field label="Email" name="email" type="email" required wire:model.lazy="email" />
            <x-form-field label="Telefon" name="phone" wire:model.lazy="phone" />
            <x-form-field label="Website" name="website" type="url" wire:model.lazy="website" placeholder="https://" />
            <x-form-field label="Tip organizație" name="organisation_type" wire:model.lazy="organisation_type" placeholder="Companie, ONG, școală..." />
            <div class="md:col-span-2">
                <x-form-field label="Tip parteneriat de interes" name="partnership_type" wire:model.lazy="partnership_type" placeholder="Sponsorizare, voluntariat corporate, expertiză..." />
            </div>
            <div class="md:col-span-2">
                <x-form-field label="Mesaj" name="message" type="textarea" rows="5" required wire:model.lazy="message" />
            </div>
            <div class="md:col-span-2 flex justify-end">
                <button type="submit" class="btn-primary" data-testid="partnership-submit">
                    <span wire:loading.remove wire:target="submit">Trimite solicitarea</span>
                    <span wire:loading wire:target="submit">Se trimite...</span>
                </button>
            </div>
        </form>
    @endif
</div>
