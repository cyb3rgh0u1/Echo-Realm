@extends('layouts.admin')
@section('title','Orders')
@section('content')
<div class="page-header">
  <div><div class="page-title">Orders</div><div class="page-sub">{{ $orders->total() }} total</div></div>
</div>
<div style="display:flex;gap:0.4rem;margin-bottom:1.1rem;flex-wrap:wrap">
  @php $cur = request('status'); @endphp
  @foreach([null=>'All','pending'=>'Pending','paid'=>'Paid','processing'=>'Processing','completed'=>'Completed','cancelled'=>'Cancelled','refunded'=>'Refunded'] as $val=>$label)
  <a href="{{ route('admin.orders.index').($val?'?status='.$val:'') }}"
     class="btn btn-xs {{ ($cur===$val||(!$cur&&!$val)) ? 'btn-primary' : 'btn-outline' }}">
    {{ $label }}
  </a>
  @endforeach
</div>
<div class="card">
  <div class="tw">
    <table>
      <thead><tr><th>Order</th><th>User</th><th>Items</th><th>Total</th><th>Status</th><th>Date</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse($orders as $order)
        @php
          $bc=['pending'=>'badge-gray','paid'=>'badge-cyan','processing'=>'badge-gold','completed'=>'badge-green','cancelled'=>'badge-red','refunded'=>'badge-gray'];
          $bs = $bc[$order->status] ?? 'badge-gray';
        @endphp
        <tr>
          <td><a href="{{ route('admin.orders.show',$order->id) }}" style="color:var(--a2);font-weight:500">{{ $order->order_number }}</a></td>
          <td style="color:var(--muted)">{{ $order->user->name ?? 'Deleted' }}</td>
          <td style="color:var(--muted)">{{ $order->items->count() }}</td>
          <td style="color:var(--gold);font-weight:600">${{ number_format($order->total,2) }}</td>
          <td><span class="badge {{ $bs }}">{{ $order->status }}</span></td>
          <td style="color:var(--muted);font-size:0.72rem">{{ $order->created_at->format('M d, Y') }}</td>
          <td><a href="{{ route('admin.orders.show',$order->id) }}" class="btn btn-xs btn-outline">View</a></td>
        </tr>
        @empty
        <tr><td colspan="7" style="text-align:center;color:var(--muted);padding:2rem">No orders.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($orders->hasPages())<div style="padding:1rem 1.25rem;border-top:1px solid var(--b1)">{{ $orders->links() }}</div>@endif
</div>
@endsection
