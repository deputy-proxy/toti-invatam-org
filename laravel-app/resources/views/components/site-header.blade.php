@php
    $nav = [
        ['route' => 'about', 'label' => 'Despre noi'],
        ['route' => 'how-it-works', 'label' => 'Cum funcționează'],
        ['route' => 'impact', 'label' => 'Impact'],
        ['route' => 'involve', 'label' => 'Implică-te'],
        ['route' => 'resources.index', 'label' => 'Resurse'],
        ['route' => 'news.index', 'label' => 'Noutăți'],
        ['route' => 'contact', 'label' => 'Contact'],
    ];
@endphp

<header x-data="{ open: false }" class="sticky top-0 z-40 bg-white/90 backdrop-blur border-b border-ink-100">
    <div class="container-page flex items-center justify-between h-20">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-brand-600 grid place-content-center text-white font-bold">Îi</div>
            <div class="leading-tight">
                <div class="font-semibold text-ink-900">ÎMPREUNĂ ÎNVĂȚĂM</div>
                <div class="text-xs uppercase tracking-widest text-brand-700">Fundație</div>
            </div>
        </a>

        <nav class="hidden lg:flex items-center gap-7">
            @foreach ($nav as $item)
                <a href="{{ route($item['route']) }}"
                   class="text-sm font-medium {{ request()->routeIs($item['route']) ? 'text-brand-700' : 'text-ink-700 hover:text-brand-700' }} transition">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="flex items-center gap-3">
            <a href="{{ route('donate') }}" class="btn-primary hidden md:inline-flex" data-testid="header-donate-cta">Donează</a>
            <button @click="open = !open" class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-full border border-ink-200 text-ink-700"
                    aria-label="Toggle menu">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="open" x-cloak xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div x-show="open" x-cloak x-transition class="lg:hidden border-t border-ink-100 bg-white">
        <div class="container-page py-4 flex flex-col gap-2">
            @foreach ($nav as $item)
                <a href="{{ route($item['route']) }}" class="py-2 text-ink-800 font-medium">{{ $item['label'] }}</a>
            @endforeach
            <a href="{{ route('donate') }}" class="btn-primary mt-3" data-testid="mobile-donate-cta">Donează</a>
        </div>
    </div>
</header>
