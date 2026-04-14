<?php $__env->startSection('title', $entry->title); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .lore-header { padding: 10rem 2rem 4rem; position: relative; overflow: hidden; }
    .lore-header-bg { 
        position: absolute; inset: 0; 
        background: radial-gradient(circle at center 20%, rgba(var(--accent-rgb), 0.08), transparent 70%); 
    }
    
    .lore-reading-width { max-width: 800px; margin: 0 auto; position: relative; z-index: 5; }
    
    /* Typography Refinement */
    .lore-body { font-size: 1.05rem; line-height: 1.85; color: var(--text-muted); letter-spacing: 0.01em; }
    .lore-body p { margin-bottom: 1.75rem; }
    .lore-body h2, .lore-body h3 { 
        font-family: var(--font-heading); color: #fff; margin: 3.5rem 0 1.25rem; 
        letter-spacing: 0.05em; text-transform: uppercase; font-size: 1.2rem;
    }
    
    .lore-body blockquote { 
        border-left: 2px solid var(--accent); padding: 1.5rem 2rem; margin: 2.5rem 0; 
        background: rgba(255, 255, 255, 0.02); border-radius: 0 4px 4px 0; 
        color: #fff; font-style: italic; font-size: 1.1rem;
    }
    
    .lore-body ul, .lore-body ol { padding-left: 1.5rem; margin-bottom: 1.5rem; }
    .lore-body li { margin-bottom: 0.75rem; }
    .lore-body strong { color: #fff; font-weight: 600; }
    
    /* Related Entry Cards */
    .related-card {
        display: block; padding: 1.5rem; background: rgba(255,255,255,0.01); 
        border: 1px solid var(--border); border-radius: 4px; text-decoration: none; 
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .related-card:hover { 
        background: rgba(255,255,255,0.03); border-color: var(--accent); 
        transform: translateX(10px); 
    }

    .meta-item { display: flex; align-items: center; gap: 6px; }
    .meta-icon { width: 14px; height: 14px; opacity: 0.5; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<?php
    $icons = [
        'back'     => '<line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline>',
        'clock'    => '<circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline>',
        'calendar' => '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line>',
        'tag'      => '<path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line>',
        'alert'    => '<circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line>'
    ];

    $classification = $entry->classification;
    $status = [
        'top_secret' => ['color' => 'var(--red)',  'label' => 'Level 5 Restricted'],
        'classified' => ['color' => 'var(--gold)', 'label' => 'Classified Archive'],
        'public'     => ['color' => 'var(--accent)', 'label' => 'Public Record']
    ][$classification] ?? ['color' => 'var(--accent)', 'label' => 'Public Record'];
?>

<div class="lore-header">
  <div class="lore-header-bg"></div>
  <div class="lore-reading-width">

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:3rem">
      <a href="<?php echo e(route('lore.index')); ?>" style="display:flex; align-items:center; gap:8px; color:var(--text-dim); text-decoration:none; font-family:var(--font-heading); font-size:0.65rem; letter-spacing:0.2em; text-transform:uppercase">
        <svg class="meta-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><?php echo $icons['back']; ?></svg>
        Return to Archives
      </a>
      <span style="display:flex; align-items:center; gap:6px; font-family:var(--font-heading); font-size:0.6rem; letter-spacing:0.25em; text-transform:uppercase; color:<?php echo e($status['color']); ?>">
        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><?php echo $icons['alert']; ?></svg>
        <?php echo e($status['label']); ?>

      </span>
    </div>

    <div style="font-family:var(--font-heading); font-size:0.65rem; letter-spacing:0.4em; text-transform:uppercase; color:var(--accent); margin-bottom:1rem; opacity:0.8">
      <?php echo e($entry->category); ?>

    </div>

    <h1 style="font-family:var(--font-display); font-size:clamp(2rem, 5vw, 3.5rem); font-weight:700; line-height:1.1; margin-bottom:2rem; color:#fff">
      <?php echo e($entry->title); ?>

    </h1>

    <?php if($entry->excerpt): ?>
    <div style="margin-bottom:2.5rem; padding: 2rem; background: rgba(255,255,255,0.01); border: 1px solid var(--border); border-left: 3px solid var(--accent)">
        <p style="color:var(--text-muted); font-size:1.1rem; line-height:1.7; font-style:italic; margin:0">
          <?php echo e($entry->excerpt); ?>

        </p>
    </div>
    <?php endif; ?>

    <div style="display:flex; align-items:center; gap:2rem; color:var(--text-dim); font-family:var(--font-heading); font-size:0.65rem; letter-spacing:0.15em; text-transform:uppercase">
      <div class="meta-item">
        <svg class="meta-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><?php echo $icons['clock']; ?></svg>
        <?php echo e($entry->read_time); ?> MIN READ
      </div>
      <div class="meta-item">
        <svg class="meta-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><?php echo $icons['calendar']; ?></svg>
        <?php echo e($entry->created_at->format('M Y')); ?>

      </div>
      <?php if($entry->tags && count($entry->tags)): ?>
        <div class="meta-item">
          <svg class="meta-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><?php echo $icons['tag']; ?></svg>
          <?php $__currentLoopData = $entry->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span style="color:var(--accent); margin-right:8px"><?php echo e($tag); ?></span>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      <?php endif; ?>
    </div>

  </div>
</div>

<div class="section" style="padding-top:0">
  <div class="lore-reading-width" style="padding:0 2rem">

    <div class="lore-body"><?php echo $entry->content; ?></div>

    <?php if($related->count()): ?>
    <div style="margin-top:6rem; padding-top:3rem; border-top:1px solid var(--border)">
      <p style="font-family:var(--font-heading); font-size:0.65rem; letter-spacing:0.4em; text-transform:uppercase; color:var(--accent); margin-bottom:2rem">
        Correlated Records
      </p>
      <div style="display:grid; gap:1rem">
        <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('lore.show', $rel->slug)); ?>" class="related-card">
          <div style="display:flex; justify-content:space-between; align-items:center">
            <div>
                <div style="font-family:var(--font-heading); font-size:1rem; font-weight:600; color:#fff; margin-bottom:0.25rem">
                    <?php echo e($rel->title); ?>

                </div>
                <div style="color:var(--text-dim); font-size:0.7rem; font-family:var(--font-heading); text-transform:uppercase; letter-spacing:0.1em">
                    <?php echo e($rel->read_time); ?> min · <?php echo e($rel->category); ?>

                </div>
            </div>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2"><path d="M5 12h14m-7-7l7 7-7 7"></path></svg>
          </div>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
    <?php endif; ?>

  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/echo-realm/resources/views/client/lore/show.blade.php ENDPATH**/ ?>