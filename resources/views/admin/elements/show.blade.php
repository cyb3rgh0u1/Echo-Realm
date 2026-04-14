@extends('layouts.admin')
@section('title', isset($element) ? 'Edit Element' : 'New Element')
@section('content')
<div class="breadcrumb">
  <a href="{{ route('admin.elements.index') }}">Elements</a><span>/</span>
  <span>{{ isset($element) ? 'Edit: '.$element->name : 'New Element' }}</span>
</div>
<div class="page-header"><div class="page-title">{{ isset($element) ? 'Edit Element' : 'New Element' }}</div></div>
<div style="max-width:600px">
  <form action="{{ isset($element) ? route('admin.elements.update',$element->id) : route('admin.elements.store') }}" method="POST">
    @csrf @if(isset($element)) @method('PUT') @endif
    <div class="card">
      <div class="card-body">
        <div class="form-group"><label class="form-label">Name *</label><input type="text" name="name" class="form-control" value="{{ old('name',$element->name??'') }}" required></div>
        <div class="form-group"><label class="form-label">Symbol / Emoji</label><input type="text" name="symbol" class="form-control" value="{{ old('symbol',$element->symbol??'') }}" placeholder="🔥"></div>
        <div class="form-group"><label class="form-label">Description *</label><textarea name="description" class="form-control" rows="3" required>{{ old('description',$element->description??'') }}</textarea></div>
        <div class="form-grid">
          <div class="form-group"><label class="form-label">Primary Color *</label><input type="color" name="color" class="form-control" value="{{ old('color',$element->color??'#a855f7') }}" required style="height:42px;padding:0.25rem"><div class="form-hint">Main element color (hex)</div></div>
          <div class="form-group"><label class="form-label">Glow Color *</label><input type="color" name="glow_color" class="form-control" value="{{ old('glow_color',$element->glow_color??'#c084fc') }}" required style="height:42px;padding:0.25rem"><div class="form-hint">Used for particle effects</div></div>
        </div>
      </div>
    </div>
    <div style="display:flex;gap:0.75rem;margin-top:1rem">
      <button type="submit" class="btn btn-primary">{{ isset($element) ? '✓ Update' : '+ Create' }} Element</button>
      <a href="{{ route('admin.elements.index') }}" class="btn btn-outline">Cancel</a>
    </div>
  </form>
</div>
@endsection
