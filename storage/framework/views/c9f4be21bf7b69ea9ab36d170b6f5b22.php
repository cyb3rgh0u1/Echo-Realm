<?php $__env->startSection('title','Characters'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .char-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); 
        gap: 2.5rem; 
    }
    
    .char-card { 
        background: rgba(255,255,255,0.01); 
        border: 1px solid var(--border); 
        border-radius: 4px; 
        display: flex; 
        flex-direction: column; 
        height: 100%; 
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
    }

    .char-card:hover { 
        transform: translateY(-8px); 
        border-color: var(--accent);
        background: rgba(255,255,255,0.03);
        box-shadow: 0 30px 60px rgba(0,0,0,0.5);
    }

    .char-img-wrap { 
        aspect-ratio: 3/4; 
        background: var(--void); 
        position: relative; 
        overflow: hidden; 
        display: flex; 
        align-items: center; 
        justify-content: center;
        flex-shrink: 0;
    }

    .char-body { 
        padding: 1.75rem; 
        display: flex; 
        flex-direction: column; 
        flex-grow: 1; /* This fills the card height */
    }

    /* Status Bar Improvements */
    .stat-container { margin: 1.5rem 0; }
    .stat-bar { display: flex; align-items: center; gap: 12px; margin-bottom: 0.75rem; }
    .stat-label { 
        font-family: var(--font-heading); font-size: 0.55rem; 
        letter-spacing: 0.2em; color: var(--text-dim); width: 40px; 
    }
    .stat-track { flex: 1; height: 2px; background: rgba(255,255,255,0.05); position: relative; }
    .stat-fill { height: 100%; transition: width 1.5s cubic-bezier(0.1, 0, 0, 1); }
    .stat-val { font-family: var(--font-heading); font-size: 0.6rem; color: var(--text-muted); width: 25px; text-align: right; }

    /* Footer pinning */
    .char-footer { margin-top: auto; padding-top: 1.5rem; }

    .element-tag { 
        position: absolute; top: 1rem; right: 1rem; z-index: 5;
        padding: 0.4rem 0.8rem; border-radius: 2px; font-family: var(--font-heading);
        font-size: 0.55rem; letter-spacing: 0.15em; text-transform: uppercase;
        background: rgba(0,0,0,0.85); border: 1px solid rgba(255,255,255,0.1);
        backdrop-filter: blur(8px);
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<?php
    $icons = [
        'shield' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>',
        'profile' => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle>',
        'decryption' => '<polyline points="16 16 12 12 8 16"></polyline><line x1="12" y1="12" x2="12" y2="21"></line><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"></path><polyline points="16 16 12 12 8 16"></polyline>'
    ];
?>

<div class="page-hero">
  <div class="page-hero-bg"></div>
  <div style="position:relative;z-index:1">
    <p class="section-label">Operational Database</p>
    <h1 class="section-title">Resonance Signatures</h1>
    <p class="section-subtitle" style="margin:0 auto">Decrypted profiles of active Echoes within the Realm.</p>
  </div>
</div>

<div class="section">
  <div class="container">
    
    
    <p style="color:var(--text-dim); font-family:var(--font-heading); font-size:0.6rem; letter-spacing:0.3em; margin-bottom:2.5rem; opacity:0.5">
        <?php echo e($characters->count()); ?> ENTRIES VALIDATED
    </p>

    <div class="char-grid">
      <?php $__empty_1 = true; $__currentLoopData = $characters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $char): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="char-card reveal" style="transition-delay:<?php echo e(($i % 8) * 0.07); ?>s">
        
        <div class="char-img-wrap">
          <?php if($char->image): ?>
            <img src="<?php echo e(asset('storage/'.$char->image)); ?>" alt="<?php echo e($char->name); ?>" style="width:100%; height:100%; object-fit:cover; position:absolute; inset:0">
          <?php else: ?>
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="opacity:0.1"><?php echo $icons['profile']; ?></svg>
          <?php endif; ?>

          <div style="position:absolute; inset:0; background:linear-gradient(to top, var(--void) 0%, transparent 50%)"></div>
          
          <?php if($char->element): ?>
            <div class="element-tag" style="color:<?php echo e($char->element->color); ?>; border-color:<?php echo e($char->element->color); ?>44">
                <?php echo e($char->element->name); ?>

            </div>
          <?php endif; ?>
        </div>

        <div class="char-body">
          <div style="margin-bottom:1.25rem">
            <div style="display:flex; justify-content:space-between; align-items:center">
                <span class="badge badge-<?php echo e($char->rarity); ?>" style="font-size:0.55rem"><?php echo e(strtoupper($char->rarity)); ?></span>
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--text-dim)" stroke-width="2" style="opacity:0.3"><?php echo $icons['shield']; ?></svg>
            </div>
            <div style="font-family:var(--font-heading); font-size:1.2rem; font-weight:700; color:#fff; margin-top:0.5rem; letter-spacing:0.02em"><?php echo e($char->name); ?></div>
            <?php if($char->title): ?>
              <div style="color:var(--accent); font-size:0.65rem; text-transform:uppercase; letter-spacing:0.15em; margin-top:0.2rem; opacity:0.8"><?php echo e($char->title); ?></div>
            <?php endif; ?>
          </div>

          <p style="color:var(--text-muted); font-size:0.85rem; line-height:1.6; opacity:0.7; margin-bottom:1.5rem">
            <?php echo e(Str::limit($char->bio, 90)); ?>

          </p>

          <?php if($char->stats): ?>
          <div class="stat-container">
            <?php $__currentLoopData = ['attack'=>'ATK','magic'=>'MGC','speed'=>'SPD']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(isset($char->stats[$key])): ?>
                <div class="stat-bar">
                  <span class="stat-label"><?php echo e($label); ?></span>
                  <div class="stat-track">
                      <div class="stat-fill" style="width:<?php echo e($char->stats[$key]); ?>%; background:<?php echo e($char->element ? $char->element->color : 'var(--accent)'); ?>; box-shadow: 0 0 10px <?php echo e($char->element ? $char->element->color : 'var(--accent)'); ?>44;"></div>
                  </div>
                  <span class="stat-val"><?php echo e($char->stats[$key]); ?></span>
                </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          <?php endif; ?>

          <div class="char-footer">
              <a href="<?php echo e(route('characters.show', $char->slug)); ?>" class="btn btn-outline" style="width:100%; justify-content:center; gap:10px; font-size:0.7rem; letter-spacing:0.2em; text-transform:uppercase">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><?php echo $icons['decryption']; ?></svg>
                  Access File
              </a>
          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div style="grid-column:1/-1; text-align:center; padding:8rem 2rem; border:1px dashed var(--border); opacity:0.3">
        <p style="font-family:var(--font-heading); letter-spacing:0.2em">NO RESONANCE DETECTED</p>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/echo-realm/resources/views/client/characters/index.blade.php ENDPATH**/ ?>