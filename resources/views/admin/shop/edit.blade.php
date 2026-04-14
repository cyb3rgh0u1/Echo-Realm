@extends('layouts.admin')
@section('title', isset($shop) ? 'Edit Item' : 'New Shop Item')
@section('content')
<div class="breadcrumb"><a href="{{ route('admin.shop.index') }}">Shop</a><span>/</span><span>{{ isset($shop)?'Edit':'New' }}</span></div>
<div class="page-header"><div class="page-title">{{ isset($shop)?'Edit: '.$shop->name:'New Shop Item' }}</div></div>
<form action="{{ isset($shop)?route('admin.shop.update',$shop->id):route('admin.shop.store') }}" method="POST" enctype="multipart/form-data">
  @csrf @if(isset($shop)) @method('PUT') @endif
  <div style="display:grid;grid-template-columns:2fr 1fr;gap:1.25rem;align-items:start">
    <div>
      <div class="card" style="margin-bottom:1.25rem">
        <div class="card-body">
          <div class="form-group"><label class="form-label">Item Name *</label><input type="text" name="name" class="form-control" value="{{ old('name',$shop->name??'') }}" required></div>
          <div class="form-group"><label class="form-label">Description *</label><textarea name="description" class="form-control" rows="4" required>{{ old('description',$shop->description??'') }}</textarea></div>
          <div class="form-group"><label class="form-label">What's Included (one item per line)</label><textarea name="includes" class="form-control" rows="5" placeholder="Base game access&#10;All starter characters&#10;1000 Shards">{{ old('includes', isset($shop) && $shop->includes ? implode("\n",$shop->includes) : '') }}</textarea></div>
        </div>
      </div>
      <div class="card">
        <div class="card-header"><span class="card-title">Image</span></div>
        <div class="card-body">
          @if(isset($shop) && $shop->image)<div style="margin-bottom:0.75rem;text-align:center"><img src="{{ asset('storage/'.$shop->image) }}" style="max-height:100px;border-radius:6px;border:1px solid var(--border)"></div>@endif
          <input type="file" name="image" class="form-control" accept="image/*">
        </div>
      </div>
    </div>
    <div>
      <div class="card" style="margin-bottom:1.25rem">
        <div class="card-body">
          <div class="form-group"><label class="form-label">Type *</label>
            <select name="type" class="form-control">
              @foreach(['game','character','skin','bundle','currency','consumable','cosmetic'] as $t)<option value="{{$t}}" {{ old('type',$shop->type??'cosmetic')===$t?'selected':'' }}>{{ ucfirst($t) }}</option>@endforeach
            </select>
          </div>
          <div class="form-group"><label class="form-label">Rarity *</label>
            <select name="rarity" class="form-control">
              @foreach(['common','uncommon','rare','epic','legendary'] as $r)<option value="{{$r}}" {{ old('rarity',$shop->rarity??'common')===$r?'selected':'' }}>{{ ucfirst($r) }}</option>@endforeach
            </select>
          </div>
          <div class="form-group"><label class="form-label">Price ($) *</label><input type="number" name="price" class="form-control" value="{{ old('price',$shop->price??'') }}" step="0.01" min="0" required></div>
          <div class="form-group"><label class="form-label">Original Price ($)</label><input type="number" name="original_price" class="form-control" value="{{ old('original_price',$shop->original_price??'') }}" step="0.01" min="0"><div class="form-hint">Leave blank if no discount</div></div>
          <div class="form-group"><label class="form-label">Stock (-1 = unlimited)</label><input type="number" name="stock" class="form-control" value="{{ old('stock',$shop->stock??-1) }}"></div>
          <div style="display:flex;flex-direction:column;gap:0.6rem;margin-top:0.5rem">
            <label class="form-check"><input type="checkbox" name="is_active" value="1" {{ old('is_active',($shop->is_active??true))?'checked':'' }}><span class="form-check-label">Active (visible in shop)</span></label>
            <label class="form-check"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured',($shop->is_featured??false))?'checked':'' }}><span class="form-check-label">Featured (on homepage)</span></label>
          </div>
        </div>
      </div>
      <div style="display:flex;gap:0.75rem">
        <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center">{{ isset($shop)?'✓ Update':'+ Create' }}</button>
        <a href="{{ route('admin.shop.index') }}" class="btn btn-outline">Cancel</a>
      </div>
    </div>
  </div>
</form>
@endsection
