@extends('layouts.admin')
@section('title', isset($story) ? 'Edit Story' : 'New Chapter')
@section('content')
<div class="breadcrumb"><a href="{{ route('admin.stories.index') }}">Stories</a><span>/</span><span>{{ isset($story)?'Edit':'New' }}</span></div>
<div class="page-header"><div class="page-title">{{ isset($story)?'Edit: '.$story->title:'New Chapter' }}</div></div>
<form action="{{ isset($story)?route('admin.stories.update',$story->id):route('admin.stories.store') }}" method="POST">
  @csrf @if(isset($story)) @method('PUT') @endif
  <div style="display:grid;grid-template-columns:2fr 1fr;gap:1.25rem;align-items:start">
    <div>
      <div class="card" style="margin-bottom:1.25rem">
        <div class="card-body">
          <div class="form-group"><label class="form-label">Title *</label><input type="text" name="title" class="form-control" value="{{ old('title',$story->title??'') }}" required></div>
          <div class="form-group"><label class="form-label">Synopsis *</label><textarea name="synopsis" class="form-control" rows="3" required>{{ old('synopsis',$story->synopsis??'') }}</textarea></div>
          <div class="form-group"><label class="form-label">Story Content * (HTML supported)</label><textarea name="content" class="form-control" rows="20" required>{{ old('content',$story->content??'') }}</textarea></div>
        </div>
      </div>
    </div>
    <div>
      <div class="card" style="margin-bottom:1.25rem">
        <div class="card-body">
          <div class="form-grid">
            <div class="form-group"><label class="form-label">Arc Number *</label><input type="number" name="arc_number" class="form-control" value="{{ old('arc_number',$story->arc_number??1) }}" min="1" required></div>
            <div class="form-group"><label class="form-label">Chapter Number *</label><input type="number" name="chapter_number" class="form-control" value="{{ old('chapter_number',$story->chapter_number??1) }}" min="1" required></div>
          </div>
          <div class="form-group"><label class="form-label">Status</label>
            <select name="status" class="form-control">
              @foreach(['ongoing','completed','hiatus'] as $s)<option value="{{ $s }}" {{ old('status',$story->status??'ongoing')===$s?'selected':'' }}>{{ ucfirst($s) }}</option>@endforeach
            </select>
          </div>
          <div class="form-group"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$story->sort_order??0) }}"></div>
          <label class="form-check"><input type="checkbox" name="is_published" value="1" {{ old('is_published',($story->is_published??true))?'checked':'' }}><span class="form-check-label">Published</span></label>
        </div>
      </div>
      <div style="display:flex;gap:0.75rem">
        <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center">{{ isset($story)?'✓ Update':'+ Create' }}</button>
        <a href="{{ route('admin.stories.index') }}" class="btn btn-outline">Cancel</a>
      </div>
    </div>
  </div>
</form>
@endsection
