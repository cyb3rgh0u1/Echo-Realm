@extends('layouts.admin')
@section('title','Dashboard')
@section('content')

<div class="page-header">
  <div>
    <div class="page-title">Dashboard</div>
    <div class="page-sub">Welcome back, {{ auth()->user()->name }}.</div>
  </div>
  <a href="{{ route('admin.characters.create') }}" class="btn btn-primary">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    New Character
  </a>
</div>

{{-- STATS --}}
<div class="stat-grid">
  <div class="stat-card c-purple">
    <div class="stat-icon"><svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg></div>
    <div class="stat-label">Total Users</div>
    <div class="stat-value">{{ number_format($stats['users']) }}</div>
    <div class="stat-sub">Registered players</div>
  </div>
  <div class="stat-card c-gold">
    <div class="stat-icon"><svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg></div>
    <div class="stat-label">Revenue</div>
    <div class="stat-value">${{ number_format($stats['revenue'],0) }}</div>
    <div class="stat-sub">Completed orders</div>
  </div>
  <div class="stat-card c-green">
    <div class="stat-icon"><svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg></div>
    <div class="stat-label">Orders</div>
    <div class="stat-value">{{ number_format($stats['orders']) }}</div>
    <div class="stat-sub">All time</div>
  </div>
  <div class="stat-card c-cyan">
    <div class="stat-icon"><svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
    <div class="stat-label">Characters</div>
    <div class="stat-value">{{ $stats['characters'] }}</div>
    <div class="stat-sub">{{ $stats['lore'] }} lore · {{ $stats['shop_items'] }} items</div>
  </div>
</div>

<div style="display:grid;grid-template-columns:1.4fr 1fr;gap:1.25rem;margin-bottom:1.25rem">
  {{-- RECENT ORDERS --}}
  <div class="card">
    <div class="card-hd">
      <span class="card-title">Recent Orders</span>
      <a href="{{ route('admin.orders.index') }}" class="btn btn-xs btn-outline">View All</a>
    </div>
    <div class="tw">
      <table>
        <thead><tr><th>Order</th><th>User</th><th>Amount</th><th>Status</th><th>Date</th></tr></thead>
        <tbody>
          @forelse($recentOrders as $order)
          <tr>
            <td>
              <a href="{{ route('admin.orders.show',$order->id) }}" style="color:var(--a2);font-weight:500">{{ $order->order_number }}</a>
            </td>
            <td style="color:var(--muted)">{{ $order->user->name ?? '—' }}</td>
            <td style="color:var(--gold);font-weight:600">${{ number_format($order->total,2) }}</td>
            <td>
              @php
                $bc=['pending'=>'badge-gray','paid'=>'badge-cyan','processing'=>'badge-gold','completed'=>'badge-green','cancelled'=>'badge-red','refunded'=>'badge-gray'];
                $bc2 = $bc[$order->status] ?? 'badge-gray';
              @endphp
              <span class="badge {{ $bc2 }}">{{ $order->status }}</span>
            </td>
            <td style="color:var(--muted);font-size:0.72rem">{{ $order->created_at->format('M d') }}</td>
          </tr>
          @empty
          <tr><td colspan="5" style="text-align:center;color:var(--muted);padding:2rem">No orders yet</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- ORDER STATUS --}}
  <div class="card">
    <div class="card-hd"><span class="card-title">Order Breakdown</span></div>
    <div class="card-body">
      @php
        $statusColors=['pending'=>'#9ca3af','paid'=>'#22d3ee','processing'=>'#f59e0b','completed'=>'#10b981','cancelled'=>'#ef4444','refunded'=>'#6b7280'];
        $totalOrders=$ordersByStatus->sum();
      @endphp
      @if($totalOrders > 0)
        @foreach($ordersByStatus as $status => $count)
        @php $sc = $statusColors[$status] ?? '#9ca3af'; $pct = round(($count/$totalOrders)*100); @endphp
        <div style="margin-bottom:0.9rem">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.28rem">
            <span style="font-size:0.7rem;color:var(--muted);text-transform:capitalize;font-family:var(--fh);letter-spacing:0.06em">{{ $status }}</span>
            <span style="font-size:0.7rem;font-weight:600;color:{{ $sc }}">{{ $count }}</span>
          </div>
          <div style="height:3px;background:rgba(255,255,255,0.04);border-radius:2px;overflow:hidden">
            <div style="height:100%;background:{{ $sc }};width:{{ $pct }}%;border-radius:2px;transition:width 1s"></div>
          </div>
        </div>
        @endforeach
      @else
        <p style="color:var(--muted);text-align:center;padding:2rem;font-size:0.78rem">No orders yet</p>
      @endif
    </div>
  </div>
</div>

<div style="display:grid;grid-template-columns:1.4fr 1fr;gap:1.25rem">
  {{-- RECENT USERS --}}
  <div class="card">
    <div class="card-hd">
      <span class="card-title">Recent Users</span>
      <a href="{{ route('admin.users.index') }}" class="btn btn-xs btn-outline">View All</a>
    </div>
    <div class="tw">
      <table>
        <thead><tr><th>User</th><th>Email</th><th>Joined</th></tr></thead>
        <tbody>
          @forelse($recentUsers as $user)
          <tr>
            <td>
              <div style="display:flex;align-items:center;gap:0.6rem">
                <div style="width:26px;height:26px;border-radius:50%;background:linear-gradient(135deg,var(--a),var(--gold));display:flex;align-items:center;justify-content:center;font-size:0.6rem;font-weight:700;color:#fff;flex-shrink:0;font-family:var(--fh)">{{ strtoupper(substr($user->name,0,1)) }}</div>
                <span style="font-weight:500">{{ $user->name }}</span>
              </div>
            </td>
            <td style="color:var(--muted)">{{ $user->email }}</td>
            <td style="color:var(--muted);font-size:0.72rem">{{ $user->created_at->diffForHumans() }}</td>
          </tr>
          @empty
          <tr><td colspan="3" style="text-align:center;color:var(--muted);padding:2rem">No users yet</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- QUICK ACTIONS --}}
  <div class="card">
    <div class="card-hd"><span class="card-title">Quick Actions</span></div>
    <div class="card-body">
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.6rem;margin-bottom:1.25rem">
        @foreach([
          ['admin.characters.create','New Character','btn-primary'],
          ['admin.elements.create','New Element','btn-outline'],
          ['admin.stories.create','New Chapter','btn-outline'],
          ['admin.lore.create','New Lore','btn-outline'],
          ['admin.timeline.create','New Event','btn-outline'],
          ['admin.shop.create','New Item','btn-outline'],
        ] as [$rt,$lbl,$cls])
        <a href="{{ route($rt) }}" class="btn {{ $cls }}" style="justify-content:center;font-size:0.62rem">{{ $lbl }}</a>
        @endforeach
      </div>

      <div style="border-top:1px solid var(--b1);padding-top:1rem">
        <div style="font-size:0.58rem;letter-spacing:0.25em;text-transform:uppercase;color:var(--muted);margin-bottom:0.65rem;font-family:var(--fh)">Content Summary</div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.4rem">
          @foreach([
            ['Characters',\App\Models\Character::count()],
            ['Elements',\App\Models\Element::count()],
            ['Chapters',\App\Models\Story::count()],
            ['Lore',\App\Models\LoreEntry::count()],
            ['Events',\App\Models\TimelineEvent::count()],
            ['Shop',\App\Models\ShopItem::count()],
          ] as [$lbl,$cnt])
          <div style="display:flex;justify-content:space-between;padding:0.35rem 0.6rem;background:var(--bg2);border-radius:2px;border:1px solid var(--b1)">
            <span style="font-size:0.68rem;color:var(--muted)">{{ $lbl }}</span>
            <span style="font-size:0.68rem;font-weight:600;color:var(--a2)">{{ $cnt }}</span>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
