@extends('layouts.client')
@section('title', $story->title)

@push('styles')
<style>
    /* Reader Progress Bar */
    .progress-bar { 
        position: fixed; top: 0; left: 0; width: 0%; height: 3px; 
        background: linear-gradient(90deg, var(--accent), var(--gold)); 
        z-index: 1000; transition: width 0.1s ease-out; 
    }

    .story-header { 
        padding: 12rem 2rem 5rem; text-align: center; position: relative; 
        background: radial-gradient(circle at center bottom, rgba(var(--accent-rgb), 0.05), transparent 70%); 
    }

    .story-content-wrapper { max-width: 800px; margin: 0 auto; padding: 0 2rem 8rem; }

    /* Narrative Typography */
    .story-body { 
        font-size: 1.1rem; line-height: 2.2; color: rgba(255, 255, 255, 0.75); 
        letter-spacing: 0.01em; 
    }
    .story-body p { margin-bottom: 2rem; }
    
    /* Elegant Drop-cap logic for first paragraph */
    .story-body p:first-of-type::first-letter {
        float: left; font-family: var(--font-display); font-size: 4rem;
        line-height: 0.8; padding: 8px 12px 4px 0; color: var(--accent); font-weight: 900;
    }

    .story-body em { color: var(--accent); font-style: italic; }
    .story-body strong { color: #fff; font-weight: 600; }

    /* Navigation Refinement */
    .story-nav { 
        display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; 
        margin-top: 6rem; padding-top: 3rem; border-top: 1px solid var(--border); 
    }
    
    .nav-card { 
        padding: 1.5rem; background: rgba(255,255,255,0.01); 
        border: 1px solid var(--border); border-radius: 4px; 
        text-decoration: none; color: inherit; transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); 
        display: flex; flex-direction: column; gap: 8px;
    }
    
    .nav-card:hover { 
        border-color: var(--accent); background: rgba(255,255,255,0.03); 
        transform: translateY(-4px); 
    }
    
    .nav-label { 
        font-family: var(--font-heading); font-size: 0.6rem; 
        letter-spacing: 0.25em; text-transform: uppercase; color: var(--text-dim); 
        display: flex; align-items: center; gap: 8px;
    }

    .nav-title { font-family: var(--font-heading); font-size: 0.9rem; font-weight: 600; color: #fff; }
</style>
@endpush

@section('content')

<div class="progress-bar" id="readProgress"></div>

@php
    $icons = [
        'prev' => '<polyline points="15 18 9 12 15 6"></polyline>',
        'next' => '<polyline points="9 18 15 12 9 6"></polyline>',
        'all'  => '<rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect>'
    ];
@endphp

<div class="story-header">
  <div style="font-family:var(--font-heading); font-size:0.65rem; letter-spacing:0.4em; text-transform:uppercase; color:var(--gold); margin-bottom:1rem">
    Arc {{ sprintf('%02d', $story->arc_number) }} // File {{ sprintf('%03d', $story->chapter_number) }}
  </div>
  
  <h1 style="font-family:var(--font-display); font-size:clamp(2.2rem, 5vw, 3.8rem); font-weight:800; line-height:1.1; margin-bottom:1.5rem; color:#fff">
    {{ $story->title }}
  </h1>
  
  <p style="color:var(--text-muted); font-size:1rem; line-height:1.8; max-width:650px; margin:0 auto 2rem; font-style:italic; opacity:0.7">
    {{ $story->synopsis }}
  </p>

  <div style="display:flex; justify-content:center; align-items:center; gap:2rem; color:var(--text-dim); font-family:var(--font-heading); font-size:0.6rem; letter-spacing:0.2em; text-transform:uppercase">
    <span>Synchronizing... {{ $story->status }}</span>
  </div>
</div>

<div class="story-content-wrapper" id="storyContent">
  <div class="story-body">
    {!! $story->content !!}
  </div>

  <div class="story-nav">
    @if($prev)
    <a href="{{ route('story.show', $prev->slug) }}" class="nav-card">
      <span class="nav-label">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">{!! $icons['prev'] !!}</svg>
        Previous File
      </span>
      <span class="nav-title">{{ $prev->title }}</span>
    </a>
    @else
    <div></div>
    @endif

    @if($next)
    <a href="{{ route('story.show', $next->slug) }}" class="nav-card" style="align-items: flex-end; text-align: right">
      <span class="nav-label">
        Next File
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">{!! $icons['next'] !!}</svg>
      </span>
      <span class="nav-title">{{ $next->title }}</span>
    </a>
    @endif
  </div>

  <div style="text-align:center; margin-top:4rem">
    <a href="{{ route('story.index') }}" style="display:inline-flex; align-items:center; gap:10px; color:var(--text-dim); text-decoration:none; font-family:var(--font-heading); font-size:0.65rem; letter-spacing:0.2em; text-transform:uppercase">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">{!! $icons['all'] !!}</svg>
      View All Narratives
    </a>
  </div>
</div>

@endsection

@push('scripts')
<script>
window.addEventListener('scroll', function() {
  const el = document.getElementById('storyContent');
  const winScroll = document.documentElement.scrollTop || document.body.scrollTop;
  const height = el.scrollHeight - document.documentElement.clientHeight;
  const scrolled = (winScroll / height) * 100;
  document.getElementById('readProgress').style.width = Math.min(100, Math.max(0, scrolled)) + '%';
});
</script>
@endpush