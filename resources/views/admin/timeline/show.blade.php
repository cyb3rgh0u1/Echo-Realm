@extends('layouts.admin')
@section('title', isset($timeline) ? 'Edit Event' : 'New Timeline Event')
@section('content')
<div class="breadcrumb"><a href="{{ route('admin.timeline.index') }}">Timeline</a><span>/</span><span>{{ isset($timeline)?'Edit':'New' }}</span></div>
<div class="page-header"><div class="page-title">{{ isset($timeline)?'Edit: '.$timeline->title:'New Timeline Event' }}</div></div>
<div style="max-width:700px">
<form action="{{ isset($timeline)?route('admin.timeline.update',$timeline->id):route('admin.timeline.store') }}" method="POST">
  @csrf @if(isset($timeline)) @method('PUT') @endif
  <div class="card">
    <div class="card-body">
      <div class="form-group"><label class="form-label">Title *</label><input type="text" name="title" class="form-control" value="{{ old('title',$timeline->title??'') }}" required></div>
      <div class="form-group"><label class="form-label">Description *</label><textarea name="description" class="form-control" rows="3" required>{{ old('description',$timeline->description??'') }}</textarea></div>
      <div class="form-group"><label class="form-label">Details (optional, HTML)</label><textarea name="details" class="form-control" rows="5">{{ old('details',$timeline->details??'') }}</textarea></div>
      <div class="form-grid">
        <div class="form-group"><label class="form-label">Era</label><input type="text" name="era" class="form-control" value="{{ old('era',$timeline->era??'') }}" placeholder="The First Age"></div>
        <div class="form-group"><label class="form-label">Year in Lore</label><input type="text" name="year_in_lore" class="form-control" value="{{ old('year_in_lore',$timeline->year_in_lore??'') }}" placeholder="Year 1,200"></div>
      </div>
      <div class="form-grid">
        <div class="form-group"><label class="form-label">Event Type</label>
          <select name="type" class="form-control">
            @foreach(['war','discovery','birth','death','catastrophe','miracle','political','cultural'] as $t)
            <option value="{{ $t }}" {{ old('type',$timeline->type??'cultural')===$t?'selected':'' }}>{{ ucfirst($t) }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group"><label class="form-label">Color</label><input type="color" name="color" class="form-control" value="{{ old('color',$timeline->color??'#a855f7') }}" style="height:42px;padding:0.25rem"></div>
      </div>
      <div class="form-grid">
        <div class="form-group"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$timeline->sort_order??0) }}"></div>
      </div>
      <label class="form-check"><input type="checkbox" name="is_published" value="1" {{ old('is_published',($timeline->is_published??true))?'checked':'' }}><span class="form-check-label">Published</span></label>
    </div>
  </div>
  <div style="display:flex;gap:0.75rem;margin-top:1rem">
    <button type="submit" class="btn btn-primary">{{ isset($timeline)?'✓ Update':'+ Create' }}</button>
    <a href="{{ route('admin.timeline.index') }}" class="btn btn-outline">Cancel</a>
  </div>
</form>
</div>
@endsection
