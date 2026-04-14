<?php $__env->startSection('title','Elements'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header">
  <div><div class="page-title">Elements</div><div class="page-sub"><?php echo e($elements->count()); ?> elements</div></div>
  <a href="<?php echo e(route('admin.elements.create')); ?>" class="btn btn-primary">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    New Element
  </a>
</div>
<div class="card">
  <div class="tw">
    <table>
      <thead><tr><th>Element</th><th>Color</th><th>Characters</th><th>Actions</th></tr></thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $el): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td>
            <div style="display:flex;align-items:center;gap:0.75rem">
              <div style="width:34px;height:34px;border-radius:4px;background:<?php echo e($el->color); ?>12;border:1px solid <?php echo e($el->color); ?>28;flex-shrink:0"></div>
              <div>
                <div style="font-weight:500;font-size:0.82rem"><?php echo e($el->name); ?></div>
                <div style="color:var(--muted);font-size:0.7rem"><?php echo e(Str::limit($el->description,55)); ?></div>
              </div>
            </div>
          </td>
          <td>
            <div style="display:flex;align-items:center;gap:0.5rem">
              <div style="width:12px;height:12px;border-radius:50%;background:<?php echo e($el->color); ?>;flex-shrink:0"></div>
              <code style="font-size:0.7rem;color:var(--muted)"><?php echo e($el->color); ?></code>
            </div>
          </td>
          <td><span class="badge badge-purple"><?php echo e($el->characters_count); ?></span></td>
          <td>
            <div class="td-actions">
              <a href="<?php echo e(route('admin.elements.edit',$el->id)); ?>" class="btn btn-xs btn-success">Edit</a>
              <form action="<?php echo e(route('admin.elements.destroy',$el->id)); ?>" method="POST" onsubmit="return confirm('Delete <?php echo e($el->name); ?>?')">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-xs btn-danger">Delete</button>
              </form>
            </div>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="4" style="text-align:center;color:var(--muted);padding:2rem">No elements yet.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/echo-realm/resources/views/admin/elements/index.blade.php ENDPATH**/ ?>