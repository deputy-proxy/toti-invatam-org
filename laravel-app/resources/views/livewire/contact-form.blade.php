<div>
    @if ($sent)
        <div class="card p-8 text-center" data-testid="contact-success">
            <x-icon-badge icon="chat-bubble" color="accent-green" size="lg" class="mx-auto" />
            <h3 class="mt-4 text-xl font-semibold text-ink-900">Mulțumim pentru mesaj!</h3>
            <p class="mt-2 text-ink-500">Îți vom răspunde în cel mai scurt timp.</p>
            <button wire:click="$set('sent', false)" class="btn-ghost mt-6">Trimite alt mesaj</button>
        </div>
    @else
        <form wire:submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 gap-4" data-testid="contact-form">
            <x-form-field label="Nume" name="name" required wire:model.lazy="name" />
            <x-form-field label="Email" name="email" type="email" required wire:model.lazy="email" />
            <x-form-field label="Telefon" name="phone" wire:model.lazy="phone" />
            <x-form-field label="Subiect" name="subject" wire:model.lazy="subject" />
            <div class="md:col-span-2">
                <x-form-field label="Mesaj" name="message" type="textarea" rows="5" required wire:model.lazy="message" />
            </div>
            <div class="md:col-span-2 flex justify-end">
                <button type="submit" class="btn-primary" data-testid="contact-submit">
                    <span wire:loading.remove wire:target="submit">Trimite mesajul</span>
                    <span wire:loading wire:target="submit">Se trimite...</span>
                </button>
            </div>
        </form>
    @endif
</div>
