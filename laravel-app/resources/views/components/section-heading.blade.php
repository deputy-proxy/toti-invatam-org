@props(['kicker' => null, 'title' => '', 'subtitle' => null, 'align' => 'center'])
<div class="{{ $align === 'center' ? 'text-center max-w-3xl mx-auto' : '' }}">
    @if ($kicker)
        <div class="section-kicker mb-3">{{ $kicker }}</div>
    @endif
    <h2 class="section-title">{{ $title }}</h2>
    @if ($subtitle)
        <p class="mt-4 text-lg text-ink-500 leading-relaxed">{{ $subtitle }}</p>
    @endif
</div>
