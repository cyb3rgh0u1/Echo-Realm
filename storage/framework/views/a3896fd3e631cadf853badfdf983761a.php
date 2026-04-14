<?php $__env->startSection('title','Characters'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header">
  <div>
    <div class="page-title">Characters</div>
    <div class="page-sub"><?php echo e($characters->total()); ?> total</div>
  </div>
  <a href="<?php echo e(route('admin.characters.create')); ?>" class="btn btn-primary">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    New Character
  </a>
</div>
<div class="card">
  <div class="tw">
    <table>
      <thead><tr><th>Character</th><th>Element</th><th>Rarity</th><th>Role</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $characters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $char): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td>
            <div style="display:flex;align-items:center;gap:0.75rem">
              <div style="width:36px;height:36px;border-radius:4px;background:var(--bg2);border:1px solid var(--b1);display:flex;align-items:center;justify-content:center;flex-shrink:0;overflow:hidden">
                <?php if($char->image): ?>
                  <img src="<?php echo e(asset('storage/'.$char->image)); ?>" style="width:100%;height:100%;object-fit:cover">
                <?php else: ?>
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--muted)" stroke-width="1.5"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                <?php endif; ?>
              </div>
              <div>
                <div style="font-weight:500;font-size:0.82rem"><?php echo e($char->name); ?></div>
                <?php if($char->title): ?><div style="color:var(--muted);font-size:0.68rem;font-style:italic"><?php echo e($char->title); ?></div><?php endif; ?>
              </div>
            </div>
          </td>
          <td>
            <?php if($char->element): ?>
            <span style="display:inline-flex;align-items:center;gap:0.3rem;font-size:0.7rem;padding:0.18rem 0.5rem;border-radius:2px;background:<?php echo e($char->element->color); ?>12;color:<?php echo e($char->element->color); ?>;border:1px solid <?php echo e($char->element->color); ?>28;font-family:var(--fh)">
              <?php echo e($char->element->name); ?>

            </span>
            <?php else: ?><span style="color:var(--dim)">—</span><?php endif; ?>
          </td>
          <td><span class="badge badge-<?php echo e($char->rarity); ?>"><?php echo e(ucfirst($char->rarity)); ?></span></td>
          <td style="color:var(--muted);text-transform:capitalize;font-size:0.76rem"><?php echo e($char->role); ?></td>
          <td>
            <div style="display:flex;gap:0.3rem;flex-wrap:wrap">
              <?php if($char->is_published): ?><span class="badge badge-green">Live</span><?php else: ?><span class="badge badge-gray">Draft</span><?php endif; ?>
              <?php if($char->is_featured): ?><span class="badge badge-gold">Featured</span><?php endif; ?>
            </div>
          </td>
          <td>
            <div class="td-actions">
              <a href="<?php echo e(route('admin.characters.show',$char->id)); ?>" class="btn btn-xs btn-outline">View</a>
              <a href="<?php echo e(route('admin.characters.edit',$char->id)); ?>" class="btn btn-xs btn-success">Edit</a>
              <form action="<?php echo e(route('admin.characters.destroy',$char->id)); ?>" method="POST" onsubmit="return confirm('Delete <?php echo e($char->name); ?>?')">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-xs btn-danger">Delete</button>
              </form>
            </div>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:3rem">
          No characters yet. <a href="<?php echo e(route('admin.characters.create')); ?>" style="color:var(--a2)">Create one</a>
        </td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <?php if($characters->hasPages()): ?><div style="padding:1rem 1.25rem;border-top:1px solid var(--b1)"><?php echo e($characters->links()); ?></div><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/echo-realm/resources/views/admin/characters/index.blade.php ENDPATH**/ ?>