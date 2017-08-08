<?php if($errors->has($field)): ?>
    
    <span class="error help-block"><?php echo e($errors->first($field)); ?></span>
<?php endif; ?>
