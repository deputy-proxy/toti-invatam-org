@php use App\Models\SiteSetting; @endphp
<x-layouts.app :title="'Împreună Învățăm — '.SiteSetting::get('hero_headline','Conectăm cunoașterea cu cei care au nevoie de ea.')">

    {{-- ============ HERO ============ --}}
    <section class="relative overflow-hidden">
        <div class="container-page pt-14 md:pt-20 pb-16 grid lg:grid-cols-2 gap-12 items-center">
            {{-- Left --}}
            <div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-semibold leading-[1.05] tracking-tight text-brand-800">
                    {{ SiteSetting::get('hero_headline', 'Conectăm cunoașterea cu cei care au nevoie de ea.') }}
                </h1>
                <p class="mt-6 text-lg text-ink-500 leading-relaxed max-w-xl">
                    {{ SiteSetting::get('hero_description', 'Împreună Învățăm este fundația care construiește punți între educatori, companii și profesioniști și cei care nu au acces la oportunități de învățare.') }}
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('how-it-works') }}" class="btn-primary" data-testid="hero-primary-cta">
                        {{ SiteSetting::get('hero_cta_primary', 'Descoperă cum funcționează') }}
                    </a>
                    <a href="{{ route('involve') }}" class="btn-secondary" data-testid="hero-secondary-cta">
                        {{ SiteSetting::get('hero_cta_secondary', 'Implică-te') }}
                    </a>
                </div>

                {{-- Partners strip --}}
                <div class="mt-12">
                    <div class="text-xs uppercase tracking-widest text-ink-400 mb-4">Cu sprijinul partenerilor noștri</div>
                    <div class="flex flex-wrap items-center gap-x-8 gap-y-4 grayscale opacity-80">
                        @forelse ($partners as $partner)
                            @if ($partner->organization->logo)
                                <img src="{{ asset('storage/'.$partner->organization->logo) }}" alt="{{ $partner->organization->name }}" class="h-8 max-w-[130px] object-contain">
                            @else
                                <span class="text-ink-500 font-semibold text-sm">{{ $partner->organization->name }}</span>
                            @endif
                        @empty
                            <span class="text-ink-400 text-sm">Adaugă parteneri din admin</span>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Right: photograph + blue blob + orbiting icons --}}
            <div class="relative">
                {{-- Organic blue blob --}}
                <div class="absolute inset-0 -z-10">
                    <svg viewBox="0 0 600 600" class="w-full h-full" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
                        <defs>
                            <linearGradient id="blob" x1="0" y1="0" x2="1" y2="1">
                                <stop offset="0%" stop-color="#3767ff"/><stop offset="100%" stop-color="#1c37b6"/>
                            </linearGradient>
                        </defs>
                        <path fill="url(#blob)" transform="translate(300 300)"
                            d="M115,-160C155,-130,197,-99,207,-58C217,-17,196,34,168,80C140,127,105,168,60,187C15,205,-40,201,-88,178C-136,155,-176,113,-193,63C-210,13,-203,-46,-176,-92C-149,-138,-101,-171,-53,-181C-4,-191,45,-179,90,-176C104,-175,90,-190,115,-160Z" opacity="0.9"/>
                    </svg>
                </div>

                {{-- Main Image Card --}}
                <div class="relative aspect-[5/6] max-w-[520px] mx-auto rounded-[36px] overflow-hidden shadow-cardLg bg-ink-100">
                    <img src="https://images.pexels.com/photos/28862352/pexels-photo-28862352.jpeg"
                        alt="Educator lucrând cu elevi" class="w-full h-full object-cover">
                </div>

                {{-- Orbiting / Floating Icon Badges --}}
                
                {{-- Badge 1: Academic Cap (Top Right) --}}
                <div class="hidden md:block absolute -top-4 right-4 animate-float">
                    <div class="relative group">
                        <div class="w-14 h-14 rounded-full bg-brand-600 text-white grid place-content-center shadow-cardLg transform transition-transform duration-300 group-hover:scale-110 cursor-pointer">
                            <x-heroicon name="academic-cap" class="w-6 h-6" />
                        </div>
                        {{-- Tooltip --}}
                        <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:flex flex-col items-center pointer-events-none transition-all duration-200 opacity-0 group-hover:opacity-100">
                            <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-gray-900 rounded-md shadow-lg">Educație</span>
                            <div class="w-2 h-2 -mt-1 rotate-45 bg-gray-900"></div>
                        </div>
                    </div>
                </div>

                {{-- Badge 2: Heart (Middle Left) --}}
                <div class="hidden md:block absolute top-1/3 -left-4 animate-float-delayed">
                    <div class="relative group">
                        <div class="w-14 h-14 rounded-full bg-white text-accent-yellow grid place-content-center shadow-cardLg transform transition-transform duration-300 group-hover:scale-110 cursor-pointer">
                            <x-heroicon name="heart" class="w-6 h-6" />
                        </div>
                        {{-- Tooltip --}}
                        <div class="absolute right-full top-1/2 -translate-y-1/2 mr-2 hidden group-hover:flex items-center pointer-events-none transition-all duration-200 opacity-0 group-hover:opacity-100">
                            <span class="relative z-10 p-2 text-xs leading-none text-gray-900 whitespace-nowrap bg-white rounded-md shadow-lg border border-gray-100">Pasiune</span>
                            <div class="w-2 h-2 -ml-1 rotate-45 bg-white border-l border-b border-gray-100"></div>
                        </div>
                    </div>
                </div>

                {{-- Badge 3: User Group (Bottom Left) --}}
                <div class="hidden md:block absolute bottom-8 -left-6 animate-float">
                    <div class="relative group">
                        <div class="w-14 h-14 rounded-full bg-white text-accent-green grid place-content-center shadow-cardLg transform transition-transform duration-300 group-hover:scale-110 cursor-pointer">
                            <x-heroicon name="user-group" class="w-6 h-6" />
                        </div>
                        {{-- Tooltip --}}
                        <div class="absolute top-full left-1/2 -translate-x-1/2 mt-2 hidden group-hover:flex flex-col items-center pointer-events-none transition-all duration-200 opacity-0 group-hover:opacity-100">
                            <div class="w-2 h-2 -mb-1 rotate-45 bg-white border-t border-l border-gray-100"></div>
                            <span class="relative z-10 p-2 text-xs leading-none text-gray-900 whitespace-nowrap bg-white rounded-md shadow-lg border border-gray-100">Comunitate</span>
                        </div>
                    </div>
                </div>

                {{-- Badge 4: Book Open (Middle Right) --}}
                <div class="hidden md:block absolute bottom-1/3 -right-4 animate-float-delayed">
                    <div class="relative group">
                        <div class="w-14 h-14 rounded-full bg-white text-accent-purple grid place-content-center shadow-cardLg transform transition-transform duration-300 group-hover:scale-110 cursor-pointer">
                            <x-heroicon name="book-open" class="w-6 h-6" />
                        </div>
                        {{-- Tooltip --}}
                        <div class="absolute left-full top-1/2 -translate-y-1/2 ml-2 hidden group-hover:flex items-center pointer-events-none transition-all duration-200 opacity-0 group-hover:opacity-100">
                            <div class="w-2 h-2 -mr-1 rotate-45 bg-white border-b border-l border-gray-100"></div>
                            <span class="relative z-10 p-2 text-xs leading-none text-gray-900 whitespace-nowrap bg-white rounded-md shadow-lg border border-gray-100">Învățare</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ CUM FUNCȚIONEAZĂ ============ --}}
    <section class="py-20 md:py-24">
        <div class="container-page">
            <x-section-heading title="Cum funcționează" />

            <div class="mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-4 relative">
                {{-- Dotted connector line --}}
                <div aria-hidden="true" class="hidden lg:block absolute top-10 left-[12%] right-[12%] border-t-2 border-dotted border-ink-200"></div>

                @php
                    $steps = [
                        ['1','Conectăm','users','brand','Identificăm nevoile educaționale și aducem laolaltă cei care pot oferi și cei care au nevoie.'],
                        ['2','Potrivim','puzzle','accent-yellow','Potrivim resursele, oamenii și oportunitățile potrivite pentru fiecare nevoie.'],
                        ['3','Facilităm','plant','accent-green','Oferim infrastructură, suport și coordonare pentru ca educația să ajungă acolo unde este nevoie.'],
                        ['4','Transformăm','rocket','accent-purple','Urmărim impactul și creăm schimbări reale în viețile beneficiarilor.'],
                    ];
                @endphp
                @foreach ($steps as [$num,$title,$icon,$color,$desc])
                    <div class="text-center relative">
                        <div class="mx-auto mb-6 relative z-10 bg-white">
                            <x-icon-badge :icon="$icon" :color="$color" size="lg" class="mx-auto" />
                        </div>
                        <h3 class="font-semibold text-ink-900 text-lg">{{ $num }}. {{ $title }}</h3>
                        <p class="mt-3 text-sm text-ink-500 leading-relaxed max-w-[260px] mx-auto">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ PENTRU CINE ============ --}}
    <section class="py-20 md:py-24 bg-ink-50/60">
        <div class="container-page">
            <x-section-heading title="Pentru cine" subtitle="Construim punți pentru un ecosistem educațional mai echitabil." />

            <div class="mt-14 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @php
                    $personas = [
                        ['Educatori','academic-cap','brand','Profesori, formatori, mentori, voluntari care vor să își împărtășească cunoștințele.'],
                        ['Companii & Profesioniști','briefcase','accent-yellow','Organizații și profesioniști care vor să contribuie prin timp, expertiză sau resurse.'],
                        ['Comunități & Instituții','user-group','accent-green','Școli, ONG-uri și organizații care identifică nevoi educaționale reale.'],
                        ['Cei care au nevoie','users','accent-purple','Copii, tineri și adulți care nu au acces la educație din diverse motive.'],
                        ['Donatori & Susținători','heart','accent-pink','Oameni care cred în educație și vor să susțină schimbarea.'],
                    ];
                @endphp
                @foreach ($personas as [$title,$icon,$color,$desc])
                    <div class="card p-6 text-center card-hover">
                        <x-icon-badge :icon="$icon" :color="$color" class="mx-auto" />
                        <h3 class="mt-5 font-semibold text-ink-900">{{ $title }}</h3>
                        <p class="mt-2 text-sm text-ink-500 leading-relaxed">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ IMPACTUL NOSTRU ============ --}}
    <section class="py-20 md:py-24">
        <div class="container-page">
            <x-section-heading title="Impactul nostru" subtitle="Împreună, creăm oportunități reale de învățare." />

            <div class="mt-14 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @forelse ($metrics as $m)
                    <div class="flex items-center gap-4">
                        <x-icon-badge :icon="$m->icon ?: 'sparkles'" :color="$m->color ?: 'brand'" size="lg" />
                        <div>
                            <div class="text-3xl md:text-4xl font-semibold text-ink-900 leading-none">{{ $m->numeric_value }}<span class="text-brand-600">{{ $m->suffix }}</span></div>
                            <div class="mt-2 text-sm text-ink-500 leading-tight">{{ $m->title }}</div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-ink-400">Adaugă metrici de impact în admin.</div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ============ CUM TE POȚI IMPLICA ============ --}}
    <section class="py-20 md:py-24 bg-ink-50/60">
        <div class="container-page">
            <x-section-heading title="Cum te poți implica" subtitle="Fiecare gest contează. Alege cum vrei să fii parte din schimbare." />

            <div class="mt-14 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $paths = [
                        ['Donează','heart','brand','Sprijină programele noastre și ajută-ne să ajungem la mai mulți beneficiari.','Donează acum', route('donate'), 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800&auto=format&fit=crop&q=80'],
                        ['Devino voluntar','user-group','accent-yellow','Împărtășește din timpul și cunoștințele tale cu cei care au nevoie.','Află mai multe', route('volunteer'), 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=800&auto=format&fit=crop&q=80'],
                        ['Implică compania ta','briefcase','accent-green','Construim parteneriate care aduc educația mai aproape de comunități.','Colaborează cu noi', route('corporate'), 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&auto=format&fit=crop&q=80'],
                        ['Distribuie','share','accent-purple','Ajută-ne să răspândim mesajul și să conectăm mai mulți oameni.','Distribuie acum', '#', 'https://images.unsplash.com/photo-1573497491765-dccce02b29df?w=800&auto=format&fit=crop&q=80'],
                    ];
                @endphp
                @foreach ($paths as [$title,$icon,$color,$desc,$cta,$link,$img])
                    <div class="card overflow-hidden card-hover">
                        <div class="aspect-[4/3] bg-ink-100 relative">
                            <img src="{{ $img }}" alt="{{ $title }}" class="w-full h-full object-cover">
                            <div class="absolute -bottom-6 left-6"><x-icon-badge :icon="$icon" :color="$color" size="lg" /></div>
                        </div>
                        <div class="p-6 pt-10">
                            <h3 class="font-semibold text-ink-900 text-lg">{{ $title }}</h3>
                            <p class="mt-2 text-sm text-ink-500 leading-relaxed">{{ $desc }}</p>
                            <a href="{{ $link }}" class="mt-4 inline-flex items-center gap-1 text-sm font-semibold text-brand-700 hover:text-brand-800">
                                {{ $cta }} <x-heroicon name="arrow-right" class="w-4 h-4" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ POVEȘTI CARE INSPIRĂ ============ --}}
    <section class="py-20 md:py-24">
        <div class="container-page">
            <x-section-heading title="Povești care inspiră" subtitle="Oameni reali. Schimbări reale." />

            <div class="mt-14 grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($testimonials as $t)
                    <x-testimonial-card :testimonial="$t" />
                @empty
                    <div class="col-span-full text-center text-ink-400">Adaugă testimoniale în admin.</div>
                @endforelse
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('impact') }}" class="btn-secondary">Citește mai multe povești</a>
            </div>
        </div>
    </section>

    {{-- ============ ULTIMELE NOUTĂȚI ============ --}}
    @if ($latestNews->count())
        <section class="py-20 md:py-24 bg-ink-50/60">
            <div class="container-page">
                <div class="flex items-end justify-between mb-14 flex-wrap gap-4">
                    <x-section-heading title="Ultimele noutăți" align="left" />
                    <a href="{{ route('news.index') }}" class="btn-ghost">Toate noutățile <x-heroicon name="arrow-right" class="w-4 h-4" /></a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($latestNews as $article)
                        <x-news-card :article="$article" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ============ FINAL CTA (blue) ============ --}}
    <section class="relative bg-brand-700 text-white overflow-hidden">
        <div class="absolute inset-0 opacity-30" aria-hidden="true">
            <svg viewBox="0 0 800 400" class="w-full h-full">
                <g fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round">
                    <path d="M 40 300 L 200 200 L 360 260 L 520 160 L 680 240 L 760 180" />
                    <circle cx="200" cy="200" r="6" /><circle cx="360" cy="260" r="6" />
                    <circle cx="520" cy="160" r="6" /><circle cx="680" cy="240" r="6" />
                </g>
            </svg>
        </div>
        <div class="container-page py-20 md:py-24 relative grid lg:grid-cols-2 gap-10 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-semibold leading-tight">
                    {{ SiteSetting::get('final_cta_headline', 'Împreună putem deschide uși spre viitor.') }}
                </h2>
                <p class="mt-4 text-white/80 text-lg max-w-xl">
                    {{ SiteSetting::get('final_cta_description', 'Alătură-te comunității care face educația accesibilă pentru toți.') }}
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('involve') }}" class="btn-outline-white" data-testid="final-cta-involve">Implică-te acum</a>
                    <a href="{{ route('donate') }}" class="btn-white" data-testid="final-cta-donate">Donează</a>
                </div>
            </div>
        </div>
    </section>

</x-layouts.app>
