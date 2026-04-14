<?php $__env->startSection('title','Timeline Events'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header">
  <div><div class="page-title">Timeline</div><div class="page-sub"><?php echo e($events->total()); ?> events</div></div>
  <a href="<?php echo e(route('admin.timeline.create')); ?>" class="btn btn-primary">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    New Event
  </a>
</div>
<div class="card">
  <div class="tw">
    <table>
      <thead><tr><th>Event</th><th>Era</th><th>Year</th><th>Type</th><th>Published</th><th>Actions</th></tr></thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td>
            <div style="display:flex;align-items:center;gap:0.6rem">
              <div style="width:3px;height:32px;border-radius:2px;background:<?php echo e($ev->color); ?>;flex-shrink:0"></div>
              <div>
                <div style="font-weight:500;font-size:0.82rem"><?php echo e($ev->title); ?></div>
                <div style="color:var(--muted);font-size:0.7rem"><?php echo e(Str::limit($ev->description,50)); ?></div>
              </div>
            </div>
          </td>
          <td style="color:var(--muted);font-size:0.76rem"><?php echo e($ev->era); ?></td>
          <td style="color:var(--muted);font-size:0.72rem"><?php echo e($ev->year_in_lore); ?></td>
          <td><span class="badge" style="background:<?php echo e($ev->color); ?>12;color:<?php echo e($ev->color); ?>;border:1px solid <?php echo e($ev->color); ?>28"><?php echo e(ucfirst($ev->type)); ?></span></td>
          <td><?php if($ev->is_published): ?><span class="badge badge-green">Live</span><?php else: ?><span class="badge badge-gray">Draft</span><?php endif; ?></td>
          <td>
            <div class="td-actions">
              <a href="<?php echo e(route('admin.timeline.edit',$ev->id)); ?>" class="btn btn-xs btn-success">Edit</a>
              <form action="<?php echo e(route('admin.timeline.destroy',$ev->id)); ?>" method="POST" onsubmit="return confirm('Delete?')">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="btn btn-xs btn-danger">Delete</button>
              </form>
            </div>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="6" style="text-align:center;color:var(--muted);padding:2rem">No events.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <?php if($events->hasPages()): ?><div style="padding:1rem 1.25rem;border-top:1px solid var(--b1)"><?php echo e($events->links()); ?></div><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/echo-realm/resources/views/admin/timeline/index.blade.php ENDPATH**/ ?>