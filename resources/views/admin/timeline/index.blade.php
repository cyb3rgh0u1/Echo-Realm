@extends('layouts.admin')
@section('title','Timeline Events')
@section('content')
<div class="page-header">
  <div><div class="page-title">Timeline</div><div class="page-sub">{{ $events->total() }} events</div></div>
  <a href="{{ route('admin.timeline.create') }}" class="btn btn-primary">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    New Event
  </a>
</div>
<div class="card">
  <div class="tw">
    <table>
      <thead><tr><th>Event</th><th>Era</th><th>Year</th><th>Type</th><th>Published</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse($events as $ev)
        <tr>
          <td>
            <div style="display:flex;align-items:center;gap:0.6rem">
              <div style="width:3px;height:32px;border-radius:2px;background:{{ $ev->color }};flex-shrink:0"></div>
              <div>
                <div style="font-weight:500;font-size:0.82rem">{{ $ev->title }}</div>
                <div style="color:var(--muted);font-size:0.7rem">{{ Str::limit($ev->description,50) }}</div>
              </div>
            </div>
          </td>
          <td style="color:var(--muted);font-size:0.76rem">{{ $ev->era }}</td>
          <td style="color:var(--muted);font-size:0.72rem">{{ $ev->year_in_lore }}</td>
          <td><span class="badge" style="background:{{ $ev->color }}12;color:{{ $ev->color }};border:1px solid {{ $ev->color }}28">{{ ucfirst($ev->type) }}</span></td>
          <td>@if($ev->is_published)<span class="badge badge-green">Live</span>@else<span class="badge badge-gray">Draft</span>@endif</td>
          <td>
            <div class="td-actions">
              <a href="{{ route('admin.timeline.edit',$ev->id) }}" class="btn btn-xs btn-success">Edit</a>
              <form action="{{ route('admin.timeline.destroy',$ev->id) }}" method="POST" onsubmit="return confirm('Delete?')">
                @csrf @method('DELETE')<button type="submit" class="btn btn-xs btn-danger">Delete</button>
              </form>
            </div>
          </td>
        </tr>
        @empty<tr><td colspan="6" style="text-align:center;color:var(--muted);padding:2rem">No events.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($events->hasPages())<div style="padding:1rem 1.25rem;border-top:1px solid var(--b1)">{{ $events->links() }}</div>@endif
</div>
@endsection
