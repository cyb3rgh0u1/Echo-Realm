<?php $__env->startSection('title', isset($lore) ? 'Edit Lore' : 'New Lore Entry'); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb"><a href="<?php echo e(route('admin.lore.index')); ?>">Lore</a><span>/</span><span><?php echo e(isset($lore) ? 'Edit' : 'New'); ?></span></div>
<div class="page-header"><div class="page-title"><?php echo e(isset($lore) ? 'Edit: '.$lore->title : 'New Lore Entry'); ?></div></div>
<form action="<?php echo e(isset($lore) ? route('admin.lore.update',$lore->id) : route('admin.lore.store')); ?>" method="POST">
  <?php echo csrf_field(); ?> <?php if(isset($lore)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
  <div style="display:grid;grid-template-columns:2fr 1fr;gap:1.25rem;align-items:start">
    <div>
      <div class="card" style="margin-bottom:1.25rem">
        <div class="card-body">
          <div class="form-group"><label class="form-label">Title *</label><input type="text" name="title" class="form-control" value="<?php echo e(old('title',$lore->title??'')); ?>" required></div>
          <div class="form-group"><label class="form-label">Excerpt</label><textarea name="excerpt" class="form-control" rows="2"><?php echo e(old('excerpt',$lore->excerpt??'')); ?></textarea></div>
          <div class="form-group"><label class="form-label">Full Content * (HTML supported)</label><textarea name="content" class="form-control" rows="16" required><?php echo e(old('content',$lore->content??'')); ?></textarea></div>
        </div>
      </div>
    </div>
    <div>
      <div class="card" style="margin-bottom:1.25rem">
        <div class="card-body">
          <div class="form-group"><label class="form-label">Category</label><input type="text" name="category" class="form-control" value="<?php echo e(old('category',$lore->category??'general')); ?>" placeholder="history, faction, bestiary..."></div>
          <div class="form-group"><label class="form-label">Classification</label>
            <select name="classification" class="form-control">
              <?php $__currentLoopData = ['public','classified','top_secret']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($c); ?>" <?php echo e(old('classification',$lore->classification??'public')===$c?'selected':''); ?>><?php echo e(ucfirst(str_replace('_',' ',$c))); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
          <div class="form-group"><label class="form-label">Read Time (minutes)</label><input type="number" name="read_time" class="form-control" value="<?php echo e(old('read_time',$lore->read_time??5)); ?>" min="1"></div>
          <div class="form-group"><label class="form-label">Tags (comma separated)</label><input type="text" name="tags" class="form-control" value="<?php echo e(old('tags', isset($lore) && $lore->tags ? implode(',',$lore->tags) : '')); ?>" placeholder="resonance, pillar, void"></div>
          <div class="form-group"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="<?php echo e(old('sort_order',$lore->sort_order??0)); ?>"></div>
          <label class="form-check"><input type="checkbox" name="is_published" value="1" <?php echo e(old('is_published',($lore->is_published??true))?'checked':''); ?>><span class="form-check-label">Published</span></label>
        </div>
      </div>
      <div style="display:flex;gap:0.75rem">
        <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center"><?php echo e(isset($lore)?'✓ Update':'+ Create'); ?></button>
        <a href="<?php echo e(route('admin.lore.index')); ?>" class="btn btn-outline">Cancel</a>
      </div>
    </div>
  </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/echo-realm/resources/views/admin/lore/edit.blade.php ENDPATH**/ ?>