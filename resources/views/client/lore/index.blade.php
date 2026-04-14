@extends('layouts.client')
@section('title','Lore Tomes')

@push('styles')
<style>
    .lore-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.5rem; }
    
    /* Filter Chips */
    .filter-chips { display: flex; gap: 0.6rem; flex-wrap: wrap; margin-bottom: 3rem; }
    .filter-chip { 
        font-family: var(--font-heading); 
        font-size: 0.6rem; 
        letter-spacing: 0.15em; 
        text-transform: uppercase; 
        padding: 0.5rem 1.25rem; 
        border-radius: 4px; 
        text-decoration: none; 
        transition: all 0.3s; 
        border: 1px solid var(--border); 
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .filter-chip:hover, .filter-chip.active { 
        background: rgba(255,255,255,0.03); 
        border-color: var(--accent); 
        color: #fff; 
    }

    /* Tome Cards */
    .lore-tome-card { 
        background: rgba(255,255,255,0.01); 
        border: 1px solid var(--border); 
        border-radius: 4px; 
        padding: 2rem; 
        text-decoration: none; 
        color: inherit; 
        display: flex;
        flex-direction: column;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); 
        position: relative;
        overflow: hidden;
    }
    .lore-tome-card::before { 
        content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 2px; opacity: 0.6;
    }
    .lore-tome-card.public-card::before { background: var(--accent); }
    .lore-tome-card.classified-card::before { background: var(--gold); }
    .lore-tome-card.top-secret-card::before { background: var(--red); }

    .lore-tome-card:hover { 
        border-color: rgba(255,255,255,0.15); 
        transform: translateY(-5px); 
        background: rgba(255,255,255,0.03);
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-family: var(--font-heading);
        font-size: 0.55rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        padding: 0.3rem 0.75rem;
        border-radius: 2px;
        margin-bottom: 1.5rem;
        width: fit-content;
    }

    .lore-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: auto;
        padding-top: 1.5rem;
        border-top: 1px solid rgba(255,255,255,0.05);
        color: var(--text-dim);
        font-family: var(--font-heading);
        font-size: 0.6rem;
        letter-spacing: 0.1em;
    }

    .tome-icon { width: 12px; height: 12px; opacity: 0.7; }
</style>
@endpush

@section('content')

@php
    $svgs = [
        'public'     => '<circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line>',
        'classified' => '<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line>',
        'top_secret' => '<circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line>',
        'clock'      => '<circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline>',
        'calendar'   => '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line>'
    ];
@endphp

<div class="page-hero">
  <div class="page-hero-bg"></div>
  <div style="position:relative;z-index:1">
    <p class="section-label">Restricted Access</p>
    <h1 class="section-title">The Lore Tomes</h1>
    <p class="section-subtitle" style="margin:0 auto">Recovered fragments from the First Shattering. Handle with extreme caution.</p>
  </div>
</div>

<div class="section">
  <div class="container">
    <div class="filter-chips">
      @php $noFilter = !request()->filled('category') && !request()->filled('classification'); @endphp
      <a href="{{ route('lore.index') }}" class="filter-chip {{ $noFilter ? 'active' : '' }}">All Archives</a>
      
      @foreach($categories as $cat)
      <a href="{{ route('lore.index') }}?category={{ $cat }}" class="filter-chip {{ request('category') === $cat ? 'active' : '' }}">
        {{ ucfirst($cat) }}
      </a>
      @endforeach

      <a href="{{ route('lore.index') }}?classification=classified" class="filter-chip {{ request('classification') === 'classified' ? 'active' : '' }}" style="border-color: rgba(245,158,11,0.2)">
        <svg class="tome-icon" viewBox="0 0 24 24" fill="none" stroke="var(--gold)" stroke-width="2">{!! $svgs['classified'] !!}</svg>
        Classified
      </a>

      <a href="{{ route('lore.index') }}?classification=top_secret" class="filter-chip {{ request('classification') === 'top_secret' ? 'active' : '' }}" style="border-color: rgba(239,68,68,0.2)">
        <svg class="tome-icon" viewBox="0 0 24 24" fill="none" stroke="var(--red)" stroke-width="2">{!! $svgs['top_secret'] !!}</svg>
        Top Secret
      </a>
    </div>

    <div class="lore-grid">
      @forelse($lore as $i => $entry)
        @php
          $cls = $entry->classification;
          $status = [
              'top_secret' => ['card' => 'top-secret-card', 'text' => 'Level 5 Access', 'color' => 'var(--red)', 'svg' => $svgs['top_secret']],
              'classified' => ['card' => 'classified-card', 'text' => 'Restricted', 'color' => 'var(--gold)', 'svg' => $svgs['classified']],
              'public'     => ['card' => 'public-card',     'text' => 'Public Record', 'color' => 'var(--accent)', 'svg' => $svgs['public']]
          ][$cls] ?? ['card' => 'public-card', 'text' => 'Public', 'color' => 'var(--accent)', 'svg' => $svgs['public']];
        @endphp

        <a href="{{ route('lore.show', $entry->slug) }}" class="lore-tome-card {{ $status['card'] }} reveal" style="transition-delay:{{ ($i % 6) * 0.07 }}s">
          
          <div class="status-badge" style="color:{{ $status['color'] }}; background:{{ $status['color'] }}11; border: 1px solid {{ $status['color'] }}33">
            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">{!! $status['svg'] !!}</svg>
            {{ $status['text'] }}
          </div>

          <div style="font-family:var(--font-heading); font-size:0.55rem; letter-spacing:0.25em; text-transform:uppercase; color:var(--text-dim); margin-bottom:0.6rem; opacity:0.6">
            {{ $entry->category }}
          </div>

          <h3 style="font-family:var(--font-heading); font-size:1.1rem; font-weight:600; line-height:1.3; margin-bottom:1rem; color:#fff">
            {{ $entry->title }}
          </h3>

          @if($entry->excerpt)
          <p style="color:var(--text-muted); font-size:0.8rem; line-height:1.7; opacity:0.7; margin-bottom:2rem; display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden">
            {{ $entry->excerpt }}
          </p>
          @endif

          <div class="lore-footer">
            <div style="display:flex; gap:12px">
                <span style="display:flex; align-items:center; gap:5px">
                    <svg class="tome-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">{!! $svgs['clock'] !!}</svg>
                    {{ $entry->read_time }}m
                </span>
                <span style="display:flex; align-items:center; gap:5px">
                    <svg class="tome-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">{!! $svgs['calendar'] !!}</svg>
                    {{ $entry->created_at->format('M Y') }}
                </span>
            </div>
            <span style="opacity:0.4">READ TOME →</span>
          </div>
        </a>
      @empty
        <div style="grid-column:1/-1; text-align:center; padding:6rem 2rem; border:1px dashed var(--border); border-radius:8px; opacity:0.5">
          <p style="font-family:var(--font-heading); color:var(--text-dim)">Archives are currently purged.</p>
        </div>
      @endforelse
    </div>

    <div style="margin-top:3rem">{{ $lore->links() }}</div>
  </div>
</div>
@endsection