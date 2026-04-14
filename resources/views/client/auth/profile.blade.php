@extends('layouts.client')
@section('title','My Profile')

@push('styles')
<style>
:root {
    --glass: rgba(255, 255, 255, 0.03);
    --glass-border: rgba(255, 255, 255, 0.08);
    --accent-glow: rgba(168, 85, 247, 0.15);
}

/* PROFILE HEADER */
.profile-header {
    display: flex;
    align-items: center;
    gap: 2rem;
    margin-bottom: 4rem;
    padding: 2.5rem;
    background: linear-gradient(90deg, var(--glass), transparent);
    border-radius: 24px;
    border: 1px solid var(--glass-border);
    backdrop-filter: blur(10px);
}

.avatar-glow {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--accent), var(--gold));
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--font-display);
    font-size: 2rem;
    font-weight: 900;
    color: #fff;
    box-shadow: 0 0 30px var(--accent-glow);
    flex-shrink: 0;
}

.profile-info h1 {
    font-family: var(--font-display);
    font-size: 2rem;
    letter-spacing: -0.02em;
    margin-bottom: 0.25rem;
    background: linear-gradient(to right, #fff, #999);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* STAT CARDS */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
    margin-bottom: 3rem;
}

.stat-card {
    background: var(--glass);
    border: 1px solid var(--glass-border);
    border-radius: 20px;
    padding: 2rem;
    text-align: center;
    transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
    position: relative;
    overflow: hidden;
}

.stat-card:hover {
    border-color: var(--accent);
    transform: translateY(-5px);
    background: rgba(168, 85, 247, 0.05);
}

.stat-svg {
    width: 24px;
    height: 24px;
    margin: 0 auto 1.25rem;
    stroke: var(--accent-bright);
    stroke-width: 1.5;
    fill: none;
    filter: drop-shadow(0 0 8px var(--accent-glow));
}

.stat-value {
    font-family: var(--font-display);
    font-size: 1.8rem;
    font-weight: 800;
    color: var(--gold);
    text-shadow: 0 0 15px rgba(245, 158, 11, 0.2);
}

.stat-label {
    color: var(--text-dim);
    font-family: var(--font-heading);
    font-size: 0.65rem;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    margin-top: 0.75rem;
    opacity: 0.6;
}

/* DETAIL PANEL */
.details-panel {
    background: var(--glass);
    border: 1px solid var(--glass-border);
    border-radius: 24px;
    padding: 3rem;
    backdrop-filter: blur(20px);
    position: relative;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    padding: 1.25rem 0;
    border-bottom: 1px solid var(--glass-border);
}

.detail-row:last-of-type { border-bottom: none; }

.detail-label {
    color: var(--text-dim);
    font-family: var(--font-heading);
    font-size: 0.7rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
}

.detail-value {
    color: var(--text-muted);
    font-weight: 500;
}

.svg-btn {
    width: 14px;
    height: 14px;
    stroke: currentColor;
    stroke-width: 2;
    fill: none;
    margin-right: 8px;
    vertical-align: middle;
}

@media(max-width: 768px) {
    .stats-grid { grid-template-columns: 1fr; }
    .profile-header { flex-direction: column; text-align: center; padding: 2rem; }
    .profile-header div:last-child { margin-left: 0 !important; margin-top: 1.5rem; }
}
</style>
@endpush

@section('content')
<div style="padding:10rem 2rem 8rem; max-width:900px; margin:0 auto; position:relative">
    <div style="position:absolute; top:0; left:50%; transform:translateX(-50%); width:100%; height:400px; background:radial-gradient(circle at 50% 0%, rgba(168,85,247,0.1), transparent 70%); pointer-events:none; z-index:0"></div>

    <div class="profile-header" style="position:relative; z-index:1">
        <div class="avatar-glow">
            {{ strtoupper(substr($user->name,0,1)) }}
        </div>
        <div class="profile-info">
            <h1>{{ $user->name }}</h1>
            <div style="color:var(--text-muted); font-size:0.9rem; opacity:0.7; font-family:var(--font-heading); letter-spacing:0.05em">
                <span style="color:var(--accent-bright)">@</span>{{ $user->username }} 
                <span style="margin:0 0.75rem; opacity:0.2">|</span> 
                Joined {{ $user->created_at->format('M Y') }}
            </div>
        </div>
        <div style="margin-left:auto">
            <a href="{{ route('orders.index') }}" class="btn btn-gold btn-sm" style="padding:0.7rem 1.75rem; display:inline-flex; align-items:center">
                <svg class="svg-btn" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                My Orders
            </a>
        </div>
    </div>

    <div class="stats-grid">
        @php 
            $orderCount = $user->orders()->count();
            $completedCount = $user->orders()->where('status','completed')->count();
            $spent = $user->orders()->where('status','completed')->sum('total'); 
            
            $stats = [
                ['Total Orders', $orderCount, '<rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>'],
                ['Completed', $completedCount, '<polyline points="22 4 12 14.01 9 11.01"></polyline><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>'],
                ['Total Spent', '$'.number_format($spent,2), '<line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>']
            ];
        @endphp
        
        @foreach($stats as [$label, $val, $svgPath])
        <div class="stat-card">
            <svg class="stat-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                {!! $svgPath !!}
            </svg>
            <div class="stat-value">{{ $val }}</div>
            <div class="stat-label">{{ $label }}</div>
        </div>
        @endforeach
    </div>

    <div class="details-panel">
        <h3 style="font-family:var(--font-heading); font-size:0.8rem; letter-spacing:0.3em; text-transform:uppercase; color:var(--accent-bright); margin-bottom:2.5rem; display:flex; align-items:center; gap:12px">
            <svg class="svg-btn" style="width:16px; height:16px; margin:0" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
            System Credentials
        </h3>
        
        <div style="display:grid; gap:0.25rem">
            <div class="detail-row">
                <span class="detail-label">Legal Name</span>
                <span class="detail-value">{{ $user->name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Codename</span>
                <span class="detail-value" style="color:var(--gold); font-family:monospace">@ {{ $user->username }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Neural Email</span>
                <span class="detail-value">{{ $user->email }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Last Transmission</span>
                <span class="detail-value">{{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'First initialization' }}</span>
            </div>
        </div>

        <div style="margin-top:3rem; padding-top:2rem; border-top:1px solid var(--glass-border); display:flex; justify-content:space-between; align-items:center">
            <div style="display:flex; align-items:center; gap:8px">
                <span style="width:8px; height:8px; border-radius:50%; background:#10b981; box-shadow:0 0 10px #10b981"></span>
                <p style="font-size:0.75rem; color:var(--text-dim); font-family:var(--font-heading); letter-spacing:0.05em; margin:0">SESSION_ACTIVE</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm" style="background:rgba(239, 68, 68, 0.05); border:1px solid rgba(239, 68, 68, 0.2); color:#ff8080; padding:0.5rem 1.25rem; display:flex; align-items:center">
                    <svg class="svg-btn" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    Terminate Session
                </button>
            </form>
        </div>
    </div>
</div>
@endsection