<?php $__env->startSection('title','Lore Tomes'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header">
  <div><div class="page-title">Lore Tomes</div><div class="page-sub"><?php echo e($lore->total()); ?> entries</div></div>
  <a href="<?php echo e(route('admin.lore.create')); ?>" class="btn btn-primary">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    New Entry
  </a>
</div>
<div class="card">
  <div class="tw">
    <table>
      <thead><tr><th>Title</th><th>Category</th><th>Classification</th><th>Read Time</th><th>Published</th><th>Actions</th></tr></thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $lore; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td>
            <div style="font-weight:500;font-size:0.82rem"><?php echo e($entry->title); ?></div>
            <div style="color:var(--muted);font-size:0.7rem"><?php echo e(Str::limit($entry->excerpt,55)); ?></div>
          </td>
          <td style="color:var(--muted);font-size:0.76rem;text-transform:capitalize"><?php echo e($entry->category); ?></td>
          <td>
            <?php if($entry->classification === 'top_secret'): ?><span class="badge badge-red">Top Secret</span>
            <?php elseif($entry->classification === 'classified'): ?><span class="badge badge-gold">Classified</span>
            <?php else: ?><span class="badge badge-purple">Public</span><?php endif; ?>
          </td>
          <td style="color:var(--muted);font-size:0.76rem"><?php echo e($entry->read_time); ?>m</td>
          <td><?php if($entry->is_published): ?><span class="badge badge-green">Live</span><?php else: ?><span class="badge badge-gray">Draft</span><?php endif; ?></td>
          <td>
            <div class="td-actions">
              <a href="<?php echo e(route('admin.lore.edit',$entry->id)); ?>" class="btn btn-xs btn-success">Edit</a>
              <form action="<?php echo e(route('admin.lore.destroy',$entry->id)); ?>" method="POST" onsubmit="return confirm('Delete?')">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="btn btn-xs btn-danger">Delete</button>
              </form>
            </div>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:2rem">No lore entries.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <?php if($lore->hasPages()): ?><div style="padding:1rem 1.25rem;border-top:1px solid var(--b1)"><?php echo e($lore->links()); ?></div><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/echo-realm/resources/views/admin/lore/index.blade.php ENDPATH**/ ?>