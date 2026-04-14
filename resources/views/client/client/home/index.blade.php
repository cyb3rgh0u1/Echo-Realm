@extends('layouts.client')
@section('title', $settings['hero_title'] ?? 'The Echo-Realm')

@push('styles')
<style>
    /* --- LAYER HIERARCHY & ARCHITECTURE --- */
    .hero { 
        min-height: 100vh; display: flex; align-items: center; justify-content: center; 
        position: relative; overflow: hidden; background: #050505; z-index: 10;
    }
    
    .section { position: relative; z-index: 20; background: transparent; }

    /* --- FIXED SYSTEM SCROLL (TELEMETRY) --- */
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
        text-transform: uppercase; color: var(--text-muted); display: flex; align-items: center; gap: 0.75rem;
    }
    @keyframes marquee {
        from { transform: translateX(0); }
        to { transform: translateX(-50%); }
    }

    /* --- ARCHIVE LOGO POSITIONING --- */
    .arch-logo-wrap {
        position: absolute; top: 3rem; left: 3rem; display: flex; 
        align-items: center; gap: 15px; z-index: 100; pointer-events: none; opacity: 0.6;
    }
    .arch-logo-text {
        font-family: var(--font-heading); font-size: 0.6rem; letter-spacing: 0.4em;
        text-transform: uppercase; color: var(--text-dim);
    }

    /* --- CHARACTER CARD STABILITY --- */
    .char-grid { 
        display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); 
        gap: 2rem; align-items: stretch; 
    }
    .char-card {
        background: rgba(255,255,255,0.02); border: 1px solid var(--border);
        border-radius: 4px; display: flex; flex-direction: column; height: 100%;
        transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
    }
    .char-card:hover {
        border-color: var(--accent); transform: translateY(-10px);
        background: rgba(255,255,255,0.04); box-shadow: 0 30px 60px rgba(0,0,0,0.6);
    }
    .char-body { padding: 1.75rem; display: flex; flex-direction: column; flex-grow: 1; }
    .char-footer {
        margin-top: auto; padding-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.05);
    }

    /* --- HERO ELEMENTS --- */
    .hero-title {
        font-family: var(--font-display); font-size: clamp(3rem, 8vw, 6.5rem);
        font-weight: 900; line-height: 0.9; margin-bottom: 2rem; color: #fff;
    }
    .hero-title span {
        background: linear-gradient(90deg, #fff, var(--accent), var(--gold));
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: block;
    }
    .hero-scroll {
        position: absolute; bottom: 3rem; left: 50%; transform: translateX(-50%);
        z-index: 30; display: flex; flex-direction: column; align-items: center; gap: 1rem;
    }
    .scroll-line { width: 1px; height: 60px; background: linear-gradient(to bottom, var(--accent), transparent); }

    /* --- SCANNER ANIMATION --- */
    .scanner-line {
        position: absolute; top: 0; left: 0; width: 100%; height: 2px;
        background: var(--accent); opacity: 0.4; z-index: 5; animation: scan 4s linear infinite;
    }
    @keyframes scan { 0% { top: 0; } 100% { top: 100%; } }
</style>
@endpush

@section('content')

@php
    $svgs = [
        'arch' => '<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>',
        'bolt' => '<path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path>',
        'read' => '<path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h9z"></path>',
        'cart' => '<circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>',
        'profile' => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle>'
    ];
@endphp



<section class="hero">
    <div class="hero-content" style="text-align: center; position: relative; z-index: 10;">
        <p style="font-family:var(--font-heading); font-size:0.7rem; letter-spacing:0.6em; text-transform:uppercase; color:var(--accent); margin-bottom:2rem;">
            Decrypting Resonance Data
        </p>
        <h1 class="hero-title">
            {{ $settings['hero_title'] ?? 'The Echo-Realm' }}
            <span>Shattered Reality</span>
        </h1>
        <p style="color:var(--text-muted); font-size:1.1rem; max-width:600px; margin:0 auto 3rem; line-height:1.8; opacity:0.8;">
            Step into a universe where cosmic elements collide. Decrypt the past, forge your signature, and survive the resonance.
        </p>
        <div style="display:flex; gap:1.5rem; justify-content:center;">
            <a href="{{ route('shop.index') }}?type=game" class="btn btn-gold" style="padding:1.2rem 3.5rem;">GET THE GAME</a>
            <a href="{{ route('story.index') }}" class="btn btn-outline" style="padding:1.2rem 3.5rem;">EXPLORE LORE</a>
        </div>
    </div>
    <div class="hero-scroll">
        <div class="scroll-line"></div>
        <span style="font-family:var(--font-heading); font-size:0.6rem; letter-spacing:0.3em; color:var(--text-dim);">SYSTEM_SCROLL</span>
    </div>
</section>

<div class="banner-strip">
    <div class="banner-track">
        @php
            $telemetry = ['VOID', 'CRYSTAL', 'STORM', 'VERDANCE', 'ASHEN', 'NULL'];
        @endphp
        @for($i = 0; $i < 4; $i++)
            @foreach($telemetry as $t)
                <div class="banner-item">
                    <span style="width:4px; height:4px; border-radius:50%; background:var(--accent); box-shadow:0 0 8px var(--accent)"></span>
                    RESONANCE DETECTED: {{ $t }}
                </div>
                <div class="banner-item" style="opacity:0.4;">SYSTEM STATUS: OPTIMAL</div>
            @endforeach
        @endfor
    </div>
</div>

<section class="section">
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:4rem;">
            <div>
                <p class="section-label">Personnel Manifest</p>
                <h2 class="section-title">The Active Echoes</h2>
            </div>
            <a href="{{ route('characters.index') }}" class="btn btn-outline btn-sm">VIEW ALL FILES</a>
        </div>
        
        <div class="char-grid">
            @foreach($featuredCharacters as $char)
            <div class="char-card reveal">
                <div class="char-img-wrap" style="aspect-ratio:3/4; overflow:hidden; background:#000; position:relative; flex-shrink:0;">
                    <div class="scanner-line"></div>
                    @if($char->image)
                        <img src="{{ asset('storage/'.$char->image) }}" style="width:100%; height:100%; object-fit:cover;">
                    @else
                        <div style="height:100%; display:flex; align-items:center; justify-content:center; opacity:0.1;">
                            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">{!! $svgs['profile'] !!}</svg>
                        </div>
                    @endif
                    <div style="position:absolute; top:1rem; right:1rem; background:rgba(0,0,0,0.8); padding:0.4rem 0.8rem; border-radius:2px; font-family:var(--font-heading); font-size:0.55rem; color:{{ $char->element->color ?? 'var(--accent)' }}; border:1px solid currentColor; z-index:10;">
                        {{ $char->element->name ?? 'Neutral' }}
                    </div>
                </div>
                
                <div class="char-body">
                    <div style="display:flex; justify-content:space-between; margin-bottom:0.5rem;">
                        <span style="font-family:var(--font-heading); font-size:0.6rem; color:var(--accent);">FILE_{{ $char->id }}</span>
                        <span class="badge badge-{{ $char->rarity }}" style="font-size:0.55rem;">{{ strtoupper($char->rarity) }}</span>
                    </div>
                    <div style="font-family:var(--font-heading); font-size:1.2rem; font-weight:700; color:#fff; margin-bottom:0.5rem;">{{ $char->name }}</div>
                    <p style="font-size:0.85rem; color:var(--text-muted); line-height:1.6; margin-bottom:1.5rem; flex-grow:1;">
                        {{ Str::limit($char->bio, 110) }}
                    </p>
                    <div class="char-footer">
                        <a href="{{ route('characters.show', $char->slug) }}" style="display:flex; justify-content:space-between; align-items:center; text-decoration:none; color:#fff; font-family:var(--font-heading); font-size:0.7rem; letter-spacing:0.15em;">
                            DECRYPT PROFILE
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-7-7l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@if($latestStory)
<section class="section">
    <div class="container">
        <div style="padding:4rem; background:rgba(255,255,255,0.01); border:1px solid var(--border); border-left:4px solid var(--gold); border-radius:4px; display:grid; grid-template-columns: 1fr 1fr; gap:4rem; align-items:center;" class="reveal">
            <div>
                <p style="font-family:var(--font-heading); font-size:0.6rem; letter-spacing:0.4em; color:var(--gold); margin-bottom:1rem;">ARC_{{ $latestStory->arc_number }} // LATEST_FILE</p>
                <h2 style="font-family:var(--font-display); font-size:2.5rem; color:#fff; margin-bottom:1.5rem; line-height:1.1;">{{ $latestStory->title }}</h2>
                <p style="color:var(--text-muted); line-height:1.8; margin-bottom:2.5rem; opacity:0.8;">{{ $latestStory->synopsis }}</p>
                <div style="display:flex; gap:1.5rem;">
                    <a href="{{ route('story.show', $latestStory->slug) }}" class="btn btn-gold">READ CHAPTER</a>
                    <a href="{{ route('story.index') }}" class="btn btn-outline">FULL ARCHIVE</a>
                </div>
            </div>
            <div style="text-align: center; opacity: 0.1;">
                <svg width="250" height="250" viewBox="0 0 24 24" fill="none" stroke="var(--gold)" stroke-width="0.5">{!! $svgs['read'] !!}</svg>
            </div>
        </div>
    </div>
</section>
@endif

@if($featuredShop->count())
<section class="section">
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:4rem;">
            <div>
                <p class="section-label">Acquisition Node</p>
                <h2 class="section-title">Featured Items</h2>
            </div>
            <a href="{{ route('shop.index') }}" class="btn btn-outline btn-sm">ALL ITEMS</a>
        </div>
        
        <div class="grid-4">
            @foreach($featuredShop as $item)
            <div class="char-card reveal">
                <div style="aspect-ratio:16/9; background:#000; display:flex; align-items:center; justify-content:center; overflow:hidden; position:relative;">
                    @if($item->image)
                        <img src="{{ asset('storage/'.$item->image) }}" style="width:100%; height:100%; object-fit:cover; opacity:0.7;">
                    @else
                        <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="opacity:0.1;">{!! $svgs['cart'] !!}</svg>
                    @endif
                    @if($item->discount_percent)
                        <span style="position:absolute; top:1rem; left:1rem; background:var(--red); color:#fff; font-family:var(--font-heading); font-size:0.6rem; padding:2px 6px; border-radius:2px;">-{{ $item->discount_percent }}%</span>
                    @endif
                </div>
                <div class="char-body">
                    <span style="font-family:var(--font-heading); font-size:0.55rem; color:var(--accent); letter-spacing:0.2em; text-transform:uppercase;">{{ $item->type }}</span>
                    <div style="font-family:var(--font-heading); font-size:1rem; font-weight:600; color:#fff; margin:0.5rem 0 1.25rem;">{{ $item->name }}</div>
                    
                    <div style="margin-top:auto;">
                        <div style="font-family:var(--font-display); font-size:1.4rem; color:#fff; margin-bottom:1.25rem;">
                            ${{ number_format($item->price,2) }}
                        </div>
                        <form action="{{ route('cart.add') }}" method="POST" style="margin:0;">
                            @csrf
                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                            <button type="submit" class="btn btn-gold" style="width:100%; justify-content:center; gap:10px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">{!! $svgs['cart'] !!}</svg>
                                ACQUIRE
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="section" style="padding-bottom: 10rem;">
    <div class="container">
        <div class="reveal" style="text-align:center; padding:6rem 2rem; background:#000; border:1px solid var(--border); border-radius:4px; position:relative; overflow:hidden;">
            <div style="position:absolute; inset:0; background:radial-gradient(circle at center, rgba(168,85,247,0.1), transparent 70%);"></div>
            <p class="section-label">Final Warning</p>
            <h2 class="section-title" style="font-size: clamp(2rem, 5vw, 4rem); line-height:1; margin-bottom:1.5rem;">The Seventh Pillar <br><span style="color:var(--text-dim); font-size:0.6em;">Is Waiting</span></h2>
            <p style="color:var(--text-muted); max-width:550px; margin:0 auto 3rem; opacity:0.8;">The resonance is shifting. Will you be a witness to the collapse, or the one who survives it?</p>
            <a href="{{ route('shop.index') }}?type=game" class="btn btn-gold" style="padding:1.4rem 4rem; font-size:1rem;">BEGIN YOUR JOURNEY</a>
        </div>
    </div>
</section>

@endsection