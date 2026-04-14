@extends('layouts.client')
@section('title','Checkout')
@section('content')
<div style="padding:8rem 2rem 6rem;max-width:800px;margin:0 auto">
  <h1 class="section-title" style="margin-bottom:3rem">Checkout</h1>
  <div style="display:grid;grid-template-columns:1fr 300px;gap:2rem;align-items:start">
    <div>
      <div style="background:var(--panel);border:1px solid var(--border);border-radius:12px;padding:2rem;margin-bottom:1.5rem">
        <h3 style="font-family:var(--font-heading);font-size:0.8rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--accent);margin-bottom:1.25rem">Billing Information</h3>
        <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
          @csrf
          <div style="margin-bottom:1rem">
            <label style="font-family:var(--font-heading);font-size:0.7rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--text-dim);display:block;margin-bottom:0.4rem">Full Name</label>
            <input type="text" name="name" value="{{ auth()->user()->name }}" required style="width:100%;background:var(--surface);border:1px solid var(--border);color:var(--text);padding:0.7rem 1rem;border-radius:6px;font-family:var(--font-body);outline:none">
          </div>
          <div style="margin-bottom:1.5rem">
            <label style="font-family:var(--font-heading);font-size:0.7rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--text-dim);display:block;margin-bottom:0.4rem">Email</label>
            <input type="email" name="email" value="{{ auth()->user()->email }}" required style="width:100%;background:var(--surface);border:1px solid var(--border);color:var(--text);padding:0.7rem 1rem;border-radius:6px;font-family:var(--font-body);outline:none">
          </div>
          <div style="background:rgba(245,158,11,0.08);border:1px solid rgba(245,158,11,0.2);border-radius:8px;padding:1rem;margin-bottom:1.5rem">
            <p style="color:var(--gold);font-family:var(--font-heading);font-size:0.75rem;letter-spacing:0.05em">⚠ Demo Mode: No actual payment is processed. Click below to complete a demo purchase.</p>
          </div>
          <button type="submit" class="btn btn-gold" style="width:100%;justify-content:center;padding:1rem;font-size:0.85rem">Complete Purchase — ${{ number_format($total,2) }}</button>
        </form>
      </div>
    </div>
    <div style="background:var(--panel);border:1px solid var(--border);border-radius:12px;padding:1.5rem;position:sticky;top:90px">
      <div style="font-family:var(--font-heading);font-size:0.65rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--text-dim);margin-bottom:1rem">Order Items</div>
      @foreach($items as $ci)
      <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:0.75rem;font-size:0.8rem">
        <div><div style="color:var(--text)">{{ $ci['item']->name }}</div><div style="color:var(--text-dim);font-size:0.7rem">× {{ $ci['qty'] }}</div></div>
        <span style="font-family:var(--font-heading);color:var(--gold)">${{ number_format($ci['item']->price * $ci['qty'],2) }}</span>
      </div>
      @endforeach
      <div style="height:1px;background:var(--border);margin:1rem 0"></div>
      <div style="display:flex;justify-content:space-between"><span style="font-family:var(--font-heading);font-weight:600">Total</span><span style="font-family:var(--font-display);font-size:1.2rem;color:var(--gold);font-weight:700">${{ number_format($total,2) }}</span></div>
    </div>
  </div>
</div>
@endsection
