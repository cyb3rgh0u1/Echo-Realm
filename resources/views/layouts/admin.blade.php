<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title','Dashboard') — Echo-Realm Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{
  --bg:#020207; --bg1:#07070f; --bg2:#0c0c1a; --panel:#0f0f1e; --panel2:#131326;
  --b0:rgba(255,255,255,0.04); --b1:rgba(168,85,247,0.1); --b2:rgba(168,85,247,0.28);
  --text:#ddd9ee; --muted:#6b6087; --dim:#2e2845;
  --a:#a855f7; --a2:#c084fc; --glow:rgba(168,85,247,0.2);
  --gold:#f59e0b; --green:#10b981; --red:#ef4444; --cyan:#22d3ee; --blue:#3b82f6;
  --fh:'Cinzel',serif; --fb:'Inter',sans-serif;
  --sw:232px; --ease:cubic-bezier(0.165,0.84,0.44,1);
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{height:100%}
body{background:var(--bg);color:var(--text);font-family:var(--fb);font-size:0.845rem;line-height:1.6;display:flex;min-height:100vh;overflow-x:hidden}
::-webkit-scrollbar{width:3px;height:3px}
::-webkit-scrollbar-track{background:var(--bg)}
::-webkit-scrollbar-thumb{background:var(--a)}
a{color:inherit;text-decoration:none}

/* ── SIDEBAR ── */
.sb{width:var(--sw);background:var(--panel);border-right:1px solid var(--b1);display:flex;flex-direction:column;position:fixed;inset:0 auto 0 0;z-index:200;overflow-y:auto;overflow-x:hidden;transition:transform 0.3s var(--ease)}
.sb-logo{padding:1.4rem 1.4rem 1.1rem;border-bottom:1px solid var(--b1);flex-shrink:0}
.sb-logo a{font-family:var(--fh);font-size:0.9rem;font-weight:700;letter-spacing:0.08em;background:linear-gradient(135deg,var(--a2),var(--gold));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;display:block}
.sb-logo small{display:block;font-family:var(--fb);font-size:0.58rem;letter-spacing:0.22em;text-transform:uppercase;-webkit-text-fill-color:var(--muted);background:none;margin-top:2px;font-weight:400}
.sb-site-link{margin:0.75rem 1.1rem 0;display:flex;align-items:center;gap:0.45rem;font-size:0.65rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--muted);padding:0.4rem 0.7rem;border:1px solid var(--b1);border-radius:2px;transition:all 0.2s;font-family:var(--fh)}
.sb-site-link:hover{border-color:var(--b2);color:var(--a2)}
.sb-group{padding:1.1rem 0 0.3rem}
.sb-label{font-size:0.55rem;letter-spacing:0.35em;text-transform:uppercase;color:var(--dim);padding:0 1.4rem;margin-bottom:0.2rem;font-family:var(--fh);font-weight:500}
.sb-nav{list-style:none}
.sb-nav a{display:flex;align-items:center;gap:0.6rem;padding:0.48rem 1.4rem;color:var(--muted);font-size:0.75rem;font-weight:400;transition:all 0.18s;border-left:2px solid transparent;font-family:var(--fb)}
.sb-nav a svg{opacity:0.5;flex-shrink:0;transition:opacity 0.18s}
.sb-nav a:hover{color:var(--text);background:rgba(168,85,247,0.04);border-left-color:rgba(168,85,247,0.2)}
.sb-nav a:hover svg{opacity:0.8}
.sb-nav a.on{color:var(--a2);background:rgba(168,85,247,0.07);border-left-color:var(--a)}
.sb-nav a.on svg{opacity:1}
.sb-foot{margin-top:auto;padding:1.1rem 1.4rem;border-top:1px solid var(--b1);display:flex;align-items:center;gap:0.65rem}
.sb-ava{width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,var(--a),var(--gold));display:flex;align-items:center;justify-content:center;font-family:var(--fh);font-size:0.7rem;font-weight:700;color:#fff;flex-shrink:0}
.sb-uname{font-size:0.75rem;font-weight:500;color:var(--text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.sb-urole{font-size:0.58rem;color:var(--a);letter-spacing:0.1em;text-transform:uppercase;font-family:var(--fh)}
.sb-logout{margin-left:auto;background:none;border:none;cursor:pointer;color:var(--dim);padding:0.2rem;display:flex;transition:color 0.2s;flex-shrink:0}
.sb-logout:hover{color:var(--red)}

/* ── MAIN ── */
.main{margin-left:var(--sw);flex:1;display:flex;flex-direction:column;min-height:100vh}
.topbar{background:var(--panel);border-bottom:1px solid var(--b1);padding:0 1.75rem;height:54px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:100}
.topbar-left{display:flex;align-items:center;gap:0.75rem}
.mob-toggle{display:none;background:none;border:1px solid var(--b1);color:var(--muted);padding:0.3rem 0.5rem;border-radius:2px;cursor:pointer}
.page-head-title{font-family:var(--fh);font-size:0.82rem;font-weight:600;letter-spacing:0.05em}
.topbar-date{font-size:0.68rem;color:var(--muted);font-family:var(--fh);letter-spacing:0.05em}
.content{padding:1.6rem 1.75rem;flex:1}

/* ── STATS ── */
.stat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.5rem}
.stat-card{background:var(--panel2);border:1px solid var(--b1);border-radius:4px;padding:1.25rem 1.4rem;position:relative;overflow:hidden;transition:border-color 0.2s}
.stat-card:hover{border-color:var(--b2)}
.stat-card::after{content:'';position:absolute;top:0;left:0;right:0;height:1px}
.stat-card.c-purple::after{background:linear-gradient(90deg,var(--a),transparent)}
.stat-card.c-gold::after{background:linear-gradient(90deg,var(--gold),transparent)}
.stat-card.c-green::after{background:linear-gradient(90deg,var(--green),transparent)}
.stat-card.c-cyan::after{background:linear-gradient(90deg,var(--cyan),transparent)}
.stat-label{font-size:0.6rem;letter-spacing:0.22em;text-transform:uppercase;color:var(--muted);margin-bottom:0.5rem;font-family:var(--fh)}
.stat-value{font-family:var(--fh);font-size:1.55rem;font-weight:700;line-height:1}
.stat-card.c-purple .stat-value{color:var(--a2)}
.stat-card.c-gold .stat-value{color:var(--gold)}
.stat-card.c-green .stat-value{color:var(--green)}
.stat-card.c-cyan .stat-value{color:var(--cyan)}
.stat-sub{font-size:0.68rem;color:var(--muted);margin-top:0.35rem}
.stat-icon{position:absolute;right:1.1rem;top:50%;transform:translateY(-50%);opacity:0.06}

/* ── CARDS ── */
.card{background:var(--panel2);border:1px solid var(--b1);border-radius:4px;overflow:hidden}
.card-hd{padding:0.9rem 1.25rem;border-bottom:1px solid var(--b1);display:flex;align-items:center;justify-content:space-between}
.card-title{font-family:var(--fh);font-size:0.75rem;font-weight:600;letter-spacing:0.06em}
.card-body{padding:1.25rem}

/* ── TABLE ── */
.tw{overflow-x:auto}
table{width:100%;border-collapse:collapse}
th{font-size:0.58rem;letter-spacing:0.22em;text-transform:uppercase;color:var(--muted);padding:0.65rem 1.1rem;text-align:left;border-bottom:1px solid var(--b1);background:var(--panel);font-family:var(--fh);white-space:nowrap;font-weight:500}
td{padding:0.7rem 1.1rem;border-bottom:1px solid rgba(255,255,255,0.03);font-size:0.78rem;color:var(--text);vertical-align:middle}
tr:last-child td{border-bottom:none}
tbody tr{transition:background 0.15s}
tbody tr:hover td{background:rgba(168,85,247,0.025)}
.td-actions{display:flex;align-items:center;gap:0.35rem;flex-wrap:nowrap}

/* ── BADGES ── */
.badge{display:inline-flex;align-items:center;gap:0.25rem;font-size:0.58rem;letter-spacing:0.1em;text-transform:uppercase;padding:0.18rem 0.55rem;border-radius:2px;font-weight:500;font-family:var(--fh);white-space:nowrap}
.badge-purple{background:rgba(168,85,247,0.08);color:var(--a2);border:1px solid rgba(168,85,247,0.2)}
.badge-gold{background:rgba(245,158,11,0.08);color:var(--gold);border:1px solid rgba(245,158,11,0.2)}
.badge-green{background:rgba(16,185,129,0.08);color:var(--green);border:1px solid rgba(16,185,129,0.2)}
.badge-red{background:rgba(239,68,68,0.08);color:var(--red);border:1px solid rgba(239,68,68,0.2)}
.badge-cyan{background:rgba(34,209,238,0.08);color:var(--cyan);border:1px solid rgba(34,209,238,0.2)}
.badge-gray{background:rgba(255,255,255,0.04);color:var(--muted);border:1px solid var(--b1)}
.badge-legendary{background:rgba(245,158,11,0.08);color:var(--gold);border:1px solid rgba(245,158,11,0.2)}
.badge-epic{background:rgba(168,85,247,0.08);color:var(--a2);border:1px solid rgba(168,85,247,0.2)}
.badge-rare{background:rgba(59,130,246,0.08);color:#60a5fa;border:1px solid rgba(59,130,246,0.2)}
.badge-uncommon{background:rgba(16,185,129,0.08);color:var(--green);border:1px solid rgba(16,185,129,0.2)}
.badge-common{background:rgba(255,255,255,0.04);color:var(--muted);border:1px solid var(--b1)}

/* ── BUTTONS ── */
.btn{display:inline-flex;align-items:center;gap:0.4rem;font-size:0.7rem;font-weight:500;padding:0.48rem 1rem;border-radius:2px;border:none;cursor:pointer;text-decoration:none;transition:all 0.2s var(--ease);white-space:nowrap;font-family:var(--fb)}
.btn-primary{background:linear-gradient(135deg,var(--a),#7c3aed);color:#fff}
.btn-primary:hover{box-shadow:0 0 14px var(--glow)}
.btn-outline{background:transparent;border:1px solid var(--b2);color:var(--a2)}
.btn-outline:hover{background:rgba(168,85,247,0.07)}
.btn-sm{padding:0.32rem 0.75rem;font-size:0.65rem}
.btn-xs{padding:0.2rem 0.55rem;font-size:0.6rem;border-radius:2px}
.btn-danger{background:rgba(239,68,68,0.06);border:1px solid rgba(239,68,68,0.2);color:var(--red)}
.btn-danger:hover{background:rgba(239,68,68,0.12)}
.btn-success{background:rgba(16,185,129,0.06);border:1px solid rgba(16,185,129,0.2);color:var(--green)}
.btn-success:hover{background:rgba(16,185,129,0.12)}
.btn-gold{background:linear-gradient(135deg,var(--gold),#d97706);color:#000;font-weight:600}

/* ── FORMS ── */
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
.form-group{margin-bottom:1rem}
.form-label{display:block;font-size:0.62rem;letter-spacing:0.18em;text-transform:uppercase;color:var(--muted);margin-bottom:0.35rem;font-family:var(--fh);font-weight:500}
.form-control{width:100%;background:var(--bg2);border:1px solid var(--b1);color:var(--text);padding:0.58rem 0.85rem;border-radius:2px;font-family:var(--fb);font-size:0.8rem;outline:none;transition:border-color 0.2s}
.form-control:focus{border-color:var(--b2)}
.form-control::placeholder{color:var(--dim)}
textarea.form-control{resize:vertical;min-height:90px}
select.form-control option{background:var(--panel)}
.form-hint{font-size:0.65rem;color:var(--muted);margin-top:0.28rem}
.form-check{display:flex;align-items:center;gap:0.5rem;cursor:pointer}
.form-check input[type=checkbox]{accent-color:var(--a);width:14px;height:14px}
.form-check-label{font-size:0.78rem;color:var(--muted)}

/* ── PAGE HEADER ── */
.page-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.4rem}
.page-title{font-family:var(--fh);font-size:1.05rem;font-weight:700;letter-spacing:0.04em}
.page-sub{color:var(--muted);font-size:0.72rem;margin-top:0.18rem}
.breadcrumb{display:flex;align-items:center;gap:0.45rem;font-size:0.68rem;color:var(--muted);margin-bottom:1.1rem}
.breadcrumb a{color:var(--muted);transition:color 0.18s}
.breadcrumb a:hover{color:var(--a2)}
.breadcrumb span{color:var(--dim)}

/* ── ALERTS ── */
.alert{padding:0.75rem 1rem;border-radius:2px;margin-bottom:1.1rem;font-size:0.78rem;display:flex;align-items:flex-start;gap:0.6rem}
.alert-success{background:rgba(16,185,129,0.06);border:1px solid rgba(16,185,129,0.2);color:var(--green)}
.alert-danger{background:rgba(239,68,68,0.06);border:1px solid rgba(239,68,68,0.2);color:var(--red)}
.alert svg{flex-shrink:0;margin-top:1px}

/* ── SEARCH ── */
.search-bar{display:flex;gap:0.5rem;margin-bottom:1.1rem}
.search-input{flex:1;background:var(--panel2);border:1px solid var(--b1);color:var(--text);padding:0.52rem 0.85rem;border-radius:2px;font-size:0.78rem;outline:none;font-family:var(--fb)}
.search-input:focus{border-color:var(--b2)}

/* ── MISC ── */
.icon-wrap{width:34px;height:34px;border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0}

/* ── RESPONSIVE ── */
@media(max-width:900px){.sb{transform:translateX(-100%)}.sb.open{transform:translateX(0)}.main{margin-left:0}.mob-toggle{display:flex}.stat-grid{grid-template-columns:repeat(2,1fr)}.form-grid{grid-template-columns:1fr}}
</style>
@stack('styles')
</head>
<body>

{{-- SIDEBAR --}}
<aside class="sb" id="sb">
  <div class="sb-logo">
    <a href="{{ route('admin.dashboard') }}">Echo-Realm<small>Admin Panel</small></a>
  </div>
  <a href="{{ route('home') }}" target="_blank" class="sb-site-link">
    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
    View Site
  </a>

  <div class="sb-group">
    <div class="sb-label">Overview</div>
    <ul class="sb-nav">
      <li>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'on' : '' }}">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
          Dashboard
        </a>
      </li>
    </ul>
  </div>

  <div class="sb-group">
    <div class="sb-label">Universe</div>
    <ul class="sb-nav">
      <li><a href="{{ route('admin.characters.index') }}" class="{{ request()->routeIs('admin.characters.*') ? 'on' : '' }}">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        Characters
      </a></li>
      <li><a href="{{ route('admin.elements.index') }}" class="{{ request()->routeIs('admin.elements.*') ? 'on' : '' }}">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
        Elements
      </a></li>
      <li><a href="{{ route('admin.stories.index') }}" class="{{ request()->routeIs('admin.stories.*') ? 'on' : '' }}">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>
        Story Arcs
      </a></li>
      <li><a href="{{ route('admin.lore.index') }}" class="{{ request()->routeIs('admin.lore.*') ? 'on' : '' }}">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
        Lore Tomes
      </a></li>
      <li><a href="{{ route('admin.timeline.index') }}" class="{{ request()->routeIs('admin.timeline.*') ? 'on' : '' }}">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><line x1="12" y1="2" x2="12" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
        Timeline
      </a></li>
    </ul>
  </div>

  <div class="sb-group">
    <div class="sb-label">Commerce</div>
    <ul class="sb-nav">
      <li><a href="{{ route('admin.shop.index') }}" class="{{ request()->routeIs('admin.shop.*') ? 'on' : '' }}">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>
        Shop Items
      </a></li>
      <li><a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'on' : '' }}">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
        Orders
      </a></li>
    </ul>
  </div>

  <div class="sb-group">
    <div class="sb-label">System</div>
    <ul class="sb-nav">
      <li><a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'on' : '' }}">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        Users
      </a></li>
      <li><a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings*') ? 'on' : '' }}">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
        Settings
      </a></li>
    </ul>
  </div>

  <div class="sb-foot">
    <div class="sb-ava">{{ strtoupper(substr(auth()->user()->name ?? 'A',0,1)) }}</div>
    <div style="flex:1;min-width:0">
      <div class="sb-uname">{{ auth()->user()->name ?? 'Admin' }}</div>
      <div class="sb-urole">Administrator</div>
    </div>
    <form action="{{ route('admin.logout') }}" method="POST">
      @csrf
      <button type="submit" class="sb-logout" title="Logout">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
      </button>
    </form>
  </div>
</aside>

{{-- MAIN --}}
<div class="main">
  <header class="topbar">
    <div class="topbar-left">
      <button class="mob-toggle" onclick="document.getElementById('sb').classList.toggle('open')">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
      </button>
      <span class="page-head-title">@yield('title','Dashboard')</span>
    </div>
    <span class="topbar-date">{{ now()->format('d M Y') }}</span>
  </header>

  <main class="content">
    @if(session('success'))
    <div class="alert alert-success">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
      {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
      {{ session('error') }}
    </div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
    </div>
    @endif
    @yield('content')
  </main>
</div>

<script>
document.addEventListener('click',e=>{
  const sb=document.getElementById('sb');
  if(window.innerWidth<=900&&!sb.contains(e.target)&&!e.target.closest('.mob-toggle'))
    sb.classList.remove('open');
});
</script>
@stack('scripts')
</body>
</html>
