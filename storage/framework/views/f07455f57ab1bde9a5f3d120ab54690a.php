<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title><?php echo $__env->yieldContent('title', 'Echo-Realm'); ?> — The Resonance Awaits</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Cinzel:wght@400;500;600;700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;1,300&display=swap" rel="stylesheet">
<style>
:root {
  --void:#020207; --deep:#06060e; --surface:#0b0b17; --panel:#0e0e1b; --panel2:#121222;
  --border:rgba(168,85,247,0.1); --border-b:rgba(168,85,247,0.3); --border-w:rgba(255,255,255,0.06);
  --text:#e4e0f0; --text-muted:#7a6f9a; --text-dim:#3d3460;
  --accent:#a855f7; --accent2:#c084fc; --glow:rgba(168,85,247,0.2);
  --gold:#f59e0b; --gold2:#fbbf24; --gold-glow:rgba(245,158,11,0.2);
  --red:#ef4444; --green:#10b981; --cyan:#22d3ee; --blue:#3b82f6;
  --font-display:'Cinzel Decorative',serif;
  --font-heading:'Cinzel',serif;
  --font-body:'Raleway',sans-serif;
  --ease:cubic-bezier(0.165,0.84,0.44,1);
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{background:var(--void);color:var(--text);font-family:var(--font-body);font-weight:300;line-height:1.7;overflow-x:hidden}
::-webkit-scrollbar{width:3px}
::-webkit-scrollbar-track{background:var(--void)}
::-webkit-scrollbar-thumb{background:var(--accent)}
#canvas{position:fixed;top:0;left:0;width:100%;height:100%;pointer-events:none;z-index:0;opacity:0.4}
.wrap{position:relative;z-index:2}

/* NAV */
.nav{position:fixed;top:0;left:0;right:0;z-index:1000;height:68px;display:flex;align-items:center;padding:0 2.5rem;transition:all 0.4s var(--ease)}
.nav.scrolled{background:rgba(2,2,7,0.85);backdrop-filter:blur(24px);border-bottom:1px solid var(--border)}
.nav-logo{font-family:var(--font-display);font-size:1rem;font-weight:900;letter-spacing:0.08em;text-decoration:none;background:linear-gradient(135deg,var(--accent2),var(--gold));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;flex-shrink:0}
.nav-logo small{display:block;font-family:var(--font-heading);font-size:0.52rem;letter-spacing:0.4em;-webkit-text-fill-color:var(--text-dim);background:none;margin-top:1px;font-weight:400}
.nav-links{display:flex;align-items:center;gap:0.1rem;margin:0 auto}
.nav-links a{font-family:var(--font-heading);font-size:0.68rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--text-muted);text-decoration:none;padding:0.5rem 0.9rem;border-radius:2px;transition:color 0.2s;position:relative}
.nav-links a::after{content:'';position:absolute;bottom:-2px;left:50%;transform:translateX(-50%);width:0;height:1px;background:var(--accent);transition:width 0.3s var(--ease)}
.nav-links a:hover{color:var(--text)}
.nav-links a:hover::after,.nav-links a.active::after{width:60%}
.nav-links a.active{color:var(--accent2)}
.nav-end{display:flex;align-items:center;gap:0.6rem;flex-shrink:0}
.nav-cart{position:relative;display:flex;align-items:center;padding:0.4rem;color:var(--text-muted);text-decoration:none;transition:color 0.2s}
.nav-cart:hover{color:var(--text)}
.nav-cart-count{position:absolute;top:-3px;right:-3px;background:var(--accent);color:#fff;font-size:0.55rem;width:15px;height:15px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-family:var(--font-heading)}
.nav-btn{font-family:var(--font-heading);font-size:0.65rem;letter-spacing:0.12em;text-transform:uppercase;padding:0.45rem 1.1rem;border-radius:2px;text-decoration:none;transition:all 0.25s;cursor:pointer;border:none}
.nav-btn-ghost{background:transparent;border:1px solid var(--border-b);color:var(--accent2)}
.nav-btn-ghost:hover{background:rgba(168,85,247,0.08)}
.nav-btn-solid{background:linear-gradient(135deg,var(--accent),#7c3aed);color:#fff}
.nav-btn-solid:hover{box-shadow:0 0 20px var(--glow)}
.nav-btn-text{background:none;border:none;color:var(--text-muted);font-family:var(--font-heading);font-size:0.65rem;letter-spacing:0.12em;text-transform:uppercase;cursor:pointer;padding:0.45rem 0.75rem;transition:color 0.2s}
.nav-btn-text:hover{color:var(--text)}
.mob-btn{display:none;background:none;border:1px solid var(--border);color:var(--text-muted);padding:0.35rem 0.55rem;border-radius:2px;cursor:pointer}
.mob-nav{display:none;position:fixed;inset:0;background:rgba(2,2,7,0.97);z-index:999;flex-direction:column;align-items:center;justify-content:center;gap:2rem}
.mob-nav.open{display:flex}
.mob-nav a{font-family:var(--font-heading);font-size:1rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--text);text-decoration:none}
.mob-close{position:absolute;top:1.5rem;right:1.75rem;background:none;border:none;color:var(--text-muted);cursor:pointer;font-size:1.2rem}

/* FLASH */
.flash{position:fixed;top:80px;right:1.5rem;z-index:9999;padding:0.75rem 1.25rem;border-radius:2px;font-family:var(--font-heading);font-size:0.7rem;letter-spacing:0.08em;animation:fin 0.3s var(--ease)}
.flash-s{background:rgba(16,185,129,0.08);border:1px solid rgba(16,185,129,0.3);color:#34d399}
.flash-e{background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.3);color:#f87171}
@keyframes fin{from{opacity:0;transform:translateX(12px)}to{opacity:1;transform:translateX(0)}}

/* LAYOUT */
.section{padding:6rem 2.5rem}
.section-sm{padding:3rem 2.5rem}
.container{max-width:1280px;margin:0 auto}
.container-narrow{max-width:860px;margin:0 auto}
.divider{height:1px;background:linear-gradient(90deg,transparent,var(--border-b),transparent);margin:4rem 0}

/* TYPOGRAPHY */
.section-eyebrow{font-family:var(--font-heading);font-size:0.6rem;letter-spacing:0.45em;text-transform:uppercase;color:var(--accent);margin-bottom:0.75rem}
.section-title{font-family:var(--font-display);font-size:clamp(1.8rem,4vw,3rem);font-weight:700;line-height:1.1;margin-bottom:1rem}
.section-sub{color:var(--text-muted);font-size:0.95rem;line-height:1.8;max-width:560px}

/* PAGE HERO */
.page-hero{padding:10rem 2.5rem 4.5rem;text-align:center;position:relative;overflow:hidden}
.page-hero-bg{position:absolute;inset:0;background:radial-gradient(ellipse at 50% 0%,rgba(168,85,247,0.12),transparent 65%)}
.page-hero-line{position:absolute;bottom:0;left:50%;transform:translateX(-50%);width:1px;height:60px;background:linear-gradient(to bottom,rgba(168,85,247,0.4),transparent)}

/* CARDS */
.card{background:rgba(255,255,255,0.015);border:1px solid var(--border);border-radius:4px;overflow:hidden;transition:border-color 0.3s var(--ease),transform 0.3s var(--ease)}
.card:hover{border-color:rgba(168,85,247,0.25);transform:translateY(-4px)}

/* BADGES */
.badge{display:inline-flex;align-items:center;gap:0.3rem;font-family:var(--font-heading);font-size:0.55rem;letter-spacing:0.12em;text-transform:uppercase;padding:0.22rem 0.6rem;border-radius:2px}
.badge-legendary{background:rgba(245,158,11,0.08);color:var(--gold);border:1px solid rgba(245,158,11,0.2)}
.badge-epic{background:rgba(168,85,247,0.08);color:var(--accent2);border:1px solid rgba(168,85,247,0.2)}
.badge-rare{background:rgba(59,130,246,0.08);color:#60a5fa;border:1px solid rgba(59,130,246,0.2)}
.badge-uncommon{background:rgba(16,185,129,0.08);color:#34d399;border:1px solid rgba(16,185,129,0.2)}
.badge-common{background:rgba(107,114,128,0.08);color:#9ca3af;border:1px solid rgba(107,114,128,0.2)}

/* BUTTONS */
.btn{display:inline-flex;align-items:center;gap:0.45rem;font-family:var(--font-heading);font-size:0.68rem;letter-spacing:0.12em;text-transform:uppercase;padding:0.7rem 1.75rem;border-radius:2px;text-decoration:none;cursor:pointer;border:none;transition:all 0.25s var(--ease);font-weight:500}
.btn-primary{background:linear-gradient(135deg,var(--accent),#7c3aed);color:#fff}
.btn-primary:hover{box-shadow:0 0 24px var(--glow)}
.btn-outline{background:transparent;border:1px solid var(--border-b);color:var(--accent2)}
.btn-outline:hover{background:rgba(168,85,247,0.06)}
.btn-gold{background:linear-gradient(135deg,var(--gold),#d97706);color:#000;font-weight:600}
.btn-gold:hover{box-shadow:0 0 24px var(--gold-glow)}
.btn-sm{padding:0.45rem 1.1rem;font-size:0.62rem}
.btn-danger{background:rgba(239,68,68,0.06);border:1px solid rgba(239,68,68,0.2);color:#f87171}

/* GRIDS */
.grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem}
.grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem}
.grid-2{display:grid;grid-template-columns:repeat(2,1fr);gap:1.5rem}

/* SHOP */
.shop-img{aspect-ratio:16/9;background:var(--surface);display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden}
.shop-discount{position:absolute;top:0.75rem;left:0.75rem;background:var(--red);color:#fff;font-family:var(--font-heading);font-size:0.58rem;letter-spacing:0.06em;padding:0.18rem 0.5rem;border-radius:2px;font-weight:700}
.shop-featured-tag{position:absolute;top:0.75rem;right:0.75rem;background:var(--gold);color:#000;font-family:var(--font-heading);font-size:0.58rem;letter-spacing:0.1em;padding:0.18rem 0.55rem;border-radius:2px;font-weight:700;text-transform:uppercase}

/* REVEAL */
.reveal{opacity:0;transform:translateY(24px);transition:opacity 0.7s var(--ease),transform 0.7s var(--ease)}
.reveal.visible{opacity:1;transform:translateY(0)}

/* FOOTER */
footer{background:var(--deep);border-top:1px solid var(--border);padding:4rem 2.5rem 2rem}
.footer-grid{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:3rem;max-width:1280px;margin:0 auto}
.footer-brand p{color:var(--text-dim);font-size:0.82rem;line-height:1.8;margin-top:0.75rem;max-width:260px}
.footer-col h4{font-family:var(--font-heading);font-size:0.58rem;letter-spacing:0.3em;text-transform:uppercase;color:var(--text-dim);margin-bottom:1rem}
.footer-col ul{list-style:none}
.footer-col li{margin-bottom:0.45rem}
.footer-col a{color:var(--text-dim);text-decoration:none;font-size:0.8rem;transition:color 0.2s}
.footer-col a:hover{color:var(--text-muted)}
.footer-bottom{border-top:1px solid var(--border);margin-top:3rem;padding-top:1.5rem;max-width:1280px;margin-left:auto;margin-right:auto;display:flex;justify-content:space-between;align-items:center;color:var(--text-dim);font-size:0.72rem;font-family:var(--font-heading);letter-spacing:0.08em}

@media(max-width:1024px){.grid-4{grid-template-columns:repeat(2,1fr)}.footer-grid{grid-template-columns:1fr 1fr}}
@media(max-width:768px){.nav-links,.nav-end{display:none}.mob-btn{display:block}.grid-3,.grid-2{grid-template-columns:1fr}.grid-4{grid-template-columns:1fr}.footer-grid{grid-template-columns:1fr}.section{padding:4rem 1.5rem}.page-hero{padding:8rem 1.5rem 3rem}}
</style>
<?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
<canvas id="canvas"></canvas>
<div class="wrap">


<nav class="nav" id="nav">
  <a href="<?php echo e(route('home')); ?>" class="nav-logo">Echo-Realm<small>The Resonance Awaits</small></a>
  <div class="nav-links">
    <a href="<?php echo e(route('home')); ?>" class="<?php echo e(request()->routeIs('home') ? 'active' : ''); ?>">Home</a>
    <a href="<?php echo e(route('characters.index')); ?>" class="<?php echo e(request()->routeIs('characters.*') ? 'active' : ''); ?>">Characters</a>
    <a href="<?php echo e(route('story.index')); ?>" class="<?php echo e(request()->routeIs('story.*') ? 'active' : ''); ?>">Story</a>
    <a href="<?php echo e(route('lore.index')); ?>" class="<?php echo e(request()->routeIs('lore.*') ? 'active' : ''); ?>">Lore</a>
    <a href="<?php echo e(route('timeline.index')); ?>" class="<?php echo e(request()->routeIs('timeline.*') ? 'active' : ''); ?>">Timeline</a>
    <a href="<?php echo e(route('shop.index')); ?>" class="<?php echo e(request()->routeIs('shop.*') ? 'active' : ''); ?>">Shop</a>
  </div>
  <div class="nav-end">
    <a href="<?php echo e(route('cart.index')); ?>" class="nav-cart" title="Cart">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2 3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
      <?php $cc = array_sum(session('cart',[])); ?>
      <?php if($cc > 0): ?><span class="nav-cart-count"><?php echo e($cc); ?></span><?php endif; ?>
    </a>
    <?php if(auth()->guard()->check()): ?>
      <a href="<?php echo e(route('profile')); ?>" class="nav-btn nav-btn-ghost"><?php echo e(Str::limit(auth()->user()->name,14)); ?></a>
      <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline">
        <?php echo csrf_field(); ?><button type="submit" class="nav-btn-text">Logout</button>
      </form>
    <?php else: ?>
      <a href="<?php echo e(route('login')); ?>" class="nav-btn nav-btn-ghost">Login</a>
      <a href="<?php echo e(route('register')); ?>" class="nav-btn nav-btn-solid">Join</a>
    <?php endif; ?>
  </div>
  <button class="mob-btn" onclick="document.getElementById('mob').classList.toggle('open')">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
  </button>
</nav>


<div class="mob-nav" id="mob">
  <button class="mob-close" onclick="document.getElementById('mob').classList.remove('open')">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
  </button>
  <a href="<?php echo e(route('home')); ?>">Home</a>
  <a href="<?php echo e(route('characters.index')); ?>">Characters</a>
  <a href="<?php echo e(route('story.index')); ?>">Story</a>
  <a href="<?php echo e(route('lore.index')); ?>">Lore</a>
  <a href="<?php echo e(route('timeline.index')); ?>">Timeline</a>
  <a href="<?php echo e(route('shop.index')); ?>">Shop</a>
  <?php if(auth()->guard()->check()): ?>
  <a href="<?php echo e(route('profile')); ?>">Profile</a>
  <?php else: ?>
  <a href="<?php echo e(route('login')); ?>">Login</a>
  <a href="<?php echo e(route('register')); ?>">Join</a>
  <?php endif; ?>
</div>

<?php if(session('success')): ?>
<div class="flash flash-s"><?php echo e(session('success')); ?></div>
<?php endif; ?>
<?php if(session('error')): ?>
<div class="flash flash-e"><?php echo e(session('error')); ?></div>
<?php endif; ?>

<?php echo $__env->yieldContent('content'); ?>

<footer>
  <div class="footer-grid">
    <div class="footer-brand">
      <span style="font-family:var(--font-display);font-size:1rem;font-weight:900;background:linear-gradient(135deg,var(--accent2),var(--gold));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">Echo-Realm</span>
      <p>An immersive universe where ancient resonance and cosmic mystery converge. Enter the Realm. Find your echo.</p>
    </div>
    <div class="footer-col">
      <h4>Universe</h4>
      <ul>
        <li><a href="<?php echo e(route('characters.index')); ?>">Characters</a></li>
        <li><a href="<?php echo e(route('story.index')); ?>">Story Arcs</a></li>
        <li><a href="<?php echo e(route('lore.index')); ?>">Lore Tomes</a></li>
        <li><a href="<?php echo e(route('timeline.index')); ?>">Timeline</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Store</h4>
      <ul>
        <li><a href="<?php echo e(route('shop.index')); ?>">All Items</a></li>
        <li><a href="<?php echo e(route('shop.index')); ?>?type=game">Base Game</a></li>
        <li><a href="<?php echo e(route('shop.index')); ?>?type=bundle">Bundles</a></li>
        <li><a href="<?php echo e(route('shop.index')); ?>?type=currency">Currency</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Account</h4>
      <ul>
        <?php if(auth()->guard()->check()): ?>
        <li><a href="<?php echo e(route('profile')); ?>">My Profile</a></li>
        <li><a href="<?php echo e(route('orders.index')); ?>">My Orders</a></li>
        <?php else: ?>
        <li><a href="<?php echo e(route('login')); ?>">Login</a></li>
        <li><a href="<?php echo e(route('register')); ?>">Register</a></li>
        <?php endif; ?>
        <li><a href="<?php echo e(route('cart.index')); ?>">Cart</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <span>© <?php echo e(date('Y')); ?> Echo-Realm. All rights reserved.</span>
    <span style="letter-spacing:0.35em;font-size:0.6rem;opacity:0.4">THE RESONANCE AWAITS</span>
  </div>
</footer>
</div>

<script>
// Scroll nav
window.addEventListener('scroll',()=>document.getElementById('nav').classList.toggle('scrolled',scrollY>20));

// Particles
(function(){
  const c=document.getElementById('canvas'),x=c.getContext('2d');
  let W,H,P=[];
  function rs(){W=c.width=innerWidth;H=c.height=innerHeight}
  rs();window.addEventListener('resize',rs);
  function mk(){
    return{x:Math.random()*W,y:Math.random()*H,r:Math.random()*1.2+0.2,
      vx:(Math.random()-.5)*.15,vy:-Math.random()*.35-.05,
      a:Math.random()*.5+0.05,
      col:Math.random()<.6?'168,85,247':Math.random()<.5?'245,158,11':'34,211,238'}
  }
  for(let i=0;i<100;i++)P.push(mk());
  function draw(){
    x.clearRect(0,0,W,H);
    P.forEach(p=>{
      p.x+=p.vx;p.y+=p.vy;p.a-=.0006;
      if(p.a<=0||p.y<-10){Object.assign(p,mk(),{y:H+5})}
      x.beginPath();x.arc(p.x,p.y,p.r,0,Math.PI*2);
      x.fillStyle=`rgba(${p.col},${p.a})`;x.fill();
    });
    requestAnimationFrame(draw);
  }
  draw();
})();

// Reveal
new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting)e.target.classList.add('visible')}),{threshold:.12})
  .observe=function(el){el.querySelectorAll('.reveal').forEach(r=>this.__proto__.observe.call(this,r))};
const ro=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting)e.target.classList.add('visible')}),{threshold:.12});
document.querySelectorAll('.reveal').forEach(r=>ro.observe(r));

// Auto flash dismiss
setTimeout(()=>document.querySelectorAll('.flash').forEach(f=>f.remove()),4000);
</script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /opt/lampp/htdocs/echo-realm/resources/views/layouts/client.blade.php ENDPATH**/ ?>