@extends('layouts.admin')
@section('title','User: '.$user->name)
@section('content')
<div class="breadcrumb"><a href="{{ route('admin.users.index') }}">Users</a><span>/</span><span>{{ $user->name }}</span></div>
<div class="page-header">
  <div><div class="page-title">{{ $user->name }}</div><div class="page-subtitle">{{ $user->email }}</div></div>
  <form action="{{ route('admin.users.toggle-ban',$user->id) }}" method="POST">@csrf<button type="submit" class="btn {{ $user->is_banned?'btn-success':'btn-danger' }}">{{ $user->is_banned?'Unban User':'Ban User' }}</button></form>
</div>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem">
  <div class="card">
    <div class="card-header"><span class="card-title">Account Info</span></div>
    <div class="card-body" style="display:grid;gap:0.6rem;font-size:0.82rem">
      <div><span style="color:var(--muted)">Name:</span> {{ $user->name }}</div>
      <div><span style="color:var(--muted)">Username:</span> @{{ $user->username }}</div>
      <div><span style="color:var(--muted)">Email:</span> {{ $user->email }}</div>
      <div><span style="color:var(--muted)">Joined:</span> {{ $user->created_at->format('F j, Y') }}</div>
      <div><span style="color:var(--muted)">Last login:</span> {{ $user->last_login_at?$user->last_login_at->diffForHumans():'Never' }}</div>
      <div><span style="color:var(--muted)">Status:</span> @if($user->is_banned)<span class="badge badge-red">Banned</span>@else<span class="badge badge-green">Active</span>@endif</div>
    </div>
  </div>
  <div class="card">
    <div class="card-header"><span class="card-title">Order History ({{ $user->orders->count() }})</span></div>
    <div class="table-wrap">
      <table>
        <thead><tr><th>Order</th><th>Total</th><th>Status</th></tr></thead>
        <tbody>
          @forelse($user->orders->take(8) as $order)
          <tr>
            <td><a href="{{ route('admin.orders.show',$order->id) }}" style="color:var(--accent2);text-decoration:none">{{ $order->order_number }}</a></td>
            <td style="color:var(--gold)">${{ number_format($order->total,2) }}</td>
            <td><span class="badge badge-gray">{{ $order->status }}</span></td>
          </tr>
          @empty
          <tr><td colspan="3" style="text-align:center;color:var(--muted);padding:1rem">No orders</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
