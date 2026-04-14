@extends('layouts.admin')
@section('title','Shop Items')
@section('content')
<div class="page-header">
  <div><div class="page-title">Shop Items</div><div class="page-sub">{{ $items->total() }} items</div></div>
  <a href="{{ route('admin.shop.create') }}" class="btn btn-primary">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    New Item
  </a>
</div>
<div class="card">
  <div class="tw">
    <table>
      <thead><tr><th>Item</th><th>Type</th><th>Rarity</th><th>Price</th><th>Stock</th><th>Featured</th><th>Active</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse($items as $item)
        <tr>
          <td>
            <div style="display:flex;align-items:center;gap:0.75rem">
              <div style="width:36px;height:36px;border-radius:4px;background:var(--bg2);border:1px solid var(--b1);display:flex;align-items:center;justify-content:center;flex-shrink:0;overflow:hidden">
                @if($item->image)
                  <img src="{{ asset('storage/'.$item->image) }}" style="width:100%;height:100%;object-fit:cover">
                @else
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--muted)" stroke-width="1.5"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>
                @endif
              </div>
              <div>
                <div style="font-weight:500;font-size:0.82rem">{{ $item->name }}</div>
                <div style="color:var(--muted);font-size:0.7rem">{{ Str::limit($item->description,45) }}</div>
              </div>
            </div>
          </td>
          <td style="color:var(--muted);font-size:0.76rem;text-transform:capitalize">{{ $item->type }}</td>
          <td><span class="badge badge-{{ $item->rarity }}">{{ ucfirst($item->rarity) }}</span></td>
          <td>
            <span style="color:var(--gold);font-weight:600;font-size:0.82rem">${{ number_format($item->price,2) }}</span>
            @if($item->original_price)<div style="color:var(--muted);font-size:0.68rem;text-decoration:line-through">${{ number_format($item->original_price,2) }}</div>@endif
          </td>
          <td style="color:var(--muted);font-size:0.76rem">{{ $item->stock === -1 ? '∞' : $item->stock }}</td>
          <td>
            <a href="{{ route('admin.shop.toggle-featured',$item->id) }}" class="badge {{ $item->is_featured ? 'badge-gold' : 'badge-gray' }}" style="cursor:pointer">
              {{ $item->is_featured ? 'Featured' : 'No' }}
            </a>
          </td>
          <td>@if($item->is_active)<span class="badge badge-green">Active</span>@else<span class="badge badge-red">Off</span>@endif</td>
          <td>
            <div class="td-actions">
              <a href="{{ route('admin.shop.edit',$item->id) }}" class="btn btn-xs btn-success">Edit</a>
              <form action="{{ route('admin.shop.destroy',$item->id) }}" method="POST" onsubmit="return confirm('Delete?')">
                @csrf @method('DELETE')<button type="submit" class="btn btn-xs btn-danger">Delete</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="8" style="text-align:center;color:var(--muted);padding:2rem">No items.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($items->hasPages())<div style="padding:1rem 1.25rem;border-top:1px solid var(--b1)">{{ $items->links() }}</div>@endif
</div>
@endsection
