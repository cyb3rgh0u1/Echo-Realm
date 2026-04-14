<?php $__env->startSection('title','Story Arcs'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .arc-section { margin-bottom: 5rem; }
    
    /* Header Refinement */
    .arc-header { 
        display: flex; 
        align-items: flex-end; 
        gap: 2rem; 
        margin-bottom: 2.5rem; 
        padding-bottom: 1.5rem; 
        border-bottom: 1px solid var(--border);
    }
    
    .arc-number { 
        font-family: var(--font-display); 
        font-size: 4rem; 
        font-weight: 900; 
        color: rgba(255,255,255,0.03); 
        line-height: 0.8; 
        flex-shrink: 0;
        letter-spacing: -0.05em;
    }

    .arc-info h2 { 
        font-family: var(--font-heading); 
        font-size: 1.2rem; 
        color: #fff; 
        letter-spacing: 0.2em; 
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }

    /* Status Badges */
    .arc-status { 
        font-family: var(--font-heading); 
        font-size: 0.6rem; 
        letter-spacing: 0.2em; 
        text-transform: uppercase; 
        padding: 0.3rem 0.8rem; 
        border-radius: 2px; 
    }
    .arc-status.ongoing { background: rgba(16,185,129,0.1); color: #10b981; border: 1px solid rgba(16,185,129,0.2); }
    .arc-status.completed { background: rgba(168,85,247,0.1); color: var(--accent); border: 1px solid rgba(168,85,247,0.2); }
    .arc-status.hiatus { background: rgba(245,158,11,0.1); color: var(--gold); border: 1px solid rgba(245,158,11,0.2); }

    /* Chapter Rows */
    .chapter-row { 
        display: grid; 
        grid-template-columns: 60px 1fr auto; 
        gap: 2rem; 
        align-items: center; 
        padding: 1.5rem 2rem; 
        background: rgba(255,255,255,0.01); 
        border: 1px solid var(--border); 
        border-radius: 4px; 
        text-decoration: none; 
        color: inherit; 
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); 
        margin-bottom: 0.75rem; 
    }

    .chapter-row:hover { 
        border-color: var(--accent); 
        transform: translateX(10px); 
        background: rgba(255,255,255,0.03);
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }

    .chapter-num { 
        font-family: var(--font-display); 
        font-size: 1.8rem; 
        font-weight: 800; 
        color: var(--text-dim); 
        opacity: 0.3;
        transition: all 0.3s;
    }
    .chapter-row:hover .chapter-num { color: var(--accent); opacity: 1; }

    .chapter-title { 
        font-family: var(--font-heading); 
        font-size: 1rem; 
        font-weight: 600; 
        color: #fff;
        margin-bottom: 0.4rem;
    }

    .chapter-synopsis { 
        color: var(--text-muted); 
        font-size: 0.8rem; 
        line-height: 1.6; 
        max-width: 600px;
        opacity: 0.7;
    }

    .read-btn { 
        display: flex;
        align-items: center;
        gap: 10px;
        font-family: var(--font-heading); 
        font-size: 0.65rem; 
        letter-spacing: 0.2em; 
        text-transform: uppercase; 
        color: var(--text-dim);
        transition: all 0.3s;
    }
    .chapter-row:hover .read-btn { color: var(--accent); }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<?php
    $icons = [
        'read' => '<line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline>',
        'arc'  => '<path d="M12 2l3 9 9 3-9 3-3 9-3-9-9-3 9-3 3-9z"></path>'
    ];
?>

<div class="page-hero">
  <div class="page-hero-bg"></div>
  <div style="position:relative;z-index:1">
    <p class="section-label">The Narrative</p>
    <h1 class="section-title">Story Arcs</h1>
    <p class="section-subtitle" style="margin:0 auto">The unfolding saga of the Echo-Realm. Every arc a new layer of the resonance mystery.</p>
  </div>
</div>

<div class="section">
  <div class="container" style="max-width: 1000px">
    <?php $__empty_1 = true; $__currentLoopData = $arcs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arcNum => $chapters): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php $firstChapter = $chapters->first(); ?>
    <div class="arc-section reveal">
      
      <div class="arc-header">
        <div class="arc-number"><?php echo e(sprintf('%02d', $arcNum)); ?></div>
        <div class="arc-info">
          <h2>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 8px; vertical-align: middle; opacity: 0.5"><?php echo $icons['arc']; ?></svg>
            Arc <?php echo e($arcNum); ?>

          </h2>
          <span class="arc-status <?php echo e($firstChapter->status); ?>"><?php echo e($firstChapter->status); ?></span>
        </div>
        <div style="margin-left:auto; color:var(--text-dim); font-family:var(--font-heading); font-size:0.65rem; letter-spacing:0.15em; text-transform:uppercase">
            <?php echo e($chapters->count()); ?> Files
        </div>
      </div>

      <?php $__currentLoopData = $chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <a href="<?php echo e(route('story.show', $story->slug)); ?>" class="chapter-row">
        <div class="chapter-num"><?php echo e(sprintf('%02d', $story->chapter_number)); ?></div>
        <div>
          <div class="chapter-title"><?php echo e($story->title); ?></div>
          <p class="chapter-synopsis"><?php echo e($story->synopsis); ?></p>
        </div>
        <div class="read-btn">
          ACCESS
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $icons['read']; ?></svg>
        </div>
      </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div style="text-align:center; padding:8rem 2rem; border:1px dashed var(--border); border-radius:8px">
      <p style="font-family:var(--font-heading); color:var(--text-dim); opacity:0.5; text-transform:uppercase; letter-spacing:0.2em">No Narrative Data Found</p>
    </div>
    <?php endif; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/echo-realm/resources/views/client/story/index.blade.php ENDPATH**/ ?>