@extends('layouts.admin')
@section('title','Characters')
@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Characters</div>
    <div class="page-sub">{{ $characters->total() }} total</div>
  </div>
  <a href="{{ route('admin.characters.create') }}" class="btn btn-primary">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    New Character
  </a>
</div>
<div class="card">
  <div class="tw">
    <table>
      <thead><tr><th>Character</th><th>Element</th><th>Rarity</th><th>Role</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse($characters as $char)
        <tr>
          <td>
            <div style="display:flex;align-items:center;gap:0.75rem">
              <div style="width:36px;height:36px;border-radius:4px;background:var(--bg2);border:1px solid var(--b1);display:flex;align-items:center;justify-content:center;flex-shrink:0;overflow:hidden">
                @if($char->image)
                  <img src="{{ asset('storage/'.$char->image) }}" style="width:100%;height:100%;object-fit:cover">
                @else
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--muted)" stroke-width="1.5"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                @endif
              </div>
              <div>
                <div style="font-weight:500;font-size:0.82rem">{{ $char->name }}</div>
                @if($char->title)<div style="color:var(--muted);font-size:0.68rem;font-style:italic">{{ $char->title }}</div>@endif
              </div>
            </div>
          </td>
          <td>
            @if($char->element)
            <span style="display:inline-flex;align-items:center;gap:0.3rem;font-size:0.7rem;padding:0.18rem 0.5rem;border-radius:2px;background:{{ $char->element->color }}12;color:{{ $char->element->color }};border:1px solid {{ $char->element->color }}28;font-family:var(--fh)">
              {{ $char->element->name }}
            </span>
            @else<span style="color:var(--dim)">—</span>@endif
          </td>
          <td><span class="badge badge-{{ $char->rarity }}">{{ ucfirst($char->rarity) }}</span></td>
          <td style="color:var(--muted);text-transform:capitalize;font-size:0.76rem">{{ $char->role }}</td>
          <td>
            <div style="display:flex;gap:0.3rem;flex-wrap:wrap">
              @if($char->is_published)<span class="badge badge-green">Live</span>@else<span class="badge badge-gray">Draft</span>@endif
              @if($char->is_featured)<span class="badge badge-gold">Featured</span>@endif
            </div>
          </td>
          <td>
            <div class="td-actions">
              <a href="{{ route('admin.characters.show',$char->id) }}" class="btn btn-xs btn-outline">View</a>
              <a href="{{ route('admin.characters.edit',$char->id) }}" class="btn btn-xs btn-success">Edit</a>
              <form action="{{ route('admin.characters.destroy',$char->id) }}" method="POST" onsubmit="return confirm('Delete {{ $char->name }}?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-xs btn-danger">Delete</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:3rem">
          No characters yet. <a href="{{ route('admin.characters.create') }}" style="color:var(--a2)">Create one</a>
        </td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($characters->hasPages())<div style="padding:1rem 1.25rem;border-top:1px solid var(--b1)">{{ $characters->links() }}</div>@endif
</div>
@endsection
