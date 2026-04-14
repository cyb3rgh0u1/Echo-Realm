@extends('layouts.client')
@section('title', $settings['hero_title'] ?? 'The Echo-Realm')
@push('styles')
<style>
    /* ============================================================
       DESIGN SYSTEM — OLD AESTHETIC, NEW STRUCTURE
       Dark / Cyber-Monolith + Scanner-Terminal theme
    ============================================================ */

    /* --- HERO --- */
    .hero {
        min-height: 100vh; display: flex; align-items: center; justify-content: center;
        position: relative; overflow: hidden; background: #050505;
        text-align: center; z-index: 10;
    }
    /* gradient orbs kept but toned to old palette */
    .hero-orb {
        position: absolute; border-radius: 50%; filter: blur(120px);
        pointer-events: none; animation: orbFloat 10s ease-in-out infinite;
    }
    .hero-orb-1 { width: 600px; height: 600px; background: rgba(168,85,247,0.06); top: -150px; left: -150px; animation-delay: 0s; }
    .hero-orb-2 { width: 500px; height: 500px; background: rgba(245,158,11,0.04); bottom: -120px; right: -80px; animation-delay: -5s; }
    @keyframes orbFloat { 0%,100%{transform:translateY(0) scale(1)} 50%{transform:translateY(-25px) scale(1.04)} }

    .hero-content { position: relative; z-index: 10; max-width: 900px; padding: 0 2rem; }
    .hero-eyebrow {
        font-family: var(--font-heading); font-size: 0.7rem; letter-spacing: 0.6em;
        text-transform: uppercase; color: var(--accent); margin-bottom: 2rem;
        animation: fadeUp 1s ease 0.2s both;
    }
    .hero-title {
        font-family: var(--font-display); font-size: clamp(3rem, 8vw, 6.5rem);
        font-weight: 900; line-height: 0.9; margin-bottom: 2rem; color: #fff;
        animation: fadeUp 1s ease 0.4s both;
    }
    .hero-title span {
        background: linear-gradient(90deg, #fff, var(--accent), var(--gold));
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text; display: block;
    }
    .hero-sub {
        color: var(--text-muted); font-size: 1.1rem; max-width: 600px;
        margin: 0 auto 3rem; line-height: 1.8; opacity: 0.8;
        animation: fadeUp 1s ease 0.6s both;
    }
    .hero-actions {
        display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap;
        animation: fadeUp 1s ease 0.8s both;
    }
    .hero-actions .btn { padding: 1.2rem 3.5rem; }
    .hero-scroll {
        position: absolute; bottom: 3rem; left: 50%; transform: translateX(-50%);
        z-index: 30; display: flex; flex-direction: column; align-items: center; gap: 1rem;
    }
    .scroll-line { width: 1px; height: 60px; background: linear-gradient(to bottom, var(--accent), transparent); }
    @keyframes fadeUp { from{opacity:0;transform:translateY(40px)} to{opacity:1;transform:translateY(0)} }

    /* --- BANNER STRIP (TELEMETRY) --- */
    .banner-strip {
        position: relative; z-index: 5; background: #000;
        border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);
        overflow: hidden; padding: 1.25rem 0;
    }
    .banner-track {
        display: flex; gap: 6rem; white-space: nowrap;
        animation: marquee 40s linear infinite; will-change: transform;
    }
    .banner-item {
        font-family: var(--font-heading); font-size: 0.65rem; letter-spacing: 0.25em;
        text-transform: uppercase; color: var(--text-muted);
        display: flex; align-items: center; gap: 0.75rem;
    }
    .banner-dot {
        width: 4px; height: 4px; border-radius: 50%;
        background: var(--accent); box-shadow: 0 0 8px var(--accent); flex-shrink: 0;
    }
    @keyframes marquee { from{transform:translateX(0)} to{transform:translateX(-50%)} }

    /* --- ELEMENT PILLS --- */
    .elements-strip { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }
    .element-pill {
        display: flex; align-items: center; gap: 0.6rem; padding: 0.6rem 1.25rem;
        border-radius: 3px; border: 1px solid; font-family: var(--font-heading);
        font-size: 0.65rem; letter-spacing: 0.25em; text-transform: uppercase;
        text-decoration: none; transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
    }
    .element-pill:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(0,0,0,0.5); }

    /* --- CHARACTER CARDS --- */
    .char-grid {
        display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem; align-items: stretch;
    }
    .char-card {
        background: rgba(255,255,255,0.02); border: 1px solid var(--border);
        border-radius: 4px; display: flex; flex-direction: column; height: 100%;
        transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1); overflow: hidden;
        position: relative; cursor: pointer;
    }
    .char-card::before {
        content: ''; position: absolute; inset: 0; opacity: 0;
        transition: opacity 0.4s;
        background: linear-gradient(135deg, rgba(168,85,247,0.04), transparent);
    }
    .char-card:hover {
        border-color: var(--accent); transform: translateY(-10px);
        background: rgba(255,255,255,0.04); box-shadow: 0 30px 60px rgba(0,0,0,0.6);
    }
    .char-card:hover::before { opacity: 1; }
    .char-img-wrap {
        aspect-ratio: 3/4; overflow: hidden; background: #000;
        position: relative; flex-shrink: 0;
    }
    .char-img-placeholder {
        width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;
        font-size: 5rem; position: relative;
    }
    .char-img-placeholder::after {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(5,5,5,0.9), transparent 60%);
    }
    /* scanner line on card image */
    .scanner-line {
        position: absolute; top: 0; left: 0; width: 100%; height: 2px;
        background: var(--accent); opacity: 0.4; z-index: 5;
        animation: scan 4s linear infinite;
    }
    @keyframes scan { 0%{top:0} 100%{top:100%} }
    .char-element-badge {
        position: absolute; top: 1rem; right: 1rem; z-index: 10;
        background: rgba(0,0,0,0.8); padding: 0.4rem 0.8rem; border-radius: 2px;
        font-family: var(--font-heading); font-size: 0.55rem; letter-spacing: 0.1em;
        text-transform: uppercase; border: 1px solid currentColor;
    }
    .char-body {
        padding: 1.75rem; display: flex; flex-direction: column;
        flex-grow: 1; position: relative; z-index: 2;
    }
    .char-meta {
        display: flex; justify-content: space-between; align-items: center;
        margin-bottom: 0.5rem;
    }
    .char-file-id { font-family: var(--font-heading); font-size: 0.6rem; color: var(--accent); }
    .char-name { font-family: var(--font-heading); font-size: 1.2rem; font-weight: 700; color: #fff; margin-bottom: 0.25rem; }
    .char-title-sub { color: var(--text-muted); font-size: 0.75rem; font-style: italic; margin-bottom: 0.5rem; }
    .char-bio { font-size: 0.85rem; color: var(--text-muted); line-height: 1.6; flex-grow: 1; margin-bottom: 1.5rem; }
    .char-footer {
        margin-top: auto; padding-top: 1.5rem;
        border-top: 1px solid rgba(255,255,255,0.05);
        display: flex; justify-content: space-between; align-items: center;
    }
    .char-role-label {
        font-family: var(--font-heading); font-size: 0.6rem; letter-spacing: 0.15em;
        text-transform: uppercase; color: var(--text-dim);
    }
    .char-link {
        display: flex; align-items: center; gap: 0.5rem; text-decoration: none;
        color: #fff; font-family: var(--font-heading); font-size: 0.7rem; letter-spacing: 0.15em;
        transition: color 0.2s;
    }
    .char-link:hover { color: var(--accent); }

    /* --- STORY PREVIEW --- */
    .story-preview {
        padding: 4rem;
        background: rgba(255,255,255,0.01); border: 1px solid var(--border);
        border-left: 4px solid var(--gold); border-radius: 4px;
        display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;
    }
    .story-arc {
        font-family: var(--font-heading); font-size: 0.6rem; letter-spacing: 0.4em;
        text-transform: uppercase; color: var(--gold); margin-bottom: 1rem;
    }
    .story-title {
        font-family: var(--font-display); font-size: 2.5rem;
        color: #fff; margin-bottom: 1.5rem; line-height: 1.1;
    }
    .story-synopsis { color: var(--text-muted); line-height: 1.8; margin-bottom: 2.5rem; opacity: 0.8; }
    .story-visual {
        background: rgba(255,255,255,0.01); border: 1px solid var(--border);
        border-radius: 4px; aspect-ratio: 4/3;
        display: flex; align-items: center; justify-content: center;
        font-size: 6rem; opacity: 0.15;
    }

    /* --- LORE CARDS --- */
    .lore-card {
        padding: 1.5rem 1.75rem; position: relative; overflow: hidden;
        background: rgba(255,255,255,0.02); border: 1px solid var(--border);
        border-radius: 4px; text-decoration: none; color: inherit; display: block;
        transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
    }
    .lore-card::after {
        content: ''; position: absolute; top: 0; left: 0;
        width: 3px; height: 100%; background: var(--accent);
    }
    .lore-card:hover { border-color: var(--accent); transform: translateY(-4px); background: rgba(255,255,255,0.04); }
    .lore-category {
        font-family: var(--font-heading); font-size: 0.6rem; letter-spacing: 0.3em;
        text-transform: uppercase; margin-bottom: 0.5rem;
    }
    .lore-title { font-family: var(--font-heading); font-size: 1rem; font-weight: 600; margin-bottom: 0.5rem; line-height: 1.3; color: #fff; }
    .lore-excerpt {
        color: var(--text-muted); font-size: 0.82rem; line-height: 1.6;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }
    .lore-meta {
        display: flex; align-items: center; gap: 1rem; margin-top: 1rem;
        color: var(--text-dim); font-size: 0.72rem;
        font-family: var(--font-heading); letter-spacing: 0.05em;
    }

    /* --- SHOP CARDS --- */
    .shop-card {
        background: rgba(255,255,255,0.02); border: 1px solid var(--border);
        border-radius: 4px; display: flex; flex-direction: column;
        transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1); overflow: hidden;
    }
    .shop-card:hover { border-color: var(--accent); transform: translateY(-10px); box-shadow: 0 30px 60px rgba(0,0,0,0.6); }
    .shop-img {
        aspect-ratio: 16/9; background: #000;
        display: flex; align-items: center; justify-content: center;
        font-size: 4rem; position: relative; overflow: hidden;
    }
    .shop-discount {
        position: absolute; top: 1rem; left: 1rem; background: var(--red); color: #fff;
        font-family: var(--font-heading); font-size: 0.6rem; padding: 2px 6px;
        border-radius: 2px; font-weight: 700;
    }
    .shop-featured-tag {
        position: absolute; top: 1rem; right: 1rem; background: var(--gold); color: #000;
        font-family: var(--font-heading); font-size: 0.6rem; letter-spacing: 0.1em;
        padding: 2px 6px; border-radius: 2px; font-weight: 700; text-transform: uppercase;
    }
    .shop-body { padding: 1.75rem; flex: 1; display: flex; flex-direction: column; }
    .shop-type { font-family: var(--font-heading); font-size: 0.55rem; color: var(--accent); letter-spacing: 0.2em; text-transform: uppercase; margin-bottom: 0.4rem; }
    .shop-name { font-family: var(--font-heading); font-size: 1rem; font-weight: 600; color: #fff; margin-bottom: 0.5rem; }
    .shop-desc {
        color: var(--text-muted); font-size: 0.78rem; line-height: 1.5; flex: 1;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
        overflow: hidden; margin-bottom: 1.25rem;
    }
    .shop-pricing { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.25rem; }
    .price-current { font-family: var(--font-display); font-size: 1.4rem; color: #fff; }
    .price-old { color: var(--text-dim); font-size: 0.85rem; text-decoration: line-through; }

    /* --- CTA --- */
    .cta-block {
        text-align: center; padding: 6rem 2rem;
        background: #000; border: 1px solid var(--border);
        border-radius: 4px; position: relative; overflow: hidden;
    }
    .cta-block::before {
        content: ''; position: absolute; inset: 0;
        background: radial-gradient(circle at center, rgba(168,85,247,0.1), transparent 70%);
        pointer-events: none;
    }

    /* --- RESPONSIVE --- */
    @media(max-width: 768px) {
        .story-preview { grid-template-columns: 1fr; padding: 2rem; }
        .story-visual { display: none; }
        .hero-title { font-size: 3rem; }
        .hero-actions .btn { padding: 1rem 2rem; }
    }
</style>
@endpush

@section('content')

@php
    $svgs = [
        'profile' => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle>',
        'read'    => '<path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h9z"></path>',
        'cart'    => '<circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>',
        'arrow'   => '<path d="M5 12h14m-7-7l7 7-7 7"></path>',
    ];

    // Hero settings (new code functionality)
    $bgType    = $settings['hero_bg_type']    ?? 'gradient';
    $bgImage   = $settings['hero_bg_image']   ?? '';
    $bgVideo   = $settings['hero_bg_video']   ?? '';
    $bgOverlay = $settings['hero_bg_overlay'] ?? '0.55';
    $eyebrow   = $settings['hero_eyebrow']    ?? 'Decrypting Resonance Data';
    $heroTitle = $settings['hero_title']      ?? 'The Echo-Realm';
    $heroSub   = $settings['hero_title_sub']  ?? 'Shattered Reality';
    $heroPara  = $settings['hero_subtitle']   ?? 'Step into a universe where cosmic elements collide. Decrypt the past, forge your signature, and survive the resonance.';
    $btn1Text  = $settings['hero_btn1_text']  ?? 'GET THE GAME';
    $btn1Url   = $settings['hero_btn1_url']   ?? url('shop?type=game');
    $btn2Text  = $settings['hero_btn2_text']  ?? 'EXPLORE LORE';
    $btn2Url   = $settings['hero_btn2_url']   ?? url('story');
@endphp

{{-- ============================================================
     HERO SECTION (SYSTEM INITIALIZATION VERSION)
============================================================ --}}
<section class="hero" id="hero-container" style="background: #000;">

    {{-- Background layer --}}
    @if($bgType === 'image' && $bgImage)
        <div style="position:absolute;inset:0;z-index:0">
            <img src="{{ asset('storage/'.$bgImage) }}" alt="" style="width:100%;height:100%;object-fit:cover;display:block">
            <div style="position:absolute;inset:0;background:rgba(0,0,0,{{ $bgOverlay }})"></div>
        </div>
    @elseif($bgType === 'video' && $bgVideo)
        <div style="position:absolute;inset:0;z-index:0;overflow:hidden;background:#000;">
            {{-- Video is hidden until user clicks initialize --}}
            <video id="heroVideo" 
                   loop 
                   playsinline 
                   preload="auto"
                   style="width:100%;height:100%;object-fit:cover;opacity:0;transition:opacity 1.5s ease;">
                <source src="{{ asset('storage/'.$bgVideo) }}" type="video/mp4">
            </video>
            {{-- Dark Overlay --}}
            <div style="position:absolute;inset:0;background:rgba(0,0,0,{{ $bgOverlay }});z-index:1;"></div>
        </div>

        {{-- THE GATEKEEPER: This overlay allows audio to play --}}
        <div id="video-init-overlay" style="position:absolute;inset:0;z-index:100;background:#050505;display:flex;align-items:center;justify-content:center;flex-direction:column;gap:1.5rem;transition:all 0.8s ease;">
            <div class="scanner-line" style="height:1px;opacity:0.3;background:var(--accent)"></div>
            <p class="hero-eyebrow" style="margin:0;animation:pulse 2s infinite;color:var(--accent)">
                [ STATUS: ENCRYPTED ]
            </p>
            <button id="init-btn" class="btn btn-gold" style="padding:1.2rem 3rem; letter-spacing:0.3em; cursor:pointer; position:relative; z-index:101;">
                INITIALIZE RESONANCE
            </button>
        </div>
    @else
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>
    @endif

    {{-- Hero Content: Hidden initially if video is present --}}
    <div class="hero-content" id="hero-text-content" style="{{ ($bgType === 'video') ? 'opacity:0;transform:translateY(30px);' : '' }} transition: all 1s cubic-bezier(0.23, 1, 0.32, 1) 0.5s;">
        <p class="hero-eyebrow">{{ $eyebrow }}</p>
        <h1 class="hero-title">
            {{ $heroTitle }}
            <span>{{ $heroSub }}</span>
        </h1>
        <p class="hero-sub">{{ $heroPara }}</p>
        <div class="hero-actions">
            <a href="{{ $btn1Url }}" class="btn btn-gold">{{ $btn1Text }}</a>
            <a href="{{ $btn2Url }}" class="btn btn-outline">{{ $btn2Text }}</a>
        </div>
    </div>

    <div class="hero-scroll">
        <div class="scroll-line"></div>
        <span style="font-family:var(--font-heading);font-size:0.6rem;letter-spacing:0.3em;color:var(--text-dim)">SYSTEM_SCROLL</span>
    </div>
</section>

@push('styles')
<style>
    @keyframes pulse {
        0%, 100% { opacity: 0.3; transform: scale(0.98); }
        50% { opacity: 1; transform: scale(1); }
    }
    #hero-container { position: relative; min-height: 100vh; display: flex; align-items: center; justify-content: center; overflow: hidden; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const video = document.getElementById('heroVideo');
    const initBtn = document.getElementById('init-btn');
    const overlay = document.getElementById('video-init-overlay');
    const heroContent = document.getElementById('hero-text-content');

    // If there's no video/button (image mode), reveal content immediately
    if (!initBtn || !video) {
        if(heroContent) {
            heroContent.style.opacity = '1';
            heroContent.style.transform = 'translateY(0)';
        }
        return;
    }

    // Attempt to handle the click
    initBtn.addEventListener('click', function(e) {
        e.preventDefault();
        
        // 1. Play Video with Audio (Allowed because of the click event)
        video.play().then(() => {
            // 2. Visual transitions
            video.style.opacity = '1';
            overlay.style.opacity = '0';
            overlay.style.pointerEvents = 'none';

            // 3. Show the Hero Text
            setTimeout(() => {
                overlay.style.display = 'none';
                if(heroContent) {
                    heroContent.style.opacity = '1';
                    heroContent.style.transform = 'translateY(0)';
                }
            }, 800);
        }).catch(error => {
            console.error("Playback failed. Check if file exists at path:", video.querySelector('source').src);
            alert("Error: Data file could not be read. Check console (F12).");
        });
    });
});
</script>
@endpush

{{-- ============================================================
     BANNER STRIP (TELEMETRY)
============================================================ --}}
<div class="banner-strip">
    <div class="banner-track">
        @foreach([
            ['◆','6 Unique Elements'],['◆','Rich Story Arcs'],['◆','Deep Lore Tomes'],
            ['◆','Cryptic Timeline'], ['◆','Epic Characters'],['◆','The 7th Pillar Awaits'],
            ['◆','6 Unique Elements'],['◆','Rich Story Arcs'],['◆','Deep Lore Tomes'],
            ['◆','Cryptic Timeline'], ['◆','Epic Characters'],['◆','The 7th Pillar Awaits'],
        ] as [$dot, $text])
            <div class="banner-item">
                <span class="banner-dot"></span>
                RESONANCE DETECTED: {{ strtoupper($text) }}
            </div>
            <div class="banner-item" style="opacity:0.4;">SYSTEM STATUS: OPTIMAL</div>
        @endforeach
    </div>
</div>

{{-- ============================================================
     ELEMENTS
============================================================ --}}
<section class="section-sm">
    <div class="container" style="text-align:center">
        <p class="section-label">The Six Elements</p>
        <h2 class="section-title" style="margin-bottom:2rem">Choose Your Resonance</h2>
        <div class="elements-strip">
            @foreach(\App\Models\Element::all() as $el)
                <a href="{{ route('characters.index') }}?element={{ $el->id }}"
                   class="element-pill"
                   style="color:{{ $el->color }};border-color:{{ $el->color }}55;background:{{ $el->color }}0d">
                    <span>{{ $el->symbol }}</span>{{ $el->name }}
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     FEATURED CHARACTERS
============================================================ --}}
@if($featuredCharacters->count())
<section class="section">
    <div class="container">
        <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:4rem" class="reveal">
            <div>
                <p class="section-label">Personnel Manifest</p>
                <h2 class="section-title">The Active Echoes</h2>
                <p class="section-subtitle">Each character carries a piece of the shattered Resonance within them.</p>
            </div>
            <a href="{{ route('characters.index') }}" class="btn btn-outline btn-sm">VIEW ALL FILES</a>
        </div>

        <div class="char-grid">
            @foreach($featuredCharacters as $i => $char)
            <div class="char-card reveal" style="transition-delay:{{ $i * 0.1 }}s">

                {{-- Image --}}
                <div class="char-img-wrap">
                    <div class="scanner-line"></div>
                    @if($char->image)
                        <img src="{{ asset('storage/'.$char->image) }}" alt="{{ $char->name }}"
                             style="width:100%;height:100%;object-fit:cover">
                    @else
                        <div class="char-img-placeholder">
                            {{ $char->element ? $char->element->symbol : '⚔️' }}
                        </div>
                    @endif
                    @if($char->element)
                        <div class="char-element-badge"
                             style="color:{{ $char->element->color }};border-color:{{ $char->element->color }}">
                            {{ $char->element->symbol }} {{ $char->element->name }}
                        </div>
                    @endif
                </div>

                {{-- Body --}}
                <div class="char-body">
                    <div class="char-meta">
                        <span class="char-file-id">FILE_{{ $char->id }}</span>
                        <span class="badge badge-{{ $char->rarity }}" style="font-size:0.55rem">{{ strtoupper($char->rarity) }}</span>
                    </div>
                    <div class="char-name">{{ $char->name }}</div>
                    @if($char->title)
                        <div class="char-title-sub">{{ $char->title }}</div>
                    @endif
                    <p class="char-bio">{{ Str::limit($char->bio, 110) }}</p>

                    <div class="char-footer">
                        <span class="char-role-label">{{ ucfirst($char->role ?? '') }}</span>
                        <a href="{{ route('characters.show', $char->slug) }}" class="char-link">
                            DECRYPT PROFILE
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">{!! $svgs['arrow'] !!}</svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ============================================================
     STORY PREVIEW
============================================================ --}}
@if($latestStory)
<section class="section">
    <div class="container">
        <div class="story-preview reveal">
            <div>
                <p class="story-arc">ARC_{{ $latestStory->arc_number }} // CHAPTER_{{ $latestStory->chapter_number }} // LATEST_FILE</p>
                <h2 class="story-title">{{ $latestStory->title }}</h2>
                <p class="story-synopsis">{{ $latestStory->synopsis }}</p>
                <div style="display:flex;gap:1.5rem;flex-wrap:wrap">
                    <a href="{{ route('story.show', $latestStory->slug) }}" class="btn btn-gold">READ CHAPTER</a>
                    <a href="{{ route('story.index') }}" class="btn btn-outline">FULL ARCHIVE</a>
                </div>
            </div>
            <div class="story-visual">
                <svg width="200" height="200" viewBox="0 0 24 24" fill="none"
                     stroke="var(--gold)" stroke-width="0.5">{!! $svgs['read'] !!}</svg>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ============================================================
     LORE TOMES
============================================================ --}}
@if($latestLore->count())
<section class="section">
    <div class="container">
        <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:4rem" class="reveal">
            <div>
                <p class="section-label">Cryptic Archives</p>
                <h2 class="section-title">The Lore Tomes</h2>
                <p class="section-subtitle">Fragments of truth scattered across the Echo-Realm.</p>
            </div>
            <a href="{{ route('lore.index') }}" class="btn btn-outline btn-sm">ALL TOMES</a>
        </div>
        <div class="grid-3">
            @foreach($latestLore as $i => $entry)
                @php
                    $cColor = match($entry->classification) {
                        'top_secret' => 'var(--red)',
                        'classified' => 'var(--gold)',
                        default      => 'var(--accent)',
                    };
                @endphp
                <a href="{{ route('lore.show', $entry->slug) }}"
                   class="lore-card reveal"
                   style="transition-delay:{{ $i * 0.1 }}s">
                    <div class="lore-category" style="color:{{ $cColor }}">
                        {{ str_replace('_', ' ', strtoupper($entry->category)) }}
                    </div>
                    <div class="lore-title">{{ $entry->title }}</div>
                    <p class="lore-excerpt">{{ $entry->excerpt }}</p>
                    <div class="lore-meta">
                        <span>{{ $entry->read_time }} min read</span>
                        <span>·</span>
                        <span style="color:{{ $cColor }}">{{ str_replace('_', ' ', strtoupper($entry->classification)) }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ============================================================
     SHOP FEATURED
============================================================ --}}
@if($featuredShop->count())
<section class="section">
    <div class="container">
        <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:4rem" class="reveal">
            <div>
                <p class="section-label">Acquisition Node</p>
                <h2 class="section-title">Featured Items</h2>
                <p class="section-subtitle">Power. Cosmetics. Lore. Everything the Echo-Realm offers.</p>
            </div>
            <a href="{{ route('shop.index') }}" class="btn btn-outline btn-sm">ALL ITEMS</a>
        </div>

        <div class="grid-4">
            @foreach($featuredShop as $i => $item)
            @php
                $icons = ['game'=>'🎮','character'=>'⚔️','skin'=>'✨','bundle'=>'📦','currency'=>'💎','consumable'=>'⚗️','cosmetic'=>'🎭'];
            @endphp
            <div class="shop-card reveal" style="transition-delay:{{ $i * 0.1 }}s">
                <div class="shop-img">
                    @if($item->image)
                        <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->name }}"
                             style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;opacity:0.7">
                    @else
                        {{ $icons[$item->type] ?? '🎮' }}
                    @endif
                    @if($item->discount_percent)
                        <span class="shop-discount">-{{ $item->discount_percent }}%</span>
                    @endif
                    @if($item->is_featured)
                        <span class="shop-featured-tag">Featured</span>
                    @endif
                </div>
                <div class="shop-body">
                    <div class="shop-type">{{ $item->type }}</div>
                    <div class="shop-name">{{ $item->name }}</div>
                    <p class="shop-desc">{{ $item->description }}</p>
                    <div class="shop-pricing">
                        <span class="price-current">${{ number_format($item->price, 2) }}</span>
                        @if($item->original_price)
                            <span class="price-old">${{ number_format($item->original_price, 2) }}</span>
                        @endif
                    </div>
                    <form action="{{ route('cart.add') }}" method="POST" style="margin:0">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <button type="submit" class="btn btn-gold" style="width:100%;justify-content:center;gap:10px">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">{!! $svgs['cart'] !!}</svg>
                            ACQUIRE
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ============================================================
     CTA BANNER
============================================================ --}}
<section class="section" style="padding-bottom:10rem">
    <div class="container">
        <div class="cta-block reveal">
            <p class="section-label" style="position:relative">Final Warning</p>
            <h2 class="section-title"
                style="position:relative;font-size:clamp(2rem,5vw,4rem);line-height:1;margin-bottom:1.5rem">
                The Seventh Pillar
                <br><span style="color:var(--text-dim);font-size:0.6em">Is Waiting</span>
            </h2>
            <p style="position:relative;color:var(--text-muted);max-width:550px;margin:0 auto 3rem;opacity:0.8">
                The resonance is shifting. Will you be a witness to the collapse, or the one who survives it?
            </p>
            <a href="{{ route('shop.index') }}?type=game"
               class="btn btn-gold"
               style="position:relative;padding:1.4rem 4rem;font-size:1rem">
                BEGIN YOUR JOURNEY
            </a>
        </div>
    </div>
</section>

@endsection