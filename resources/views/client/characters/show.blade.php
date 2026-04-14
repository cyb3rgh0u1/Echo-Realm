@extends('layouts.client')
@section('title', $character->name ?? 'Unknown Echo')

@push('styles')
<style>
    .char-hero { 
        min-height: 90vh; display: grid; grid-template-columns: 1.2fr 1fr; 
        align-items: center; position: relative; overflow: hidden; 
    }
    .char-hero-left { padding: 10rem 4rem 6rem; position: relative; z-index: 5; }
    .char-hero-right { position: relative; height: 100%; display: flex; align-items: center; justify-content: center; background: var(--void); }
    .char-visual-frame { width: 100%; height: 100%; position: relative; overflow: hidden; display: flex; align-items: center; justify-content: center; }
    .char-visual-frame::after { content: ''; position: absolute; inset: 0; background: linear-gradient(90deg, var(--void) 0%, transparent 30%, transparent 70%, var(--void) 100%); z-index: 2; }

    .ability-grid { display: grid; gap: 1.25rem; margin-top: 2rem; }
    .ability-card { background: rgba(255, 255, 255, 0.01); border: 1px solid var(--border); padding: 1.75rem; border-radius: 4px; transition: all 0.4s; position: relative; }
    .ability-card:hover { border-color: rgba(255,255,255,0.2); transform: translateX(10px); background: rgba(255, 255, 255, 0.03); }

    .tabs { display: flex; gap: 3rem; border-bottom: 1px solid var(--border); margin-bottom: 4rem; }
    .tab-btn { background: none; border: none; color: var(--text-dim); font-family: var(--font-heading); font-size: 0.75rem; letter-spacing: 0.2em; text-transform: uppercase; padding: 1.25rem 0; cursor: pointer; border-bottom: 2px solid transparent; transition: all 0.3s; }
    .tab-btn.active { color: #fff; border-bottom-color: var(--accent); }
    
    .tab-pane { display: none; animation: hudFadeIn 0.6s cubic-bezier(0.23, 1, 0.32, 1); }
    .tab-pane.active { display: block; }

    .stats-hud { background: rgba(255,255,255,0.01); border: 1px solid var(--border); padding: 4rem; border-radius: 4px; max-width: 900px; }
    .stat-row { display: grid; grid-template-columns: 140px 1fr 60px; gap: 3rem; align-items: center; margin-bottom: 1.5rem; }
    .stat-track { height: 2px; background: rgba(255,255,255,0.05); position: relative; }
    .stat-fill { height: 100%; transition: width 2s cubic-bezier(0.19, 1, 0.22, 1); box-shadow: 0 0 15px currentColor; }

    @keyframes hudFadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
    @media (max-width: 1000px) { .char-hero { grid-template-columns: 1fr; } .char-hero-right { display: none; } }
</style>
@endpush

@section('content')

@php
    $elColor = (isset($character->element) && $character->element) ? $character->element->color : 'var(--accent)';
    $icons = [
        'back'   => '<line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline>',
        'cart'   => '<circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>',
        'hex'    => '<path d="M12 2l9 4.9v10.2l-9 4.9-9-4.9V6.9z"></path>',
        'module' => '<rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="9" x2="15" y2="15"></line><line x1="15" y1="9" x2="9" y2="15"></line>'
    ];
@endphp

<div class="char-hero" style="background: radial-gradient(circle at 0% 100%, {{ $elColor }}08, transparent 60%)">
    <div class="char-hero-left">
        <a href="{{ route('characters.index') }}" style="display:flex; align-items:center; gap:10px; color:var(--text-dim); text-decoration:none; font-family:var(--font-heading); font-size:0.6rem; letter-spacing:0.25em; text-transform:uppercase; margin-bottom:4rem; opacity:0.6">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">{!! $icons['back'] !!}</svg>
            Personnel Roster
        </a>

        <div style="font-family:var(--font-heading); font-size:0.65rem; letter-spacing:0.5em; text-transform:uppercase; color:{{ $elColor }}; margin-bottom:1.5rem; opacity:0.9">
            {{ $character->element->name ?? 'Neutral' }} // RESONANCE SIGNATURE
        </div>

        <h1 style="font-family:var(--font-display); font-size:clamp(3.5rem, 8vw, 6rem); font-weight:900; line-height:0.85; color:#fff; margin-bottom:1.5rem; letter-spacing:-0.03em">
            {{ $character->name ?? 'Unknown' }}
        </h1>

        <p style="color:var(--text-muted); font-size:1.1rem; font-style:italic; margin-bottom:3rem; opacity:0.8; letter-spacing:0.02em">
            "{{ $character->title ?? 'Unidentified Echo' }}"
        </p>

        <div style="display:flex; gap:1rem; margin-bottom:4rem">
            <span class="badge badge-{{ $character->rarity ?? 'common' }}">{{ strtoupper($character->rarity ?? 'Common') }}</span>
            <span class="badge" style="background:rgba(255,255,255,0.03); border:1px solid var(--border); color:var(--text-dim); font-size:0.6rem">{{ strtoupper($character->role ?? 'None') }}</span>
        </div>

        <p style="color:var(--text-muted); font-size:1rem; line-height:1.9; max-width:600px; margin-bottom:5rem; opacity:0.7">
            {{ $character->bio ?? 'No background data available.' }}
        </p>

        {{-- SAFE SHOP CHECK --}}
        @if(isset($shopBundle) && $shopBundle)
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="item_id" value="{{ $shopBundle->id }}">
            <button type="submit" class="btn btn-gold" style="padding: 1.4rem 3rem; gap:15px; font-size:0.9rem; border-radius:4px; letter-spacing:0.1em">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">{!! $icons['cart'] !!}</svg>
                ACQUIRE MANIFEST — ${{ number_format($shopBundle->price, 2) }}
            </button>
        </form>
        @endif
    </div>

    <div class="char-hero-right">
        <div class="char-visual-frame">
            @if(isset($character->image) && $character->image)
                <img src="{{ asset('storage/'.$character->image) }}" alt="{{ $character->name }}" style="width:100%; height:100%; object-fit:cover; filter: grayscale(20%) contrast(110%);">
            @else
                <svg width="240" height="240" viewBox="0 0 24 24" fill="none" stroke="{{ $elColor }}" stroke-width="0.3" style="opacity:0.1">{!! $icons['hex'] !!}</svg>
            @endif
        </div>
    </div>
</div>

<div class="section" style="padding-top: 0">
    <div class="container">
        <div class="tabs">
            <button class="tab-btn active" onclick="switchTab('abilities', this)">Abilities</button>
            <button class="tab-btn" onclick="switchTab('stats', this)">Diagnostics</button>
            @if(isset($character->lore) && $character->lore)
                <button class="tab-btn" onclick="switchTab('lore', this)">Archive Data</button>
            @endif
        </div>

        <div class="tab-pane active" id="tab-abilities">
            <div class="ability-grid">
                @if(isset($character->abilities) && is_array($character->abilities))
                    @foreach($character->abilities as $ability)
                        @php
                            $aType = $ability['type'] ?? 'active';
                            $aColor = $aType === 'ultimate' ? 'var(--gold)' : ($aType === 'passive' ? '#10b981' : $elColor);
                        @endphp
                        <div class="ability-card" style="border-left: 3px solid {{ $aColor }}">
                            <div class="type-tag" style="color: {{ $aColor }}">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">{!! $icons['module'] !!}</svg>
                                {{ $aType }} protocol
                            </div>
                            <div style="font-family:var(--font-heading); font-size:1.2rem; font-weight:700; color:#fff; margin-bottom:0.75rem; letter-spacing:0.02em">
                                {{ $ability['name'] ?? 'Unknown Ability' }}
                            </div>
                            <p style="color:var(--text-muted); font-size:0.9rem; line-height:1.7; opacity:0.8; max-width: 900px">
                                {{ $ability['description'] ?? 'No description provided.' }}
                            </p>
                        </div>
                    @endforeach
                @else
                    <p style="color:var(--text-dim); font-family:var(--font-heading); font-size:0.7rem; letter-spacing:0.3em; text-transform:uppercase">No Resonance Data Found</p>
                @endif
            </div>
        </div>

        <div class="tab-pane" id="tab-stats">
            <div class="stats-hud">
                @if(isset($character->stats) && is_array($character->stats))
                    @foreach(['hp'=>'Integrity','attack'=>'Offense','defense'=>'Mitigation','magic'=>'Resonance','speed'=>'Velocity'] as $key => $label)
                        @if(isset($character->stats[$key]))
                            <div class="stat-row">
                                <span class="stat-label">{{ $label }}</span>
                                <div class="stat-track">
                                    <div class="stat-fill" style="width:{{ $character->stats[$key] }}%; color:{{ $elColor }}; background:currentColor"></div>
                                </div>
                                <span style="font-family:var(--font-heading); font-size:0.8rem; color:#fff; text-align:right; font-weight:700">{{ $character->stats[$key] }}</span>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>

        @if(isset($character->lore) && $character->lore)
            <div class="tab-pane" id="tab-lore">
                <div style="max-width:850px; color:var(--text-muted); line-height:2.2; font-size:1.05rem; opacity:0.85; letter-spacing:0.01em">
                    {!! $character->lore !!}
                </div>
            </div>
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script>
function switchTab(id, btn) {
    document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + id).classList.add('active');
    btn.classList.add('active');
}
</script>
@endpush