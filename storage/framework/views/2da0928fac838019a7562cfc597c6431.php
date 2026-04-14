<?php $__env->startSection('title','Timeline'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    :root {
        --tl-border: rgba(255,255,255,0.08);
    }

    .timeline-wrapper { 
        position: relative; 
        max-width: 1000px; 
        margin: 0 auto; 
        padding: 4rem 1.5rem 8rem; 
    }

    /* The central line */
    .timeline-line { 
        position: absolute; 
        left: 50%; 
        top: 0; 
        bottom: 0; 
        width: 1px; 
        background: linear-gradient(to bottom, transparent, var(--tl-border) 5%, var(--tl-border) 95%, transparent);
        transform: translateX(-50%);
    }

    .era-label { text-align: center; margin: 4rem 0 3rem; position: relative; z-index: 10; }
    .era-label span { 
        display: inline-block; 
        background: var(--void); 
        border: 1px solid var(--tl-border); 
        font-family: var(--font-heading); 
        font-size: 0.7rem; 
        letter-spacing: 0.4em; 
        text-transform: uppercase; 
        color: var(--accent); 
        padding: 0.5rem 2rem; 
        border-radius: 30px;
        backdrop-filter: blur(10px);
    }

    .tl-item { 
        display: grid; 
        grid-template-columns: 1fr 80px 1fr; 
        align-items: center; 
        margin-bottom: 4rem; 
        position: relative; 
        z-index: 2; 
    }

    /* Card Styling */
    .tl-content { 
        background: rgba(255,255,255,0.02); 
        border: 1px solid var(--tl-border); 
        border-radius: 12px; 
        padding: 1.5rem; 
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
    }

    .tl-content:hover { 
        border-color: rgba(255,255,255,0.2);
        transform: translateY(-5px);
        background: rgba(255,255,255,0.05);
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    }

    /* Alignment Logic */
    .tl-left .tl-content-wrapper { text-align: right; }
    .tl-left .tl-header { justify-content: flex-end; }
    .tl-right .tl-content-wrapper { grid-column: 3; }
    .tl-right .tl-dot-col { grid-column: 2; }

    .tl-header { display: flex; align-items: center; gap: 10px; margin-bottom: 0.6rem; }
    .tl-icon { width: 16px; height: 16px; opacity: 0.9; }

    .tl-dot-col { display: flex; justify-content: center; align-items: center; }
    .tl-dot { 
        width: 14px; 
        height: 14px; 
        border-radius: 50%; 
        z-index: 5; 
        border: 3px solid var(--void);
    }

    .tl-year { font-family: var(--font-heading); font-size: 0.75rem; font-weight: 700; letter-spacing: 0.15em; }
    .tl-title { font-family: var(--font-heading); font-size: 1.1rem; color: #fff; margin-bottom: 0.5rem; }
    .tl-desc { color: var(--text-muted); font-size: 0.85rem; line-height: 1.7; opacity: 0.8; }

    /* Mobile Logic */
    @media(max-width: 768px) {
        .timeline-line { left: 30px; transform: none; }
        .tl-item { display: block; padding-left: 60px; margin-bottom: 3rem; }
        .tl-dot-col { position: absolute; left: 23px; top: 22px; }
        .tl-left .tl-content-wrapper { text-align: left; }
        .tl-left .tl-header { justify-content: flex-start; }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-hero">
  <div class="page-hero-bg"></div>
  <div style="position:relative;z-index:1">
    <p class="section-label">The Historical Record</p>
    <h1 class="section-title">The Echo-Realm Timeline</h1>
    <p class="section-subtitle" style="margin:0 auto">From the First Shattering to the present day.</p>
  </div>
</div>

<div class="section">
  <div class="timeline-wrapper">
    <div class="timeline-line"></div>

    <?php
      $typeIcons = [
        'war'         => '<path d="M14.5 2l6.5 6.5-9 9-4.5-4.5 7-7zM3 21l3-3m-4.5-1.5l1.5-1.5"></path>',
        'discovery'   => '<circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>',
        'birth'       => '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>',
        'death'       => '<path d="M9 12h6m-3-3v6m6-12c1.7 0 3 1.3 3 3v12c0 1.7-1.3 3-3 3H6c-1.7 0-3-1.3-3-3V6c0-1.7 1.3-3 3-3h12z"></path>',
        'catastrophe' => '<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line>',
        'miracle'     => '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>',
        'political'   => '<path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>',
        'cultural'    => '<rect x="2" y="10" width="20" height="12" rx="2"></rect><path d="M7 10V7a5 5 0 0 1 10 0v3"></path>',
      ];
      $currentEra = null;
      $itemIdx    = 0;
    ?>

    <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if($event->era !== $currentEra): ?>
        <?php $currentEra = $event->era; ?>
        <div class="era-label reveal"><span><?php echo e($currentEra); ?></span></div>
      <?php endif; ?>

      <?php
        $svgPath = $typeIcons[$event->type] ?? '<circle cx="12" cy="12" r="3"></circle>';
        $isEven  = ($itemIdx % 2 === 0);
      ?>

      <div class="tl-item reveal <?php echo e($isEven ? 'tl-left' : 'tl-right'); ?>" style="transition-delay:<?php echo e(($itemIdx % 6) * 0.1); ?>s">
        
        <div class="tl-content-wrapper">
            <div class="tl-content">
              <div class="tl-header">
                <svg class="tl-icon" viewBox="0 0 24 24" fill="none" stroke="<?php echo e($event->color); ?>" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <?php echo $svgPath; ?>

                </svg>
                <span class="tl-year" style="color:<?php echo e($event->color); ?>"><?php echo e($event->year_in_lore); ?></span>
              </div>
              <div class="tl-title"><?php echo e($event->title); ?></div>
              <p class="tl-desc"><?php echo e($event->description); ?></p>
            </div>
        </div>

        <div class="tl-dot-col">
          <div class="tl-dot" style="background:<?php echo e($event->color); ?>; box-shadow: 0 0 15px <?php echo e($event->color); ?>88;"></div>
        </div>

        <div class="tl-spacer"></div>
      </div>

      <?php $itemIdx++; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/echo-realm/resources/views/client/timeline/index.blade.php ENDPATH**/ ?>