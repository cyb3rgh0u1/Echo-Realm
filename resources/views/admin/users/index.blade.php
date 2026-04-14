@extends('layouts.admin')
@section('title','Users')
@section('content')
<div class="page-header">
  <div><div class="page-title">Users</div><div class="page-sub">{{ $users->total() }} registered</div></div>
</div>
<form method="GET" class="search-bar">
  <input type="text" name="search" class="search-input" placeholder="Search by name or email..." value="{{ request('search') }}">
  <button type="submit" class="btn btn-outline">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
    Search
  </button>
  @if(request('search'))<a href="{{ route('admin.users.index') }}" class="btn btn-outline">Clear</a>@endif
</form>
<div class="card">
  <div class="tw">
    <table>
      <thead><tr><th>User</th><th>Email</th><th>Orders</th><th>Joined</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse($users as $user)
        <tr>
          <td>
            <div style="display:flex;align-items:center;gap:0.6rem">
              <div style="width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,var(--a),var(--gold));display:flex;align-items:center;justify-content:center;font-size:0.62rem;font-weight:700;color:#fff;flex-shrink:0;font-family:var(--fh)">{{ strtoupper(substr($user->name,0,1)) }}</div>
              <div>
                <div style="font-weight:500;font-size:0.82rem">{{ $user->name }}</div>
                <div style="color:var(--muted);font-size:0.68rem">{{ '@'.$user->username }}</div>
              </div>
            </div>
          </td>
          <td style="color:var(--muted);font-size:0.78rem">{{ $user->email }}</td>
          <td><span class="badge badge-gray">{{ $user->orders->count() }}</span></td>
          <td style="color:var(--muted);font-size:0.72rem">{{ $user->created_at->format('M d, Y') }}</td>
          <td>@if($user->is_banned)<span class="badge badge-red">Banned</span>@else<span class="badge badge-green">Active</span>@endif</td>
          <td>
            <div class="td-actions">
              <a href="{{ route('admin.users.show',$user->id) }}" class="btn btn-xs btn-outline">View</a>
              <form action="{{ route('admin.users.toggle-ban',$user->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-xs {{ $user->is_banned ? 'btn-success' : 'btn-danger' }}">
                  {{ $user->is_banned ? 'Unban' : 'Ban' }}
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:2rem">No users found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($users->hasPages())<div style="padding:1rem 1.25rem;border-top:1px solid var(--b1)">{{ $users->links() }}</div>@endif
</div>
@endsection
