@props(['icon', 'color' => 'brand', 'size' => 'md'])
@php
    $sizeCls = match($size) { 'lg' => 'w-16 h-16', 'sm' => 'w-10 h-10', default => 'w-12 h-12' };
    $iconSize = match($size) { 'lg' => 'w-7 h-7', 'sm' => 'w-5 h-5', default => 'w-6 h-6' };
    $bg = match($color) {
        'accent-yellow' => 'bg-yellow-100 text-accent-yellow',
        'accent-green'  => 'bg-green-100 text-accent-green',
        'accent-purple' => 'bg-purple-100 text-accent-purple',
        'accent-pink'   => 'bg-pink-100 text-accent-pink',
        default => 'bg-brand-50 text-brand-700',
    };
@endphp
<div class="{{ $sizeCls }} rounded-full {{ $bg }} grid place-content-center shrink-0">
    <x-heroicon :name="$icon" :class="$iconSize" />
</div>
