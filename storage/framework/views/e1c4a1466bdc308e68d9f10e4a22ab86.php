<?php if($paginator->hasPages()): ?>
<nav style="display:flex;justify-content:center;margin-top:1rem">
    <div style="display:flex;gap:0.35rem;flex-wrap:wrap">
        
        <?php if($paginator->onFirstPage()): ?>
            <span style="display:inline-flex;align-items:center;justify-content:center;padding:0.35rem 0.75rem;border-radius:6px;font-size:0.75rem;background:var(--panel2,#141428);border:1px solid var(--border,rgba(168,85,247,0.12));color:var(--dim,#3d3558)">«</span>
        <?php else: ?>
            <a href="<?php echo e($paginator->previousPageUrl()); ?>" style="display:inline-flex;align-items:center;justify-content:center;padding:0.35rem 0.75rem;border-radius:6px;font-size:0.75rem;background:var(--panel2,#141428);border:1px solid var(--border,rgba(168,85,247,0.12));color:var(--muted,#7a6f9a);text-decoration:none">«</a>
        <?php endif; ?>

        
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(is_string($element)): ?>
                <span style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:6px;font-size:0.75rem;color:var(--dim,#3d3558)"><?php echo e($element); ?></span>
            <?php endif; ?>
            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <span style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:6px;font-size:0.75rem;background:#a855f7;color:#fff;border:1px solid #a855f7"><?php echo e($page); ?></span>
                    <?php else: ?>
                        <a href="<?php echo e($url); ?>" style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:6px;font-size:0.75rem;background:var(--panel2,#141428);border:1px solid var(--border,rgba(168,85,247,0.12));color:var(--muted,#7a6f9a);text-decoration:none"><?php echo e($page); ?></a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <a href="<?php echo e($paginator->nextPageUrl()); ?>" style="display:inline-flex;align-items:center;justify-content:center;padding:0.35rem 0.75rem;border-radius:6px;font-size:0.75rem;background:var(--panel2,#141428);border:1px solid var(--border,rgba(168,85,247,0.12));color:var(--muted,#7a6f9a);text-decoration:none">»</a>
        <?php else: ?>
            <span style="display:inline-flex;align-items:center;justify-content:center;padding:0.35rem 0.75rem;border-radius:6px;font-size:0.75rem;background:var(--panel2,#141428);border:1px solid var(--border,rgba(168,85,247,0.12));color:var(--dim,#3d3558)">»</span>
        <?php endif; ?>
    </div>
</nav>
<?php endif; ?>
<?php /**PATH /opt/lampp/htdocs/echo-realm/resources/views/vendor/pagination/bootstrap-5.blade.php ENDPATH**/ ?>