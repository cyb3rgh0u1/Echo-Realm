@extends('layouts.admin')
@section('title','Edit User')
@section('content')
<div class="breadcrumb"><a href="{{ route('admin.users.index') }}">Users</a><span>/</span><span>Edit: {{ $user->name }}</span></div>
<div class="page-header"><div class="page-title">Edit User</div></div>
<div style="max-width:500px">
<div class="card">
  <div class="card-body">
    <form action="{{ route('admin.users.update',$user->id) }}" method="POST">
      @csrf @method('PUT')
      <div class="form-group"><label class="form-label">Name</label><input type="text" name="name" class="form-control" value="{{ old('name',$user->name) }}" required></div>
      <div class="form-group"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ old('email',$user->email) }}" required></div>
      <div style="display:flex;gap:0.75rem;margin-top:1rem">
        <button type="submit" class="btn btn-primary">Update User</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline">Cancel</a>
      </div>
    </form>
  </div>
</div>
</div>
@endsection
