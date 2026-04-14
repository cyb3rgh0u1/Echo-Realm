@extends('layouts.admin')
@section('title',$character->name)
@section('content')
<div class="breadcrumb">
  <a href="{{ route('admin.characters.index') }}">Characters</a>
  <span>/</span><span>{{ $character->name }}</span>
</div>
<div class="page-header">
  <div><div class="page-title">{{ $character->name }}</div>@if($character->title)<div class="page-subtitle">{{ $character->title }}</div>@endif</div>
  <div style="display:flex;gap:0.5rem">
    <a href="{{ route('admin.characters.edit',$character->id) }}" class="btn btn-primary">Edit</a>
    <a href="{{ route('admin.characters.index') }}" class="btn btn-outline">← Back</a>
  </div>
</div>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem">
  <div class="card">
    <div class="card-header"><span class="card-title">Character Details</span></div>
    <div class="card-body" style="display:grid;gap:0.75rem">
      <div style="display:flex;gap:0.75rem;flex-wrap:wrap">
        <span class="badge badge-{{ $character->rarity }}">{{ ucfirst($character->rarity) }}</span>
        @if($character->element)<span style="padding:0.2rem 0.6rem;border-radius:4px;font-size:0.65rem;background:{{ $character->element->color }}18;color:{{ $character->element->color }};border:1px solid {{ $character->element->color }}33">{{ $character->element->symbol }} {{ $character->element->name }}</span>@endif
        <span class="badge badge-gray">{{ ucfirst($character->role) }}</span>
        @if($character->is_featured)<span class="badge badge-gold">⭐ Featured</span>@endif
        @if($character->is_published)<span class="badge badge-green">✓ Published</span>@else<span class="badge badge-gray">Draft</span>@endif
      </div>
      @if($character->faction)<div><span style="font-size:0.65rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--muted)">Faction:</span> {{ $character->faction }}</div>@endif
      @if($character->weapon_type)<div><span style="font-size:0.65rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--muted)">Weapon:</span> {{ $character->weapon_type }}</div>@endif
      <div style="font-size:0.82rem;color:var(--muted);line-height:1.7">{{ $character->bio }}</div>
    </div>
  </div>
  @if($character->stats)
  <div class="card">
    <div class="card-header"><span class="card-title">Stats</span></div>
    <div class="card-body">
      @foreach($character->stats as $k=>$v)
      <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:0.5rem">
        <span style="font-size:0.65rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--muted);width:60px">{{ strtoupper($k) }}</span>
        <div style="flex:1;height:5px;background:var(--surface);border-radius:3px;overflow:hidden"><div style="height:100%;border-radius:3px;background:var(--accent);width:{{ min($v,100) }}%"></div></div>
        <span style="font-size:0.75rem;color:var(--muted);width:28px;text-align:right">{{ $v }}</span>
      </div>
      @endforeach
    </div>
  </div>
  @endif
</div>
@if($character->abilities)
<div class="card" style="margin-top:1.25rem">
  <div class="card-header"><span class="card-title">Abilities</span></div>
  <div class="card-body" style="display:grid;gap:0.75rem">
    @foreach($character->abilities as $ab)
    <div style="padding:0.85rem;background:var(--surface);border:1px solid var(--border);border-radius:8px;border-left:3px solid {{ $ab['type']==='ultimate'?'var(--gold)':($ab['type']==='passive'?'var(--green)':'var(--accent)') }}">
      <div style="font-size:0.6rem;letter-spacing:0.2em;text-transform:uppercase;color:{{ $ab['type']==='ultimate'?'var(--gold)':($ab['type']==='passive'?'var(--green)':'var(--accent)') }};margin-bottom:0.25rem">{{ strtoupper($ab['type']??'ACTIVE') }}</div>
      <div style="font-weight:600;font-size:0.85rem;margin-bottom:0.25rem">{{ $ab['name'] }}</div>
      <div style="font-size:0.78rem;color:var(--muted)">{{ $ab['description'] }}</div>
    </div>
    @endforeach
  </div>
</div>
@endif
@endsection
