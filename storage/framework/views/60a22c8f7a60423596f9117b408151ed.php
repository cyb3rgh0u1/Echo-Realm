<?php $__env->startSection('title', isset($shop) ? 'Edit Item' : 'New Shop Item'); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb"><a href="<?php echo e(route('admin.shop.index')); ?>">Shop</a><span>/</span><span><?php echo e(isset($shop)?'Edit':'New'); ?></span></div>
<div class="page-header"><div class="page-title"><?php echo e(isset($shop)?'Edit: '.$shop->name:'New Shop Item'); ?></div></div>
<form action="<?php echo e(isset($shop)?route('admin.shop.update',$shop->id):route('admin.shop.store')); ?>" method="POST" enctype="multipart/form-data">
  <?php echo csrf_field(); ?> <?php if(isset($shop)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
  <div style="display:grid;grid-template-columns:2fr 1fr;gap:1.25rem;align-items:start">
    <div>
      <div class="card" style="margin-bottom:1.25rem">
        <div class="card-body">
          <div class="form-group"><label class="form-label">Item Name *</label><input type="text" name="name" class="form-control" value="<?php echo e(old('name',$shop->name??'')); ?>" required></div>
          <div class="form-group"><label class="form-label">Description *</label><textarea name="description" class="form-control" rows="4" required><?php echo e(old('description',$shop->description??'')); ?></textarea></div>
          <div class="form-group"><label class="form-label">What's Included (one item per line)</label><textarea name="includes" class="form-control" rows="5" placeholder="Base game access&#10;All starter characters&#10;1000 Shards"><?php echo e(old('includes', isset($shop) && $shop->includes ? implode("\n",$shop->includes) : '')); ?></textarea></div>
        </div>
      </div>
      <div class="card">
        <div class="card-header"><span class="card-title">Image</span></div>
        <div class="card-body">
          <?php if(isset($shop) && $shop->image): ?><div style="margin-bottom:0.75rem;text-align:center"><img src="<?php echo e(asset('storage/'.$shop->image)); ?>" style="max-height:100px;border-radius:6px;border:1px solid var(--border)"></div><?php endif; ?>
          <input type="file" name="image" class="form-control" accept="image/*">
        </div>
      </div>
    </div>
    <div>
      <div class="card" style="margin-bottom:1.25rem">
        <div class="card-body">
          <div class="form-group"><label class="form-label">Type *</label>
            <select name="type" class="form-control">
              <?php $__currentLoopData = ['game','character','skin','bundle','currency','consumable','cosmetic']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($t); ?>" <?php echo e(old('type',$shop->type??'cosmetic')===$t?'selected':''); ?>><?php echo e(ucfirst($t)); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
          <div class="form-group"><label class="form-label">Rarity *</label>
            <select name="rarity" class="form-control">
              <?php $__currentLoopData = ['common','uncommon','rare','epic','legendary']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($r); ?>" <?php echo e(old('rarity',$shop->rarity??'common')===$r?'selected':''); ?>><?php echo e(ucfirst($r)); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
          <div class="form-group"><label class="form-label">Price ($) *</label><input type="number" name="price" class="form-control" value="<?php echo e(old('price',$shop->price??'')); ?>" step="0.01" min="0" required></div>
          <div class="form-group"><label class="form-label">Original Price ($)</label><input type="number" name="original_price" class="form-control" value="<?php echo e(old('original_price',$shop->original_price??'')); ?>" step="0.01" min="0"><div class="form-hint">Leave blank if no discount</div></div>
          <div class="form-group"><label class="form-label">Stock (-1 = unlimited)</label><input type="number" name="stock" class="form-control" value="<?php echo e(old('stock',$shop->stock??-1)); ?>"></div>
          <div style="display:flex;flex-direction:column;gap:0.6rem;margin-top:0.5rem">
            <label class="form-check"><input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active',($shop->is_active??true))?'checked':''); ?>><span class="form-check-label">Active (visible in shop)</span></label>
            <label class="form-check"><input type="checkbox" name="is_featured" value="1" <?php echo e(old('is_featured',($shop->is_featured??false))?'checked':''); ?>><span class="form-check-label">Featured (on homepage)</span></label>
          </div>
        </div>
      </div>
      <div style="display:flex;gap:0.75rem">
        <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center"><?php echo e(isset($shop)?'✓ Update':'+ Create'); ?></button>
        <a href="<?php echo e(route('admin.shop.index')); ?>" class="btn btn-outline">Cancel</a>
      </div>
    </div>
  </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/echo-realm/resources/views/admin/shop/edit.blade.php ENDPATH**/ ?>