<?php $__env->startSection("content"); ?>
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
            <table class="mdl-data-table mdl-shadow--2dp">
                <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">ID</th>
                        <th>Name</th>
                        <th>Code</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($resources->isEmpty()): ?>
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric" colspan="100%">
                                <div class="mdl-typography--text-center">No resource found</div>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php $__currentLoopData = $resources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resource): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($resource->id); ?></td>
                        <td><?php echo e($resource->name); ?> <span><?php echo e($resource->description); ?></span></td>
                        <td><?php echo e($resource->code); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("Frontier::layouts.admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>