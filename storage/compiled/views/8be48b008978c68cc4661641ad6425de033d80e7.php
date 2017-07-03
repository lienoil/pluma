<?php echo $__env->make("Frontier::partials.header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<v-app>
    <v-navigation-drawer></v-navigation-drawer>
    <v-toolbar></v-toolbar>
    <main>
    asd
        <v-container fluid>
            <router-view></router-view>
        </v-container>
    </main>
    <v-footer></v-footer>
</v-app>

<?php echo $__env->make("Frontier::partials.footer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
