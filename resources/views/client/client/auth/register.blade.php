@extends('layouts.client')
@section('title','Register')
@push('styles')
<style>
.auth-wrapper{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:5rem 1.5rem}
.auth-card{width:100%;max-width:440px;background:var(--panel);border:1px solid var(--border);border-radius:16px;padding:2.5rem;position:relative;overflow:hidden}
.auth-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--accent),var(--gold))}
.form-group{margin-bottom:1.25rem}
.form-label{display:block;font-family:var(--font-heading);font-size:0.65rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--text-dim);margin-bottom:0.4rem}
.form-input{width:100%;background:var(--surface);border:1px solid var(--border);color:var(--text);padding:0.8rem 1rem;border-radius:6px;font-family:var(--font-body);font-size:0.9rem;outline:none;transition:border-color 0.2s}
.form-input:focus{border-color:var(--accent)}
.form-error{color:var(--red);font-size:0.75rem;margin-top:0.3rem}
</style>
@endpush
@section('content')
<div class="auth-wrapper">
  <div class="auth-card">
    <div style="text-align:center;margin-bottom:2rem">
      <div style="font-family:var(--font-display);font-size:1.4rem;font-weight:900;background:linear-gradient(135deg,var(--accent-bright),var(--gold));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">Echo-Realm</div>
      <div style="color:var(--text-muted);font-size:0.85rem;margin-top:0.4rem">Join the Realm. Find your Resonance.</div>
    </div>
    <form action="{{ route('register') }}" method="POST">
      @csrf
      <div class="form-group">
        <label class="form-label">Full Name</label>
        <input type="text" name="name" class="form-input" value="{{ old('name') }}" required>
        @error('name')<div class="form-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-input" value="{{ old('username') }}" required>
        @error('username')<div class="form-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-input" value="{{ old('email') }}" required>
        @error('email')<div class="form-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-input" required>
        @error('password')<div class="form-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-input" required>
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">Create Account</button>
    </form>
    <div style="text-align:center;margin-top:1.5rem;color:var(--text-muted);font-size:0.82rem">
      Already have an account? <a href="{{ route('login') }}" style="color:var(--accent);text-decoration:none">Login →</a>
    </div>
  </div>
</div>
@endsection
