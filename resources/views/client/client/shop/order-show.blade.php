@extends('layouts.client')
@section('title','Order '.$order->order_number)
@section('content')
<div style="padding:8rem 2rem 6rem;max-width:700px;margin:0 auto">

  @php
    $statusColors = [
      'pending'    => '#9ca3af',
      'paid'       => '#22d3ee',
      'processing' => '#f59e0b',
      'completed'  => '#10b981',
      'cancelled'  => '#ef4444',
      'refunded'   => '#6b7280',
    ];
    $statusColor = $statusColors[$order->status] ?? '#9ca3af';
  @endphp

  <div style="display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem">
    <a href="{{ route('orders.index') }}"
       style="color:var(--text-dim);text-decoration:none;font-family:var(--font-heading);font-size:0.7rem">
      ← ORDERS
    </a>
    <h1 style="font-family:var(--font-heading);font-size:1.2rem;font-weight:600">
      {{ $order->order_number }}
    </h1>
    <span style="margin-left:auto;font-family:var(--font-heading);font-size:0.72rem;letter-spacing:0.1em;text-transform:uppercase;color:{{ $statusColor }}">
      {{ ucfirst($order->status) }}
    </span>
  </div>

  <div style="background:var(--panel);border:1px solid var(--border);border-radius:12px;padding:1.75rem;margin-bottom:1.5rem">
    <div style="font-family:var(--font-heading);font-size:0.65rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--text-dim);margin-bottom:1.25rem">
      Order Items
    </div>
    @foreach($order->items as $item)
    <div style="display:flex;justify-content:space-between;align-items:center;padding:0.75rem 0;border-bottom:1px solid var(--border)">
      <div>
        <div style="font-family:var(--font-heading);font-size:0.9rem">
          {{ $item->shopItem->name ?? 'Item removed' }}
        </div>
        <div style="color:var(--text-dim);font-size:0.75rem">× {{ $item->quantity }}</div>
      </div>
      <span style="font-family:var(--font-heading);color:var(--gold)">
        ${{ number_format($item->price * $item->quantity, 2) }}
      </span>
    </div>
    @endforeach
    <div style="display:flex;justify-content:space-between;margin-top:1rem;padding-top:0.5rem">
      <span style="font-family:var(--font-heading);font-weight:600">Total</span>
      <span style="font-family:var(--font-display);font-size:1.3rem;color:var(--gold);font-weight:700">
        ${{ number_format($order->total, 2) }}
      </span>
    </div>
  </div>

  <div style="background:var(--panel);border:1px solid var(--border);border-radius:12px;padding:1.75rem">
    <div style="font-family:var(--font-heading);font-size:0.65rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--text-dim);margin-bottom:1rem">
      Details
    </div>
    <div style="color:var(--text-muted);font-size:0.85rem;line-height:2">
      <div>Date: {{ $order->created_at->format('F j, Y g:i A') }}</div>
      <div>Payment: {{ ucfirst($order->payment_method ?? 'Demo') }}</div>
      @if($order->billing_info)
      <div>Name: {{ $order->billing_info['name'] ?? '—' }}</div>
      <div>Email: {{ $order->billing_info['email'] ?? '—' }}</div>
      @endif
    </div>
  </div>

</div>
@endsection
