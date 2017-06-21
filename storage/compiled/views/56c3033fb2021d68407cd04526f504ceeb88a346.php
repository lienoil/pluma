<?php if(Session::has('type') && Session::has('message')): ?>
    <div role="alert" class="alert alert-<?php echo e(Session::get('type')); ?> mt-3">
        <div class="banner-block">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span><?php echo Session::get('icon') or ''; ?><?php echo Session::get('title'); ?></span>
            <?php echo Session::get('message'); ?>

        </div>
    </div>
<?php endif; ?>