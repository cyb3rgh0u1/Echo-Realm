<?php $__env->startSection('title','Shop'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .shop-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); 
        gap: 2rem; 
    }
    
    /* Filter Buttons */
    .type-btn { 
        font-family: var(--font-heading); 
        font-size: 0.65rem; 
        letter-spacing: 0.15em; 
        text-transform: uppercase; 
        padding: 0.65rem 1.25rem; 
        border-radius: 4px; 
        text-decoration: none; 
        transition: all 0.3s; 
        border: 1px solid var(--border); 
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .type-btn:hover, .type-btn.active { 
        background: rgba(255,255,255,0.05); 
        border-color: var(--accent); 
        color: #fff; 
    }
    .type-btn svg { width: 13px; height: 13px; }

    /* Card Architecture */
    .shop-card { 
        background: rgba(255,255,255,0.02); 
        border: 1px solid var(--border);
        transition: transform 0.3s ease, border-color 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%; /* Ensures all cards in a row match height */
    }
    .shop-card:hover { 
        transform: translateY(-5px); 
        border-color: var(--border-bright); 
    }
    
    .shop-img { 
        aspect-ratio: 16/9; 
        background: var(--void); 
        overflow: hidden; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        position: relative;
        flex-shrink: 0;
    }
    .shop-img svg.placeholder-icon { width: 48px; height: 48px; opacity: 0.05; stroke-width: 1; }

    /* Badge & Tag Styling */
    .shop-discount { 
        position: absolute; top: 12px; left: 12px; background: var(--red); 
        color: #fff; font-size: 0.65rem; font-weight: 700; padding: 2px 6px; border-radius: 2px; 
    }
    .shop-featured-tag { 
        position: absolute; top: 12px; right: 12px; background: var(--accent); 
        color: var(--void); font-size: 0.6rem; font-weight: 800; text-transform: uppercase; 
        padding: 2px 8px; border-radius: 2px; letter-spacing: 0.05em;
    }

    /* Card Content Alignment */
    .shop-body { 
        padding: 1.5rem; 
        display: flex; 
        flex-direction: column; 
        flex-grow: 1; /* Fills the vertical space */
    }

    .shop-desc { 
        margin-top: 0.6rem; 
        font-size: 0.85rem; 
        color: var(--text-muted); 
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .include-item { display: flex; align-items: center; gap: 8px; color: var(--text-muted); font-size: 0.75rem; margin-bottom: 0.4rem; }
    .include-icon { width: 10px; height: 10px; color: var(--accent); flex-shrink: 0; }

    /* Footer Alignment (Bottom pinning) */
    .shop-footer { 
        margin-top: auto; /* Pushes price and buttons to the bottom */
        padding-top: 1.5rem;
    }
    .shop-pricing { margin-bottom: 1rem; display: flex; align-items: baseline; gap: 10px; }
    .price-current { font-family: var(--font-heading); font-size: 1.25rem; color: #fff; }
    .price-old { font-size: 0.85rem; color: var(--text-dim); text-decoration: line-through; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<?php
    $icons = [
        'all'       => '<rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect>',
        'game'      => '<rect x="2" y="6" width="20" height="12" rx="2"></rect><path d="M6 12h4m-2-2v4m7-2h.01m2.99 0h.01"></path>',
        'character' => '<path d="M12 2l3 9 9 3-9 3-3 9-3-9-9-3 9-3 3-9z"></path>',
        'skin'      => '<path d="M12 2v20m10-10H2"></path><circle cx="12" cy="12" r="3"></circle>',
        'bundle'    => '<path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path>',
        'currency'  => '<path d="M6 3h12l4 6-10 12L2 9z"></path>',
        'cosmetic'  => '<path d="M12 21c-3.1 0-5.6-2.5-5.6-5.6 0-3.1 2.5-5.6 5.6-5.6s5.6 2.5 5.6 5.6c0 3.1-2.5 5.6-5.6 5.6z"></path><path d="M12 10V2"></path>',
        'info'      => '<circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line>',
        'bullet'    => '<polyline points="20 6 9 17 4 12"></polyline>'
    ];
?>

<div class="page-hero">
  <div class="page-hero-bg"></div>
  <div style="position:relative;z-index:1">
    <p class="section-label">Realm Store</p>
    <h1 class="section-title">The Echo Market</h1>
    <p class="section-subtitle" style="margin:0 auto">Secure resources to navigate the broken resonance.</p>
  </div>
</div>

<div class="section">
  <div class="container">
    
    <div style="display:flex;gap:0.75rem;flex-wrap:wrap;margin-bottom:3rem">
      <?php $curType = request('type'); ?>
      <a href="<?php echo e(route('shop.index')); ?>" class="type-btn <?php echo e(!$curType ? 'active' : ''); ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $icons['all']; ?></svg>
        All
      </a>
      <?php
        $shopTypes = ['game' => 'Game', 'character' => 'Characters', 'skin' => 'Skins', 'bundle' => 'Bundles', 'currency' => 'Currency', 'cosmetic' => 'Cosmetics'];
      ?>
      <?php $__currentLoopData = $shopTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('shop.index')); ?>?type=<?php echo e($val); ?>" class="type-btn <?php echo e($curType === $val ? 'active' : ''); ?>">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $icons[$val] ?? ''; ?></svg>
          <?php echo e($label); ?>

        </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="shop-grid">
      <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="card shop-card reveal" style="transition-delay:<?php echo e(($i % 8) * 0.07); ?>s">
          <div class="shop-img">
            <?php if($item->image): ?>
              <img src="<?php echo e(asset('storage/'.$item->image)); ?>" alt="<?php echo e($item->name); ?>" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0">
            <?php else: ?>
              <svg class="placeholder-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><?php echo $icons[$item->type] ?? $icons['game']; ?></svg>
            <?php endif; ?>

            <?php if($item->discount_percent): ?> <span class="shop-discount">-<?php echo e($item->discount_percent); ?>%</span> <?php endif; ?>
            <?php if($item->is_featured): ?> <span class="shop-featured-tag">Featured</span> <?php endif; ?>
          </div>

          <div class="shop-body">
            <div style="margin-bottom:0.75rem">
                <span class="badge badge-<?php echo e($item->rarity); ?>"><?php echo e(strtoupper($item->rarity)); ?></span>
            </div>
            
            <div class="shop-name" style="font-weight:600; font-size:1.15rem; color:#fff"><?php echo e($item->name); ?></div>
            <p class="shop-desc"><?php echo e($item->description); ?></p>
            
            <?php if($item->includes && count($item->includes)): ?>
            <div style="margin-top: 1.25rem;">
              <?php $__currentLoopData = array_slice($item->includes, 0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="include-item">
                <svg class="include-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><?php echo $icons['bullet']; ?></svg>
                <?php echo e($inc); ?>

              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>

            <div class="shop-footer">
                <div class="shop-pricing">
                  <span class="price-current">$<?php echo e(number_format($item->price, 2)); ?></span>
                  <?php if($item->original_price): ?>
                  <span class="price-old">$<?php echo e(number_format($item->original_price, 2)); ?></span>
                  <?php endif; ?>
                </div>

                <div style="display:grid;grid-template-columns:1fr 50px;gap:0.5rem">
                  <form action="<?php echo e(route('cart.add')); ?>" method="POST" style="margin:0">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="item_id" value="<?php echo e($item->id); ?>">
                    <button type="submit" class="btn btn-gold" style="width:100%; justify-content:center; padding: 0.8rem">Get Now</button>
                  </form>
                  <a href="<?php echo e(route('shop.show', $item->slug)); ?>" class="btn btn-outline" style="display:flex;align-items:center;justify-content:center; padding:0">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <?php echo $icons['info']; ?>

                    </svg>
                  </a>
                </div>
            </div>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div style="grid-column:1/-1;text-align:center;padding:6rem 2rem; border: 1px dashed var(--border); border-radius:8px">
          <p style="font-family:var(--font-heading); color:var(--text-dim); opacity:0.5">Inventory Depleted</p>
        </div>
      <?php endif; ?>
    </div>
    <div style="margin-top:3rem"><?php echo e($items->links()); ?></div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/echo-realm/resources/views/client/shop/index.blade.php ENDPATH**/ ?>