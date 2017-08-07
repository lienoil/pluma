<v-alert
    
    icon="<?php echo e(Session::has("type") == 'success' ? 'check' : 'priority_high'); ?>"
    class="<?php echo e(Session::get("type")); ?> mb-4"
    dismissible
    transition="slide-y-reverse-transition"
    
    value="<?php echo e(Session::has("type") ? true : false); ?>"
>
    <v-card style="margin-bottom: -2rem;" class="elevation-1 mb--2" min-height="500px">
        <?php if(Session::has('title')): ?>
            <v-card-title class="headline"><?php echo e(__(Session::get('title'))); ?> <v-btn icon></v-btn></v-card-title>
        <?php endif; ?>

        <?php if(Session::has('message')): ?>
        <v-card-text class="text-xs-center">
            <?php echo e(__(Session::get('message'))); ?>

        </v-card-text>
        <?php endif; ?>
    </v-card>
</v-alert>
