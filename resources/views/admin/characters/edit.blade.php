@extends('layouts.admin')
@section('title', 'Edit: '.$character->name)
@section('content')
@php
// Reuse create view with character data in scope
@endphp

<div class="breadcrumb">
  <a href="{{ route('admin.characters.index') }}">Characters</a>
  <span>/</span>
  <span>Edit: {{ $character->name }}</span>
</div>

<div class="page-header">
  <div class="page-title">Edit: {{ $character->name }}</div>
  <a href="{{ route('admin.characters.show',$character->id) }}" class="btn btn-outline">View Profile</a>
</div>

<form action="{{ route('admin.characters.update',$character->id) }}" method="POST" enctype="multipart/form-data">
  @csrf @method('PUT')
  <div style="display:grid;grid-template-columns:2fr 1fr;gap:1.25rem;align-items:start">
    <div>
      <div class="card" style="margin-bottom:1.25rem">
        <div class="card-header"><span class="card-title">Basic Info</span></div>
        <div class="card-body">
          <div class="form-grid">
            <div class="form-group">
              <label class="form-label">Name *</label>
              <input type="text" name="name" class="form-control" value="{{ old('name',$character->name) }}" required>
            </div>
            <div class="form-group">
              <label class="form-label">Title / Epithet</label>
              <input type="text" name="title" class="form-control" value="{{ old('title',$character->title) }}">
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Bio *</label>
            <textarea name="bio" class="form-control" rows="4" required>{{ old('bio',$character->bio) }}</textarea>
          </div>
          <div class="form-group">
            <label class="form-label">Full Lore (HTML supported)</label>
            <textarea name="lore" class="form-control" rows="8">{{ old('lore',$character->lore) }}</textarea>
          </div>
        </div>
      </div>
      <div class="card" style="margin-bottom:1.25rem">
        <div class="card-header"><span class="card-title">Stats JSON</span></div>
        <div class="card-body">
          <div class="form-group">
            <textarea name="stats" class="form-control" rows="4" placeholder='{"attack":95,"defense":70,"speed":85,"magic":88,"hp":1240}'>{{ old('stats', $character->stats ? json_encode($character->stats,JSON_PRETTY_PRINT) : '') }}</textarea>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header"><span class="card-title">Abilities JSON</span></div>
        <div class="card-body">
          <div class="form-group">
            <textarea name="abilities_json" class="form-control" rows="10">{{ old('abilities_json', $character->abilities ? json_encode($character->abilities,JSON_PRETTY_PRINT) : '') }}</textarea>
          </div>
        </div>
      </div>
    </div>
    <div>
      <div class="card" style="margin-bottom:1.25rem">
        <div class="card-header"><span class="card-title">Classification</span></div>
        <div class="card-body">
          <div class="form-group">
            <label class="form-label">Element</label>
            <select name="element_id" class="form-control">
              <option value="">— None —</option>
              @foreach($elements as $el)
              <option value="{{ $el->id }}" {{ old('element_id',$character->element_id) == $el->id ? 'selected' : '' }}>{{ $el->symbol }} {{ $el->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Rarity</label>
            <select name="rarity" class="form-control">
              @foreach(['common','uncommon','rare','epic','legendary'] as $r)
              <option value="{{ $r }}" {{ old('rarity',$character->rarity) === $r ? 'selected' : '' }}>{{ ucfirst($r) }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Role</label>
            <select name="role" class="form-control">
              @foreach(['warrior','mage','healer','ranger','assassin','tank','support'] as $r)
              <option value="{{ $r }}" {{ old('role',$character->role) === $r ? 'selected' : '' }}>{{ ucfirst($r) }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Faction</label>
            <input type="text" name="faction" class="form-control" value="{{ old('faction',$character->faction) }}">
          </div>
          <div class="form-group">
            <label class="form-label">Weapon Type</label>
            <input type="text" name="weapon_type" class="form-control" value="{{ old('weapon_type',$character->weapon_type) }}">
          </div>
          <div class="form-group">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$character->sort_order) }}">
          </div>
        </div>
      </div>
      <div class="card" style="margin-bottom:1.25rem">
        <div class="card-header"><span class="card-title">Image</span></div>
        <div class="card-body">
          @if($character->image)
          <div style="margin-bottom:0.75rem;text-align:center"><img src="{{ asset('storage/'.$character->image) }}" style="max-height:120px;border-radius:6px;border:1px solid var(--border)"></div>
          @endif
          <input type="file" name="image" class="form-control" accept="image/*">
          <div class="form-hint">Leave blank to keep existing image</div>
        </div>
      </div>
      <div class="card" style="margin-bottom:1.25rem">
        <div class="card-header"><span class="card-title">Visibility</span></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:0.75rem">
          <label class="form-check"><input type="checkbox" name="is_published" value="1" {{ $character->is_published ? 'checked' : '' }}><span class="form-check-label">Published</span></label>
          <label class="form-check"><input type="checkbox" name="is_featured" value="1" {{ $character->is_featured ? 'checked' : '' }}><span class="form-check-label">Featured on homepage</span></label>
          <label class="form-check"><input type="checkbox" name="is_playable" value="1" {{ $character->is_playable ? 'checked' : '' }}><span class="form-check-label">Playable character</span></label>
        </div>
      </div>
      <div style="display:flex;gap:0.75rem">
        <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center">✓ Update Character</button>
        <a href="{{ route('admin.characters.index') }}" class="btn btn-outline">Cancel</a>
      </div>
    </div>
  </div>
</form>
@endsection
