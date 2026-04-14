@extends('layouts.client')
@section('title','Cart')

@section('content')
<div style="padding:8rem 2rem 6rem;max-width:1100px;margin:0 auto">
  <p class="section-label">Realm Store</p>
  <h1 class="section-title" style="margin-bottom:3.5rem">Your Cart</h1>

  @php
    $icons = [
        'empty'     => '<circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>',
        'game'      => '<rect x="2" y="6" width="20" height="12" rx="2"></rect><path d="M6 12h4m-2-2v4m7-2h.01m2.99 0h.01"></path>',
        'character' => '<path d="M12 2l3 9 9 3-9 3-3 9-3-9-9-3 9-3 3-9z"></path>',
        'skin'      => '<path d="M12 2v20m10-10H2"></path><circle cx="12" cy="12" r="3"></circle>',
        'bundle'    => '<path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path>',
        'currency'  => '<path d="M6 3h12l4 6-10 12L2 9z"></path>',
        'cosmetic'  => '<path d="M12 21c-3.1 0-5.6-2.5-5.6-5.6 0-3.1 2.5-5.6 5.6-5.6s5.6 2.5 5.6 5.6c0 3.1-2.5 5.6-5.6 5.6z"></path><path d="M12 10V2"></path>',
        'trash'     => '<polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>'
    ];
  @endphp

  @if(empty($items))
  <div style="text-align:center;padding:6rem 2rem;background:rgba(255,255,255,0.02);border:1px solid var(--border);border-radius:16px">
    <div style="margin-bottom:1.5rem; color:var(--text-dim)">
        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">{!! $icons['empty'] !!}</svg>
    </div>
    <p style="font-family:var(--font-heading);font-size:1rem;color:var(--text-muted);margin-bottom:2rem;letter-spacing:0.1em;text-transform:uppercase">The inventory is clear</p>
    <a href="{{ route('shop.index') }}" class="btn btn-outline" style="padding: 0.8rem 2rem">Return to Market</a>
  </div>
  @else
  <div style="display:grid;grid-template-columns:1fr 380px;gap:3rem;align-items:start">
    {{-- CART ITEMS LIST --}}
    <div>
      @foreach($items as $ci)
      @php $item=$ci['item']; $qty=$ci['qty']; @endphp
      <div style="display:grid;grid-template-columns:100px 1fr auto;gap:1.5rem;align-items:center;padding:1.5rem;background:rgba(255,255,255,0.02);border:1px solid var(--border);border-radius:12px;margin-bottom:1rem">
        
        {{-- Item Icon/Image --}}
        <div style="aspect-ratio:1;background:var(--void);border-radius:8px;display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,0.05);position:relative;overflow:hidden">
            @if($item->image)
                <img src="{{ asset('storage/'.$item->image) }}" style="width:100%;height:100%;object-fit:cover">
            @else
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="1.5" style="opacity:0.6">{!! $icons[$item->type] ?? $icons['game'] !!}</svg>
            @endif
        </div>

        {{-- Item Info --}}
        <div>
          <div style="font-family:var(--font-heading);font-size:1rem;font-weight:600;color:#fff;margin-bottom:0.2rem">{{ $item->name }}</div>
          <div style="color:var(--text-dim);font-size:0.7rem;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:0.8rem">{{ $item->type }}</div>
          <div style="color:var(--accent);font-family:var(--font-heading);font-size:1.1rem;font-weight:700">${{ number_format($item->price,2) }}</div>
        </div>

        {{-- Actions --}}
        <div style="display:flex;flex-direction:column;align-items:flex-end;gap:0.75rem">
          <form action="{{ route('cart.update') }}" method="POST" style="display:flex;align-items:center;gap:0.5rem">
            @csrf
            <input type="hidden" name="item_id" value="{{ $item->id }}">
            <input type="number" name="qty" value="{{ $qty }}" min="1" max="99" 
                   style="width:55px;background:rgba(0,0,0,0.3);border:1px solid var(--border);color:#fff;text-align:center;padding:0.4rem;border-radius:4px;font-family:var(--font-heading);font-size:0.9rem">
            <button type="submit" class="btn btn-outline btn-sm" style="font-size:0.65rem;padding:0.4rem 0.8rem">Update</button>
          </form>

          <form action="{{ route('cart.remove') }}" method="POST" style="margin:0">
            @csrf
            <input type="hidden" name="item_id" value="{{ $item->id }}">
            <button type="submit" style="background:none;border:none;color:var(--red);cursor:pointer;display:flex;align-items:center;gap:5px;font-size:0.7rem;text-transform:uppercase;letter-spacing:0.1em;opacity:0.7">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $icons['trash'] !!}</svg>
                Remove
            </button>
          </form>
        </div>
      </div>
      @endforeach
    </div>

    {{-- ORDER SUMMARY --}}
    <div style="background:rgba(255,255,255,0.03);border:1px solid var(--border);border-radius:16px;padding:2rem;position:sticky;top:100px">
      <div style="font-family:var(--font-heading);font-size:0.75rem;letter-spacing:0.25em;text-transform:uppercase;color:var(--text-dim);margin-bottom:2rem;border-bottom:1px solid var(--border);padding-bottom:1rem">Summary</div>
      
      @foreach($items as $ci)
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.75rem;font-size:0.85rem">
        <span style="color:var(--text-muted)">{{ $ci['item']->name }} <small style="opacity:0.5;margin-left:4px">×{{ $ci['qty'] }}</small></span>
        <span style="font-family:var(--font-heading);color:#fff">${{ number_format($ci['item']->price * $ci['qty'],2) }}</span>
      </div>
      @endforeach

      <div style="height:1px;background:var(--border);margin:1.5rem 0"></div>
      
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem">
        <span style="font-family:var(--font-heading);font-size:0.9rem;font-weight:600;text-transform:uppercase;letter-spacing:0.1em">Total Amount</span>
        <span style="font-family:var(--font-display);font-size:1.6rem;font-weight:800;color:var(--accent)">${{ number_format($total,2) }}</span>
      </div>

      @auth
      <a href="{{ route('checkout') }}" class="btn btn-gold" style="width:100%;justify-content:center;padding:1rem;font-size:0.9rem">Initialize Checkout</a>
      @else
      <a href="{{ route('login') }}" class="btn btn-primary" style="width:100%;justify-content:center;padding:1rem;font-size:0.9rem">Login to Proceed</a>
      @endauth

      <a href="{{ route('shop.index') }}" style="display:flex;align-items:center;justify-content:center;gap:8px;margin-top:1.25rem;color:var(--text-dim);font-family:var(--font-heading);font-size:0.65rem;text-decoration:none;letter-spacing:0.15em;text-transform:uppercase">
        Return to Market
      </a>
    </div>
  </div>
  @endif
</div>
@endsection