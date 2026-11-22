<div>
    @if ($sent)
        <div class="card p-8 text-center" data-testid="beneficiary-success">
            <x-icon-badge icon="heart" color="accent-green" size="lg" class="mx-auto" />
            <h3 class="mt-4 text-xl font-semibold text-ink-900">Am primit cererea ta.</h3>
            <p class="mt-2 text-ink-500">Un coordonator o va analiza și te va contacta în curând.</p>
        </div>
    @else
        <form wire:submit="submit" class="grid grid-cols-1 md:grid-cols-2 gap-4" data-testid="beneficiary-request-form">
            <x-form-field label="Nume solicitant / organizație" name="requester_name" required wire:model.lazy="requester_name" />
            <x-form-field label="Email" name="email" type="email" required wire:model.lazy="email" />
            <x-form-field label="Telefon" name="phone" wire:model.lazy="phone" />
            <div>
                <label class="form-label">Tip beneficiar <span class="text-red-500">*</span></label>
                <select wire:model.lazy="beneficiary_type" class="form-select">
                    <option value="school">Școală</option>
                    <option value="ngo">ONG</option>
                    <option value="community">Comunitate</option>
                    <option value="individual">Persoană</option>
                    <option value="other">Altul</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <x-form-field label="Nevoia educațională" name="educational_need" type="textarea" rows="4" required wire:model.lazy="educational_need" />
            </div>
            <x-form-field label="Public țintă" name="target_audience" wire:model.lazy="target_audience" placeholder="Ex: elevi clasa a IX-a" />
            <x-form-field label="Localitate" name="location" wire:model.lazy="location" />
            <x-form-field label="Nr. estimat beneficiari" name="estimated_beneficiaries" type="number" wire:model.lazy="estimated_beneficiaries" />
            <div>
                <label class="form-label">Urgență</label>
                <select wire:model.lazy="urgency" class="form-select">
                    <option value="low">Scăzută</option>
                    <option value="normal">Normală</option>
                    <option value="high">Ridicată</option>
                    <option value="critical">Critică</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <x-form-field label="Sprijin solicitat" name="requested_support" type="textarea" rows="3" wire:model.lazy="requested_support" />
            </div>
            <div class="md:col-span-2 flex justify-end">
                <button type="submit" class="btn-primary" data-testid="beneficiary-submit">
                    <span wire:loading.remove wire:target="submit">Trimite cererea</span>
                    <span wire:loading wire:target="submit">Se trimite...</span>
                </button>
            </div>
        </form>
    @endif
</div>
