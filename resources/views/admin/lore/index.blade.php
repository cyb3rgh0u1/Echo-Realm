@extends('layouts.admin')
@section('title','Lore Tomes')
@section('content')
<div class="page-header">
  <div><div class="page-title">Lore Tomes</div><div class="page-sub">{{ $lore->total() }} entries</div></div>
  <a href="{{ route('admin.lore.create') }}" class="btn btn-primary">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    New Entry
  </a>
</div>
<div class="card">
  <div class="tw">
    <table>
      <thead><tr><th>Title</th><th>Category</th><th>Classification</th><th>Read Time</th><th>Published</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse($lore as $entry)
        <tr>
          <td>
            <div style="font-weight:500;font-size:0.82rem">{{ $entry->title }}</div>
            <div style="color:var(--muted);font-size:0.7rem">{{ Str::limit($entry->excerpt,55) }}</div>
          </td>
          <td style="color:var(--muted);font-size:0.76rem;text-transform:capitalize">{{ $entry->category }}</td>
          <td>
            @if($entry->classification === 'top_secret')<span class="badge badge-red">Top Secret</span>
            @elseif($entry->classification === 'classified')<span class="badge badge-gold">Classified</span>
            @else<span class="badge badge-purple">Public</span>@endif
          </td>
          <td style="color:var(--muted);font-size:0.76rem">{{ $entry->read_time }}m</td>
          <td>@if($entry->is_published)<span class="badge badge-green">Live</span>@else<span class="badge badge-gray">Draft</span>@endif</td>
          <td>
            <div class="td-actions">
              <a href="{{ route('admin.lore.edit',$entry->id) }}" class="btn btn-xs btn-success">Edit</a>
              <form action="{{ route('admin.lore.destroy',$entry->id) }}" method="POST" onsubmit="return confirm('Delete?')">
                @csrf @method('DELETE')<button type="submit" class="btn btn-xs btn-danger">Delete</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:2rem">No lore entries.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($lore->hasPages())<div style="padding:1rem 1.25rem;border-top:1px solid var(--b1)">{{ $lore->links() }}</div>@endif
</div>
@endsection
