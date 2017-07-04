<v-navigation-drawer persistent :mini-variant.sync="mini" v-model="drawer" :dark.sync="dark">
    <v-list class="pa-0">
        <v-list-item>
            <v-list-tile avatar tag="div">
                <v-list-tile-avatar>
                    <img src="http://deepaelectronics.co.in/images/00205-3D-art-logo-design-free-logos-online-011.png">
                </v-list-tile-avatar>
                <v-list-tile-content>
                    <v-list-tile-title>{{ application.site.title }}</v-list-tile-title>
                </v-list-tile-content>
                <v-list-tile-action>
                    <v-btn icon @click.native.stop="mini = !mini" light>
                        <v-icon>chevron_left</v-icon>
                    </v-btn>
                </v-list-tile-action>
            </v-list-tile>
        </v-list-item>
    </v-list>

    <v-divider dark></v-divider>

    <v-list class="pa-0">
        <v-list-item>
            <v-list-tile avatar tag="div">
                <v-list-tile-avatar>
                    <img src="https://randomuser.me/api/portraits/women/70.jpg">
                </v-list-tile-avatar>
                <v-list-tile-content>
                    <v-list-tile-title>John Leider</v-list-tile-title>
                    <v-list-tile-subtitle><small>Superadmin</small></v-list-tile-subtitle>
                </v-list-tile-content>

            </v-list-tile>
        </v-list-item>
    </v-list>
    <v-divider dark></v-divider>

    <v-list dense>

        <?php echo $__env->make("Single::templates.navigations.sidebar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </v-list>
</v-navigation-drawer>

<?php $__env->startPush('js'); ?>
    <script>
        export default {
            data () {
                return {
                    drawer: true,
                    mini: false,
                    right: null,
                    dark: 'dark',
                }
            }
        }
    </script>
<?php $__env->stopPush(); ?>
