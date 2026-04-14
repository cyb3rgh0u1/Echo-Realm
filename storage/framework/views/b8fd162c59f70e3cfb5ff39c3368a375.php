<?php $__env->startSection('title','Users'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header">
  <div><div class="page-title">Users</div><div class="page-sub"><?php echo e($users->total()); ?> registered</div></div>
</div>
<form method="GET" class="search-bar">
  <input type="text" name="search" class="search-input" placeholder="Search by name or email..." value="<?php echo e(request('search')); ?>">
  <button type="submit" class="btn btn-outline">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
    Search
  </button>
  <?php if(request('search')): ?><a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-outline">Clear</a><?php endif; ?>
</form>
<div class="card">
  <div class="tw">
    <table>
      <thead><tr><th>User</th><th>Email</th><th>Orders</th><th>Joined</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td>
            <div style="display:flex;align-items:center;gap:0.6rem">
              <div style="width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,var(--a),var(--gold));display:flex;align-items:center;justify-content:center;font-size:0.62rem;font-weight:700;color:#fff;flex-shrink:0;font-family:var(--fh)"><?php echo e(strtoupper(substr($user->name,0,1))); ?></div>
              <div>
                <div style="font-weight:500;font-size:0.82rem"><?php echo e($user->name); ?></div>
                <div style="color:var(--muted);font-size:0.68rem"><?php echo e('@'.$user->username); ?></div>
              </div>
            </div>
          </td>
          <td style="color:var(--muted);font-size:0.78rem"><?php echo e($user->email); ?></td>
          <td><span class="badge badge-gray"><?php echo e($user->orders->count()); ?></span></td>
          <td style="color:var(--muted);font-size:0.72rem"><?php echo e($user->created_at->format('M d, Y')); ?></td>
          <td><?php if($user->is_banned): ?><span class="badge badge-red">Banned</span><?php else: ?><span class="badge badge-green">Active</span><?php endif; ?></td>
          <td>
            <div class="td-actions">
              <a href="<?php echo e(route('admin.users.show',$user->id)); ?>" class="btn btn-xs btn-outline">View</a>
              <form action="<?php echo e(route('admin.users.toggle-ban',$user->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-xs <?php echo e($user->is_banned ? 'btn-success' : 'btn-danger'); ?>">
                  <?php echo e($user->is_banned ? 'Unban' : 'Ban'); ?>

                </button>
              </form>
            </div>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:2rem">No users found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <?php if($users->hasPages()): ?><div style="padding:1rem 1.25rem;border-top:1px solid var(--b1)"><?php echo e($users->links()); ?></div><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/echo-realm/resources/views/admin/users/index.blade.php ENDPATH**/ ?>