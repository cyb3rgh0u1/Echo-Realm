@extends('layouts.admin')
@section('title','Elements')
@section('content')
<div class="page-header">
  <div><div class="page-title">Elements</div><div class="page-sub">{{ $elements->count() }} elements</div></div>
  <a href="{{ route('admin.elements.create') }}" class="btn btn-primary">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    New Element
  </a>
</div>
<div class="card">
  <div class="tw">
    <table>
      <thead><tr><th>Element</th><th>Color</th><th>Characters</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse($elements as $el)
        <tr>
          <td>
            <div style="display:flex;align-items:center;gap:0.75rem">
              <div style="width:34px;height:34px;border-radius:4px;background:{{ $el->color }}12;border:1px solid {{ $el->color }}28;flex-shrink:0"></div>
              <div>
                <div style="font-weight:500;font-size:0.82rem">{{ $el->name }}</div>
                <div style="color:var(--muted);font-size:0.7rem">{{ Str::limit($el->description,55) }}</div>
              </div>
            </div>
          </td>
          <td>
            <div style="display:flex;align-items:center;gap:0.5rem">
              <div style="width:12px;height:12px;border-radius:50%;background:{{ $el->color }};flex-shrink:0"></div>
              <code style="font-size:0.7rem;color:var(--muted)">{{ $el->color }}</code>
            </div>
          </td>
          <td><span class="badge badge-purple">{{ $el->characters_count }}</span></td>
          <td>
            <div class="td-actions">
              <a href="{{ route('admin.elements.edit',$el->id) }}" class="btn btn-xs btn-success">Edit</a>
              <form action="{{ route('admin.elements.destroy',$el->id) }}" method="POST" onsubmit="return confirm('Delete {{ $el->name }}?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-xs btn-danger">Delete</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="4" style="text-align:center;color:var(--muted);padding:2rem">No elements yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
