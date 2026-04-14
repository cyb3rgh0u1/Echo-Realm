<?php $__env->startSection('title','Story Arcs'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header">
  <div><div class="page-title">Story Arcs</div><div class="page-sub"><?php echo e($stories->total()); ?> chapters</div></div>
  <a href="<?php echo e(route('admin.stories.create')); ?>" class="btn btn-primary">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    New Chapter
  </a>
</div>
<div class="card">
  <div class="tw">
    <table>
      <thead><tr><th>Chapter</th><th>Arc</th><th>Status</th><th>Published</th><th>Actions</th></tr></thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $stories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td>
            <div style="font-weight:500;font-size:0.82rem"><?php echo e($story->title); ?></div>
            <div style="color:var(--muted);font-size:0.7rem"><?php echo e(Str::limit($story->synopsis,55)); ?></div>
          </td>
          <td><span class="badge badge-purple">Arc <?php echo e($story->arc_number); ?> · Ch. <?php echo e($story->chapter_number); ?></span></td>
          <td>
            <?php if($story->status==='ongoing'): ?><span class="badge badge-green">Ongoing</span>
            <?php elseif($story->status==='completed'): ?><span class="badge badge-purple">Completed</span>
            <?php else: ?><span class="badge badge-gold">Hiatus</span><?php endif; ?>
          </td>
          <td><?php if($story->is_published): ?><span class="badge badge-green">Live</span><?php else: ?><span class="badge badge-gray">Draft</span><?php endif; ?></td>
          <td>
            <div class="td-actions">
              <a href="<?php echo e(route('admin.stories.edit',$story->id)); ?>" class="btn btn-xs btn-success">Edit</a>
              <form action="<?php echo e(route('admin.stories.destroy',$story->id)); ?>" method="POST" onsubmit="return confirm('Delete?')">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="btn btn-xs btn-danger">Delete</button>
              </form>
            </div>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="5" style="text-align:center;color:var(--muted);padding:2rem">No chapters yet.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <?php if($stories->hasPages()): ?><div style="padding:1rem 1.25rem;border-top:1px solid var(--b1)"><?php echo e($stories->links()); ?></div><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/echo-realm/resources/views/admin/stories/index.blade.php ENDPATH**/ ?>