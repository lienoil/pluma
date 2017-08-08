<?php if($resources->lastPage() > 1): ?>
<ul class="pagination paginate-custom m-1">
    <li class="waves-effect <?php echo e(($resources->currentPage() == 1) ? ' disabled' : ''); ?>">
        <a class="" href="<?php echo e($resources->url(1)); ?>">&laquo;</a>
     </li>
    <li class="waves-effect <?php echo e(($resources->currentPage() == 1) ? ' disabled' : ''); ?>">
        <a class="" href="<?php echo e($resources->url($resources->currentPage()-1)); ?>">&lsaquo;</a>
    </li>
    <?php for($i = 1; $i <= $resources->lastPage(); $i++): ?>
        <li class="waves-effect <?php echo e(($resources->currentPage() == $i) ? ' active' : ''); ?>">
        <?php echo $resources->currentPage() == $i ? '<span class="p-0" style="height: 30px; line-height: 27px; width: 30px; font-size: 1.2rem;">'.$i.'</span>' : '<a class="" href="'. $resources->url($i) . '">' .$i.'</a>'; ?>


        </li>
    <?php endfor; ?>
    <li class="waves-effect <?php echo e(($resources->currentPage() == $resources->lastPage()) ? ' disabled' : ''); ?>">
        <a class="" href="<?php echo e($resources->url($resources->currentPage()+1)); ?>" >&rsaquo;</a>
    </li>
    <li class="waves-effect <?php echo e(($resources->currentPage() == $resources->lastPage()) ? ' disabled' : ''); ?>">
        <a class="" href="<?php echo e($resources->url($resources->lastPage())); ?>">&raquo;</a>
    </li>
</ul>
<?php endif; ?>