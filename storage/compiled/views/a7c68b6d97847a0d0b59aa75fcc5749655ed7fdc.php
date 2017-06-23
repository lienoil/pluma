<?php if($errors->has($field)): ?>
    <span class="mdl-textfield__error error help-block"><?php echo e($errors->first($field)); ?></span>
<?php endif; ?>