<?php $__env->startSection('title', isset($element) ? 'Edit Element' : 'New Element'); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb">
  <a href="<?php echo e(route('admin.elements.index')); ?>">Elements</a><span>/</span>
  <span><?php echo e(isset($element) ? 'Edit: '.$element->name : 'New Element'); ?></span>
</div>
<div class="page-header"><div class="page-title"><?php echo e(isset($element) ? 'Edit Element' : 'New Element'); ?></div></div>
<div style="max-width:600px">
  <form action="<?php echo e(isset($element) ? route('admin.elements.update',$element->id) : route('admin.elements.store')); ?>" method="POST">
    <?php echo csrf_field(); ?> <?php if(isset($element)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
    <div class="card">
      <div class="card-body">
        <div class="form-group"><label class="form-label">Name *</label><input type="text" name="name" class="form-control" value="<?php echo e(old('name',$element->name??'')); ?>" required></div>
        <div class="form-group"><label class="form-label">Symbol / Emoji</label><input type="text" name="symbol" class="form-control" value="<?php echo e(old('symbol',$element->symbol??'')); ?>" placeholder="🔥"></div>
        <div class="form-group"><label class="form-label">Description *</label><textarea name="description" class="form-control" rows="3" required><?php echo e(old('description',$element->description??'')); ?></textarea></div>
        <div class="form-grid">
          <div class="form-group"><label class="form-label">Primary Color *</label><input type="color" name="color" class="form-control" value="<?php echo e(old('color',$element->color??'#a855f7')); ?>" required style="height:42px;padding:0.25rem"><div class="form-hint">Main element color (hex)</div></div>
          <div class="form-group"><label class="form-label">Glow Color *</label><input type="color" name="glow_color" class="form-control" value="<?php echo e(old('glow_color',$element->glow_color??'#c084fc')); ?>" required style="height:42px;padding:0.25rem"><div class="form-hint">Used for particle effects</div></div>
        </div>
      </div>
    </div>
    <div style="display:flex;gap:0.75rem;margin-top:1rem">
      <button type="submit" class="btn btn-primary"><?php echo e(isset($element) ? '✓ Update' : '+ Create'); ?> Element</button>
      <a href="<?php echo e(route('admin.elements.index')); ?>" class="btn btn-outline">Cancel</a>
    </div>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/echo-realm/resources/views/admin/elements/edit.blade.php ENDPATH**/ ?>