@extends('layouts.admin')
@section('title','Order '.$order->order_number)
@section('content')
<div class="breadcrumb"><a href="{{ route('admin.orders.index') }}">Orders</a><span>/</span><span>{{ $order->order_number }}</span></div>
<div class="page-header">
  <div><div class="page-title">{{ $order->order_number }}</div><div class="page-subtitle">{{ $order->created_at->format('F j, Y g:i A') }}</div></div>
</div>
<div style="display:grid;grid-template-columns:2fr 1fr;gap:1.25rem;align-items:start">
  <div>
    <div class="card" style="margin-bottom:1.25rem">
      <div class="card-header"><span class="card-title">Order Items</span></div>
      <div class="table-wrap">
        <table>
          <thead><tr><th>Item</th><th>Qty</th><th>Unit Price</th><th>Total</th></tr></thead>
          <tbody>
            @foreach($order->items as $item)
            <tr>
              <td>{{ $item->shopItem->name??'Removed item' }}</td>
              <td>{{ $item->quantity }}</td>
              <td>${{ number_format($item->price,2) }}</td>
              <td style="color:var(--gold);font-weight:600">${{ number_format($item->price*$item->quantity,2) }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div style="padding:1rem 1.25rem;border-top:1px solid var(--border);display:flex;justify-content:flex-end;gap:1.5rem;align-items:center">
        <span style="font-size:0.82rem;color:var(--muted)">Total</span>
        <span style="font-family:var(--font-h);font-size:1.2rem;color:var(--gold);font-weight:700">${{ number_format($order->total,2) }}</span>
      </div>
    </div>
  </div>
  <div>
    <div class="card" style="margin-bottom:1.25rem">
      <div class="card-header"><span class="card-title">Update Status</span></div>
      <div class="card-body">
        <form action="{{ route('admin.orders.update-status',$order->id) }}" method="POST">
          @csrf
          <div class="form-group">
            <select name="status" class="form-control">
              @foreach(['pending','paid','processing','completed','cancelled','refunded'] as $s)
              <option value="{{ $s }}" {{ $order->status===$s?'selected':'' }}>{{ ucfirst($s) }}</option>
              @endforeach
            </select>
          </div>
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">Update Status</button>
        </form>
      </div>
    </div>
    <div class="card">
      <div class="card-header"><span class="card-title">Customer</span></div>
      <div class="card-body" style="display:grid;gap:0.5rem;font-size:0.82rem;color:var(--muted)">
        <div><strong style="color:var(--text)">{{ $order->user->name??'—' }}</strong></div>
        <div>{{ $order->user->email??'—' }}</div>
        @if($order->billing_info)<div>Billing: {{ $order->billing_info['name']??'—' }}</div>@endif
      </div>
    </div>
  </div>
</div>
@endsection
