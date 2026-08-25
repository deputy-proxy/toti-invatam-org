@props(['testimonial'])
<div class="card p-7 h-full flex flex-col">
    <x-heroicon name="chat-bubble" class="w-8 h-8 text-brand-500 mb-4" />
    <p class="text-ink-800 leading-relaxed text-base flex-1">„{{ $testimonial->quote }}"</p>
    <div class="mt-6 flex items-center gap-3">
        @if ($testimonial->photo)
            <img src="{{ asset('storage/'.$testimonial->photo) }}" alt="{{ $testimonial->name }}" class="w-11 h-11 rounded-full object-cover">
        @else
            <div class="w-11 h-11 rounded-full bg-brand-100 text-brand-700 grid place-content-center font-semibold">
                {{ mb_strtoupper(mb_substr($testimonial->name, 0, 1)) }}
            </div>
        @endif
        <div>
            <div class="font-semibold text-ink-900 text-sm">{{ $testimonial->name }}</div>
            <div class="text-xs text-ink-500">{{ $testimonial->role }}{{ $testimonial->organisation ? ' · '.$testimonial->organisation : '' }}</div>
        </div>
    </div>
</div>
