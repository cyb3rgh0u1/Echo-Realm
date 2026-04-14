@extends('layouts.admin')
@section('title','Settings')
@section('content')

<div class="page-header">
  <div><div class="page-title">Settings</div><div class="page-sub">Configure site-wide options and homepage hero</div></div>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div style="display:grid;grid-template-columns:1.4fr 1fr;gap:1.25rem;align-items:start">

    {{-- LEFT COLUMN --}}
    <div>

      {{-- HERO CONTENT --}}
      <div class="card" style="margin-bottom:1.1rem">
        <div class="card-hd">
          <span class="card-title">Hero — Content</span>
          <span style="font-size:0.65rem;color:var(--muted);font-family:var(--fh);letter-spacing:0.08em">Homepage banner text</span>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label class="form-label">Eyebrow (small text above title)</label>
            <input type="text" name="hero_eyebrow" class="form-control"
              value="{{ $settings['hero_eyebrow'] ?? 'Decrypting Resonance Data' }}"
              placeholder="Decrypting Resonance Data">
            <div class="form-hint">Short line shown above the main heading in small caps</div>
          </div>
          <div class="form-group">
            <label class="form-label">Main Title</label>
            <input type="text" name="hero_title" class="form-control"
              value="{{ $settings['hero_title'] ?? 'Enter the Echo-Realm' }}"
              placeholder="Enter the Echo-Realm">
          </div>
          <div class="form-group">
            <label class="form-label">Title — Gradient Subtitle Line</label>
            <input type="text" name="hero_title_sub" class="form-control"
              value="{{ $settings['hero_title_sub'] ?? 'Shattered Reality' }}"
              placeholder="Shattered Reality">
            <div class="form-hint">Displayed below the main title with the purple-gold gradient</div>
          </div>
          <div class="form-group">
            <label class="form-label">Body Paragraph</label>
            <textarea name="hero_subtitle" class="form-control" rows="3"
              placeholder="Step into a universe where...">{{ $settings['hero_subtitle'] ?? '' }}</textarea>
          </div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div>
              <div class="form-group">
                <label class="form-label">Button 1 — Label</label>
                <input type="text" name="hero_btn1_text" class="form-control"
                  value="{{ $settings['hero_btn1_text'] ?? 'Get the Game' }}" placeholder="Get the Game">
              </div>
              <div class="form-group">
                <label class="form-label">Button 1 — URL</label>
                <input type="text" name="hero_btn1_url" class="form-control"
                  value="{{ $settings['hero_btn1_url'] ?? '/shop?type=game' }}" placeholder="/shop?type=game">
              </div>
            </div>
            <div>
              <div class="form-group">
                <label class="form-label">Button 2 — Label</label>
                <input type="text" name="hero_btn2_text" class="form-control"
                  value="{{ $settings['hero_btn2_text'] ?? 'Explore Story' }}" placeholder="Explore Story">
              </div>
              <div class="form-group">
                <label class="form-label">Button 2 — URL</label>
                <input type="text" name="hero_btn2_url" class="form-control"
                  value="{{ $settings['hero_btn2_url'] ?? '/story' }}" placeholder="/story">
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- HERO BACKGROUND --}}
      <div class="card" style="margin-bottom:1.1rem">
        <div class="card-hd">
          <span class="card-title">Hero — Background</span>
          <span style="font-size:0.65rem;color:var(--muted);font-family:var(--fh);letter-spacing:0.08em">Image or video behind the hero text</span>
        </div>
        <div class="card-body">

          {{-- BG TYPE --}}
          <div class="form-group">
            <label class="form-label">Background Type</label>
            <div style="display:flex;gap:0.5rem;flex-wrap:wrap">
              @foreach(['gradient'=>'Default Gradient','image'=>'Custom Image','video'=>'Background Video'] as $val=>$label)
              <label style="display:flex;align-items:center;gap:0.5rem;padding:0.45rem 1rem;border:1px solid var(--b1);border-radius:2px;cursor:pointer;font-size:0.75rem;transition:all 0.2s;user-select:none"
                     id="type-label-{{ $val }}"
                     onclick="selectBgType('{{ $val }}')">
                <input type="radio" name="hero_bg_type" value="{{ $val }}"
                  {{ ($settings['hero_bg_type'] ?? 'gradient') === $val ? 'checked' : '' }}
                  style="accent-color:var(--a);display:none" id="type-{{ $val }}">
                <span id="type-dot-{{ $val }}" style="width:8px;height:8px;border-radius:50%;border:1px solid var(--muted);flex-shrink:0;transition:all 0.2s"></span>
                {{ $label }}
              </label>
              @endforeach
            </div>
          </div>

          {{-- OVERLAY OPACITY --}}
          <div class="form-group">
            <label class="form-label">
              Overlay Opacity
              <span id="overlay-val" style="color:var(--a2);margin-left:0.5rem">{{ $settings['hero_bg_overlay'] ?? '0.55' }}</span>
            </label>
            <input type="range" name="hero_bg_overlay" min="0" max="1" step="0.05"
              value="{{ $settings['hero_bg_overlay'] ?? '0.55' }}"
              style="width:100%;accent-color:var(--a)"
              oninput="document.getElementById('overlay-val').textContent=this.value">
            <div class="form-hint">Dark overlay placed on top of the image/video. 0 = none, 1 = fully black</div>
          </div>

          {{-- IMAGE UPLOAD --}}
          <div id="section-image" style="display:none">
            <div class="form-group">
              <label class="form-label">Background Image</label>
              @php $heroImg = $settings['hero_bg_image'] ?? ''; @endphp
              @if($heroImg)
              <div style="margin-bottom:0.75rem;position:relative;display:inline-block">
                <img src="{{ asset('storage/'.$heroImg) }}" alt="Hero BG"
                  style="max-height:120px;border-radius:2px;border:1px solid var(--b1);display:block">
                <div style="margin-top:0.4rem;display:flex;align-items:center;gap:0.5rem">
                  <span style="font-size:0.68rem;color:var(--muted)">Current image</span>
                  <label style="display:flex;align-items:center;gap:0.3rem;cursor:pointer;font-size:0.68rem;color:var(--red)">
                    <input type="checkbox" name="remove_bg_image" value="1" style="accent-color:var(--red);width:12px;height:12px"> Remove
                  </label>
                </div>
              </div>
              @endif
              <input type="file" name="hero_bg_image" class="form-control" accept="image/jpg,image/jpeg,image/png,image/webp">
              <div class="form-hint">JPG, PNG or WebP. Max 8MB. Recommended: 1920×1080px or larger.</div>
            </div>
          </div>

          {{-- VIDEO UPLOAD --}}
          <div id="section-video" style="display:none">
            <div class="form-group">
              <label class="form-label">Background Video</label>
              @php $heroVid = $settings['hero_bg_video'] ?? ''; @endphp
              @if($heroVid)
              <div style="margin-bottom:0.75rem">
                <video src="{{ asset('storage/'.$heroVid) }}" style="max-height:100px;border-radius:2px;border:1px solid var(--b1)" muted></video>
                <div style="margin-top:0.4rem;display:flex;align-items:center;gap:0.5rem">
                  <span style="font-size:0.68rem;color:var(--muted)">Current video</span>
                  <label style="display:flex;align-items:center;gap:0.3rem;cursor:pointer;font-size:0.68rem;color:var(--red)">
                    <input type="checkbox" name="remove_bg_video" value="1" style="accent-color:var(--red);width:12px;height:12px"> Remove
                  </label>
                </div>
              </div>
              @endif
              <input type="file" name="hero_bg_video" class="form-control" accept="video/mp4,video/webm">
              <div class="form-hint">MP4 or WebM. Max 50MB. Video will autoplay, loop, and be muted.</div>
            </div>
          </div>

        </div>
      </div>

      {{-- GENERAL --}}
      <div class="card" style="margin-bottom:1.1rem">
        <div class="card-hd"><span class="card-title">General</span></div>
        <div class="card-body">
          <div class="form-grid">
            <div class="form-group">
              <label class="form-label">Site Name</label>
              <input type="text" name="site_name" class="form-control" value="{{ $settings['site_name']??'Echo-Realm' }}">
            </div>
            <div class="form-group">
              <label class="form-label">Tagline</label>
              <input type="text" name="site_tagline" class="form-control" value="{{ $settings['site_tagline']??'' }}">
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Featured Banner Text</label>
            <input type="text" name="featured_banner" class="form-control" value="{{ $settings['featured_banner']??'' }}">
            <div class="form-hint">Scrolling text strip below the hero</div>
          </div>
        </div>
      </div>

      {{-- SYSTEM --}}
      <div class="card" style="margin-bottom:1.4rem">
        <div class="card-hd"><span class="card-title">System</span></div>
        <div class="card-body">
          <label class="form-check">
            <input type="checkbox" name="maintenance_mode" value="1"
              {{ ($settings['maintenance_mode']??'0')==='1'?'checked':'' }}>
            <span class="form-check-label">Enable Maintenance Mode</span>
          </label>
          <div class="form-hint" style="margin-top:0.4rem">Only admins can view the site when enabled.</div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
        Save All Settings
      </button>
    </div>

    {{-- RIGHT: LIVE PREVIEW --}}
    <div style="position:sticky;top:70px">
      <div class="card">
        <div class="card-hd"><span class="card-title">Live Preview</span></div>
        <div style="position:relative;aspect-ratio:16/9;overflow:hidden;background:#020207">

          {{-- Preview BG --}}
          <div id="prev-gradient" style="position:absolute;inset:0;background:radial-gradient(ellipse 80% 60% at 50% 0%,rgba(168,85,247,0.3),transparent 70%),radial-gradient(ellipse 60% 50% at 80% 80%,rgba(245,158,11,0.12),transparent 60%)"></div>
          <img id="prev-image" src="{{ $heroImg ? asset('storage/'.$heroImg) : '' }}"
            style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:none">
          <video id="prev-video" src="{{ $heroVid ? asset('storage/'.$heroVid) : '' }}"
            autoplay loop muted playsinline
            style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:none"></video>
          <div id="prev-overlay" style="position:absolute;inset:0;background:rgba(0,0,0,{{ $settings['hero_bg_overlay']??'0.55' }})"></div>

          {{-- Preview Text --}}
          <div style="position:relative;z-index:2;display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;padding:1.5rem;text-align:center;gap:0.5rem">
            <p id="prev-eyebrow" style="font-family:'Cinzel',serif;font-size:0.48rem;letter-spacing:0.4em;text-transform:uppercase;color:#a855f7;opacity:0.9">
              {{ $settings['hero_eyebrow'] ?? 'Decrypting Resonance Data' }}
            </p>
            <h2 id="prev-title" style="font-family:'Cinzel Decorative',serif;font-size:clamp(0.9rem,3vw,1.3rem);font-weight:900;line-height:1.1;color:#e4e0f0">
              {{ $settings['hero_title'] ?? 'Enter the Echo-Realm' }}
            </h2>
            <span id="prev-title-sub" style="font-family:'Cinzel Decorative',serif;font-size:clamp(0.55rem,2vw,0.8rem);font-weight:700;background:linear-gradient(135deg,#c084fc,#f59e0b);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">
              {{ $settings['hero_title_sub'] ?? 'Shattered Reality' }}
            </span>
            <p id="prev-sub" style="color:#7a6f9a;font-size:0.5rem;line-height:1.6;max-width:220px;font-family:'Raleway',sans-serif;margin-top:0.25rem">
              {{ Str::limit($settings['hero_subtitle'] ?? '', 100) }}
            </p>
            <div style="display:flex;gap:0.4rem;margin-top:0.4rem;flex-wrap:wrap;justify-content:center">
              <span id="prev-btn1" style="background:linear-gradient(135deg,#a855f7,#7c3aed);color:#fff;font-family:'Cinzel',serif;font-size:0.45rem;letter-spacing:0.1em;padding:0.3rem 0.75rem;border-radius:1px">
                {{ $settings['hero_btn1_text'] ?? 'Get the Game' }}
              </span>
              <span id="prev-btn2" style="border:1px solid rgba(168,85,247,0.4);color:#c084fc;font-family:'Cinzel',serif;font-size:0.45rem;letter-spacing:0.1em;padding:0.3rem 0.75rem;border-radius:1px">
                {{ $settings['hero_btn2_text'] ?? 'Explore Story' }}
              </span>
            </div>
          </div>
        </div>
        <div style="padding:0.75rem 1rem;border-top:1px solid var(--b1);display:flex;align-items:center;gap:0.5rem">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--muted)" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          <span style="font-size:0.65rem;color:var(--muted)">Preview updates as you type. Save to apply.</span>
        </div>
      </div>

      <div class="card" style="margin-top:1rem">
        <div class="card-hd"><span class="card-title">Field Guide</span></div>
        <div class="card-body" style="display:grid;gap:0.6rem">
          @foreach([
            ['Eyebrow','Small tracking text above the title — use for taglines or status labels'],
            ['Main Title','The large primary heading. Keep under 5 words for best impact.'],
            ['Gradient Line','Second heading line shown in purple-gold gradient. Usually a 1-3 word punch.'],
            ['Body Text','Supporting paragraph. 1-2 sentences maximum.'],
            ['Buttons','Primary (gold) and secondary (outline) CTAs. URLs can be relative like /shop.'],
            ['Background','Gradient uses built-in particles. Image/Video replaces it — overlay controls darkness.'],
          ] as [$k,$v])
          <div style="padding:0.6rem 0.75rem;background:var(--bg2);border-radius:2px;border:1px solid var(--b1)">
            <div style="font-family:var(--fh);font-size:0.6rem;letter-spacing:0.12em;color:var(--a2);margin-bottom:0.2rem">{{ $k }}</div>
            <div style="font-size:0.7rem;color:var(--muted);line-height:1.5">{{ $v }}</div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</form>

@push('scripts')
<script>
const $ = id => document.getElementById(id);

// Bind live preview to text inputs
const bindings = {
  'hero_eyebrow':   'prev-eyebrow',
  'hero_title':     'prev-title',
  'hero_title_sub': 'prev-title-sub',
  'hero_subtitle':  'prev-sub',
  'hero_btn1_text': 'prev-btn1',
  'hero_btn2_text': 'prev-btn2',
};

Object.entries(bindings).forEach(([name, previewId]) => {
  const input = document.querySelector(`[name="${name}"]`);
  const target = $(previewId);
  if (!input || !target) return;
  input.addEventListener('input', () => {
    target.textContent = input.value;
  });
});

// Overlay slider live preview
document.querySelector('[name="hero_bg_overlay"]').addEventListener('input', function() {
  $('prev-overlay').style.background = `rgba(0,0,0,${this.value})`;
});

// BG type switcher
function selectBgType(val) {
  ['gradient','image','video'].forEach(v => {
    const lbl  = $('type-label-' + v);
    const dot  = $('type-dot-' + v);
    const input = $('type-' + v);
    const sec   = $('section-' + v);
    const isSelected = v === val;

    if (input)  input.checked = isSelected;
    if (lbl) { lbl.style.borderColor = isSelected ? 'var(--b2)' : 'var(--b1)'; lbl.style.color = isSelected ? '#fff' : 'var(--muted)'; }
    if (dot) { dot.style.background = isSelected ? 'var(--a)' : 'transparent'; dot.style.borderColor = isSelected ? 'var(--a)' : 'var(--muted)'; }
    if (sec) sec.style.display = isSelected ? 'block' : 'none';
  });

  // Update preview
  const pGrad  = $('prev-gradient');
  const pImg   = $('prev-image');
  const pVid   = $('prev-video');

  pGrad.style.display = val === 'gradient' ? 'block' : 'none';
  pImg.style.display  = val === 'image'    ? 'block' : 'none';
  pVid.style.display  = val === 'video'    ? 'block' : 'none';

  if (val === 'video' && pVid.src) pVid.play().catch(()=>{});
}

// Init on load
(function() {
  const current = document.querySelector('[name="hero_bg_type"]:checked');
  if (current) selectBgType(current.value);
  else selectBgType('gradient');
})();

// Image file preview
document.querySelector('[name="hero_bg_image"]').addEventListener('change', function() {
  const file = this.files[0];
  if (!file) return;
  const reader = new FileReader();
  reader.onload = e => {
    const pImg = $('prev-image');
    pImg.src = e.target.result;
  };
  reader.readAsDataURL(file);
});

// Video file preview
document.querySelector('[name="hero_bg_video"]').addEventListener('change', function() {
  const file = this.files[0];
  if (!file) return;
  const pVid = $('prev-video');
  pVid.src = URL.createObjectURL(file);
  pVid.play().catch(()=>{});
});
</script>
@endpush
@endsection
