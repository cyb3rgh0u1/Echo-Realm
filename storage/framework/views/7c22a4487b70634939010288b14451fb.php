<?php $__env->startSection('title','My Orders'); ?>
<?php $__env->startSection('content'); ?>
<div style="padding:8rem 2rem 6rem;max-width:900px;margin:0 auto">
  <h1 class="section-title" style="margin-bottom:3rem">My Orders</h1>
  <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
  <a href="<?php echo e(route('orders.show',$order->id)); ?>" style="display:grid;grid-template-columns:1fr auto auto;gap:1.5rem;align-items:center;padding:1.25rem 1.5rem;background:var(--panel);border:1px solid var(--border);border-radius:10px;text-decoration:none;color:inherit;transition:all 0.3s;margin-bottom:0.75rem">
    <div>
      <div style="font-family:var(--font-heading);font-size:0.9rem;font-weight:600"><?php echo e($order->order_number); ?></div>
      <div style="color:var(--text-muted);font-size:0.75rem;margin-top:0.2rem"><?php echo e($order->created_at->format('M d, Y')); ?> · <?php echo e($order->items->count()); ?> items</div>
    </div>
    <?php $sc=['pending'=>'var(--text-muted)','paid'=>'var(--cyan)','processing'=>'var(--gold)','completed'=>'var(--green)','cancelled'=>'var(--red)','refunded'=>'var(--text-dim)']; ?>
    <span style="font-family:var(--font-heading);font-size:0.72rem;letter-spacing:0.1em;text-transform:uppercase;color:<?php echo e($sc[$order->status]??'var(--text-muted)'); ?>"><?php echo e(ucfirst($order->status)); ?></span>
    <span style="font-family:var(--font-display);font-size:1.1rem;font-weight:700;color:var(--gold)">$<?php echo e(number_format($order->total,2)); ?></span>
  </a>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
  <div style="text-align:center;padding:4rem;background:var(--panel);border:1px solid var(--border);border-radius:16px">
    <p style="font-family:var(--font-heading);color:var(--text-muted)">No orders yet. <a href="<?php echo e(route('shop.index')); ?>" style="color:var(--accent)">Start shopping →</a></p>
  </div>
  <?php endif; ?>
  <div style="margin-top:1.5rem"><?php echo e($orders->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/echo-realm/resources/views/client/shop/orders.blade.php ENDPATH**/ ?>