<?php $__env->startSection('title','Orders'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header">
  <div><div class="page-title">Orders</div><div class="page-sub"><?php echo e($orders->total()); ?> total</div></div>
</div>
<div style="display:flex;gap:0.4rem;margin-bottom:1.1rem;flex-wrap:wrap">
  <?php $cur = request('status'); ?>
  <?php $__currentLoopData = [null=>'All','pending'=>'Pending','paid'=>'Paid','processing'=>'Processing','completed'=>'Completed','cancelled'=>'Cancelled','refunded'=>'Refunded']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <a href="<?php echo e(route('admin.orders.index').($val?'?status='.$val:'')); ?>"
     class="btn btn-xs <?php echo e(($cur===$val||(!$cur&&!$val)) ? 'btn-primary' : 'btn-outline'); ?>">
    <?php echo e($label); ?>

  </a>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="card">
  <div class="tw">
    <table>
      <thead><tr><th>Order</th><th>User</th><th>Items</th><th>Total</th><th>Status</th><th>Date</th><th>Actions</th></tr></thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
          $bc=['pending'=>'badge-gray','paid'=>'badge-cyan','processing'=>'badge-gold','completed'=>'badge-green','cancelled'=>'badge-red','refunded'=>'badge-gray'];
          $bs = $bc[$order->status] ?? 'badge-gray';
        ?>
        <tr>
          <td><a href="<?php echo e(route('admin.orders.show',$order->id)); ?>" style="color:var(--a2);font-weight:500"><?php echo e($order->order_number); ?></a></td>
          <td style="color:var(--muted)"><?php echo e($order->user->name ?? 'Deleted'); ?></td>
          <td style="color:var(--muted)"><?php echo e($order->items->count()); ?></td>
          <td style="color:var(--gold);font-weight:600">$<?php echo e(number_format($order->total,2)); ?></td>
          <td><span class="badge <?php echo e($bs); ?>"><?php echo e($order->status); ?></span></td>
          <td style="color:var(--muted);font-size:0.72rem"><?php echo e($order->created_at->format('M d, Y')); ?></td>
          <td><a href="<?php echo e(route('admin.orders.show',$order->id)); ?>" class="btn btn-xs btn-outline">View</a></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="7" style="text-align:center;color:var(--muted);padding:2rem">No orders.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <?php if($orders->hasPages()): ?><div style="padding:1rem 1.25rem;border-top:1px solid var(--b1)"><?php echo e($orders->links()); ?></div><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/echo-realm/resources/views/admin/orders/index.blade.php ENDPATH**/ ?>