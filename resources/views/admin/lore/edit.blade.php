@extends('layouts.admin')
@section('title', isset($lore) ? 'Edit Lore' : 'New Lore Entry')
@section('content')
<div class="breadcrumb"><a href="{{ route('admin.lore.index') }}">Lore</a><span>/</span><span>{{ isset($lore) ? 'Edit' : 'New' }}</span></div>
<div class="page-header"><div class="page-title">{{ isset($lore) ? 'Edit: '.$lore->title : 'New Lore Entry' }}</div></div>
<form action="{{ isset($lore) ? route('admin.lore.update',$lore->id) : route('admin.lore.store') }}" method="POST">
  @csrf @if(isset($lore)) @method('PUT') @endif
  <div style="display:grid;grid-template-columns:2fr 1fr;gap:1.25rem;align-items:start">
    <div>
      <div class="card" style="margin-bottom:1.25rem">
        <div class="card-body">
          <div class="form-group"><label class="form-label">Title *</label><input type="text" name="title" class="form-control" value="{{ old('title',$lore->title??'') }}" required></div>
          <div class="form-group"><label class="form-label">Excerpt</label><textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt',$lore->excerpt??'') }}</textarea></div>
          <div class="form-group"><label class="form-label">Full Content * (HTML supported)</label><textarea name="content" class="form-control" rows="16" required>{{ old('content',$lore->content??'') }}</textarea></div>
        </div>
      </div>
    </div>
    <div>
      <div class="card" style="margin-bottom:1.25rem">
        <div class="card-body">
          <div class="form-group"><label class="form-label">Category</label><input type="text" name="category" class="form-control" value="{{ old('category',$lore->category??'general') }}" placeholder="history, faction, bestiary..."></div>
          <div class="form-group"><label class="form-label">Classification</label>
            <select name="classification" class="form-control">
              @foreach(['public','classified','top_secret'] as $c)<option value="{{$c}}" {{ old('classification',$lore->classification??'public')===$c?'selected':'' }}>{{ ucfirst(str_replace('_',' ',$c)) }}</option>@endforeach
            </select>
          </div>
          <div class="form-group"><label class="form-label">Read Time (minutes)</label><input type="number" name="read_time" class="form-control" value="{{ old('read_time',$lore->read_time??5) }}" min="1"></div>
          <div class="form-group"><label class="form-label">Tags (comma separated)</label><input type="text" name="tags" class="form-control" value="{{ old('tags', isset($lore) && $lore->tags ? implode(',',$lore->tags) : '') }}" placeholder="resonance, pillar, void"></div>
          <div class="form-group"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$lore->sort_order??0) }}"></div>
          <label class="form-check"><input type="checkbox" name="is_published" value="1" {{ old('is_published',($lore->is_published??true))?'checked':'' }}><span class="form-check-label">Published</span></label>
        </div>
      </div>
      <div style="display:flex;gap:0.75rem">
        <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center">{{ isset($lore)?'✓ Update':'+ Create' }}</button>
        <a href="{{ route('admin.lore.index') }}" class="btn btn-outline">Cancel</a>
      </div>
    </div>
  </div>
</form>
@endsection
