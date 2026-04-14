@extends('layouts.admin')
@section('title','Story Arcs')
@section('content')
<div class="page-header">
  <div><div class="page-title">Story Arcs</div><div class="page-sub">{{ $stories->total() }} chapters</div></div>
  <a href="{{ route('admin.stories.create') }}" class="btn btn-primary">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    New Chapter
  </a>
</div>
<div class="card">
  <div class="tw">
    <table>
      <thead><tr><th>Chapter</th><th>Arc</th><th>Status</th><th>Published</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse($stories as $story)
        <tr>
          <td>
            <div style="font-weight:500;font-size:0.82rem">{{ $story->title }}</div>
            <div style="color:var(--muted);font-size:0.7rem">{{ Str::limit($story->synopsis,55) }}</div>
          </td>
          <td><span class="badge badge-purple">Arc {{ $story->arc_number }} · Ch. {{ $story->chapter_number }}</span></td>
          <td>
            @if($story->status==='ongoing')<span class="badge badge-green">Ongoing</span>
            @elseif($story->status==='completed')<span class="badge badge-purple">Completed</span>
            @else<span class="badge badge-gold">Hiatus</span>@endif
          </td>
          <td>@if($story->is_published)<span class="badge badge-green">Live</span>@else<span class="badge badge-gray">Draft</span>@endif</td>
          <td>
            <div class="td-actions">
              <a href="{{ route('admin.stories.edit',$story->id) }}" class="btn btn-xs btn-success">Edit</a>
              <form action="{{ route('admin.stories.destroy',$story->id) }}" method="POST" onsubmit="return confirm('Delete?')">
                @csrf @method('DELETE')<button type="submit" class="btn btn-xs btn-danger">Delete</button>
              </form>
            </div>
          </td>
        </tr>
        @empty<tr><td colspan="5" style="text-align:center;color:var(--muted);padding:2rem">No chapters yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($stories->hasPages())<div style="padding:1rem 1.25rem;border-top:1px solid var(--b1)">{{ $stories->links() }}</div>@endif
</div>
@endsection
