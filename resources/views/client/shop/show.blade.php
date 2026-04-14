@extends('layouts.client')
@section('title', $item->name)

@section('content')
@php
    $icons = [
        'game'      => '<rect x="2" y="6" width="20" height="12" rx="2"></rect><path d="M6 12h4m-2-2v4m7-2h.01m2.99 0h.01"></path>',
        'character' => '<path d="M12 2l3 9 9 3-9 3-3 9-3-9-9-3 9-3 3-9z"></path>',
        'skin'      => '<path d="M12 2v20m10-10H2"></path><circle cx="12" cy="12" r="3"></circle>',
        'bundle'    => '<path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path>',
        'currency'  => '<path d="M6 3h12l4 6-10 12L2 9z"></path>',
        'cosmetic'  => '<path d="M12 21c-3.1 0-5.6-2.5-5.6-5.6 0-3.1 2.5-5.6 5.6-5.6s5.6 2.5 5.6 5.6c0 3.1-2.5 5.6-5.6 5.6z"></path><path d="M12 10V2"></path>',
        'bullet'    => '<polyline points="20 6 9 17 4 12"></polyline>',
        'cart'      => '<circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>',
        'back'      => '<line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline>'
    ];
@endphp

<div style="padding:10rem 2rem 6rem; max-width:1500px; margin:0 auto">
  {{-- 65/35 Split for maximum image impact --}}
  <div style="display:grid; grid-template-columns: 1.8fr 1fr; gap:6rem; align-items:start">
    
    {{-- Massive Media Section --}}
    <div>
      <div style="width:100%; aspect-ratio:16/9; background:rgba(255,255,255,0.01); border:1px solid var(--border); border-radius:12px; display:flex; align-items:center; justify-content:center; position:relative; overflow:hidden; box-shadow: 0 30px 60px rgba(0,0,0,0.5)">
        @if($item->image)
            <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->name }}" style="width:100%; height:100%; object-fit:cover; position:absolute; inset:0">
            <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(0,0,0,0.4), transparent 30%)"></div>
        @else
            <svg width="200" height="200" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="0.3" style="opacity:0.1">
                {!! $icons[$item->type] ?? $icons['game'] !!}
            </svg>
        @endif
      </div>
    </div>

    {{-- Refined Info Section --}}
    <div style="padding-top: 0.5rem">
      <div style="display:flex; gap:0.6rem; margin-bottom:1.25rem">
        <span class="badge badge-{{ $item->rarity }}" style="font-size:0.6rem; letter-spacing:0.1em">{{ strtoupper($item->rarity) }}</span>
        <span class="badge" style="background:rgba(255,255,255,0.02); border:1px solid var(--border); color:var(--text-dim); font-size:0.6rem; letter-spacing:0.1em">{{ strtoupper($item->type) }}</span>
        @if($item->is_featured)
            <span class="badge" style="background:rgba(var(--accent-rgb), 0.05); color:var(--accent); border:1px solid rgba(var(--accent-rgb), 0.2); font-size:0.6rem; letter-spacing:0.1em">FEATURED</span>
        @endif
      </div>

      <h1 style="font-family:var(--font-display); font-size:2.8rem; line-height:1.05; margin-bottom:1.25rem; color:#fff; letter-spacing:-0.01em">{{ $item->name }}</h1>
      
      {{-- Smaller, cleaner description --}}
      <p style="color:var(--text-muted); line-height:1.7; font-size:0.88rem; margin-bottom:2.5rem; max-width: 440px; opacity: 0.8">
        {{ $item->description }}
      </p>

      @if($item->includes && count($item->includes))
      <div style="background:rgba(255,255,255,0.01); border-left: 2px solid var(--accent); padding:1.25rem 1.5rem; margin-bottom:2.5rem">
        <div style="font-family:var(--font-heading); font-size:0.6rem; letter-spacing:0.35em; text-transform:uppercase; color:var(--text-dim); margin-bottom:1.25rem; opacity:0.6">Package Contents</div>
        <div style="display:grid; grid-template-columns: 1fr; gap: 0.5rem">
            @foreach($item->includes as $inc)
                <div style="display:flex; align-items:center; gap:0.6rem; color:var(--text-muted); font-size:0.75rem; margin-bottom:0.2rem">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0; opacity:0.7">{!! $icons['bullet'] !!}</svg>
                    {{ $inc }}
                </div>
            @endforeach
        </div>
      </div>
      @endif

      <div style="display:flex; align-items:baseline; gap:1.25rem; margin-bottom:2rem">
        <span style="font-family:var(--font-display); font-size:3rem; font-weight:800; color:#fff; letter-spacing:-0.03em">${{ number_format($item->price,2) }}</span>
        @if($item->original_price)
            <span style="color:var(--text-dim); font-size:1.1rem; text-decoration:line-through; opacity:0.5">${{ number_format($item->original_price,2) }}</span>
            <span style="color:var(--red); font-family:var(--font-heading); font-size:0.65rem; font-weight:700; letter-spacing:0.1em">/ -{{ $item->discount_percent }}%</span>
        @endif
      </div>

      <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        <input type="hidden" name="item_id" value="{{ $item->id }}">
        <button type="submit" class="btn btn-gold" style="width:100%; justify-content:center; padding:1.2rem; font-size:0.9rem; gap:12px; border-radius:4px; text-transform:uppercase; letter-spacing:0.15em">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $icons['cart'] !!}</svg>
            Add to Manifest
        </button>
      </form>

      <div style="margin-top:2rem">
        <a href="{{ route('shop.index') }}" class="back-link">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $icons['back'] !!}</svg>
            Return to Market
        </a>
      </div>
    </div>
  </div>
</div>

<style>
    .back-link {
        display:flex; 
        align-items:center; 
        gap:10px; 
        color:var(--text-dim); 
        font-family:var(--font-heading); 
        font-size:0.6rem; 
        text-decoration:none; 
        letter-spacing:0.25em; 
        text-transform:uppercase; 
        transition:all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        opacity: 0.5;
    }
    .back-link:hover { color: var(--accent) !important; transform: translateX(-8px); opacity: 1; }
    
    .btn-gold { transition: all 0.3s ease; border: 1px solid transparent; }
    .btn-gold:hover { 
        background: transparent; 
        border-color: var(--gold); 
        color: var(--gold); 
        box-shadow: 0 0 20px rgba(var(--accent-rgb), 0.2); 
    }
</style>
@endsection