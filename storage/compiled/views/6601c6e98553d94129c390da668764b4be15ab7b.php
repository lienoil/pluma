<v-navigation-drawer
    persistent
    :mini-variant.sync="mini"
    v-model="drawer"
    overflow
    :dark.sync="dark"
    :light.sync="light"
    booted="true"
    class="navigation-drawer--is-booted elevation-0"
>
    <v-toolbar flat class="transparent">
        <v-list class="pa-0">
            <v-list-tile tag="div">
                <v-list-tile-avatar>
                    <?php echo $__env->make("Frontier::partials.brand", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </v-list-tile-avatar>
                <v-list-tile-content>
                    <v-list-tile-title><?php echo e($application->site->title); ?></v-list-tile-title>
                </v-list-tile-content>
                <v-list-tile-action>
                    <v-btn icon @click.native.stop="mini = !mini">
                        <v-icon>chevron_left</v-icon>
                    </v-btn>
                </v-list-tile-action>
            </v-list-tile>
        </v-list>
    </v-toolbar>

    <v-divider :dark.sync="dark" :light.sync="light"></v-divider>

    <v-toolbar flat class="transparent">
        <v-list class="pa-0">
            <v-list-tile tag="div" :class="theme.avatar" class="lighten-1">
                <v-list-tile-avatar>
                    <img src="<?php echo e(is_null(user()->avatar) ? '//placeimg.com/100/100/people' : user()->avatar); ?>">
                </v-list-tile-avatar>
                <v-list-tile-content>
                    <v-list-tile-title><?php echo e(user()->displayname); ?></v-list-tile-title>
                    <small><?php echo e(is_null(user()->displayrole) ? __('Guest') : user()->displayrole); ?></small>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
    </v-toolbar>

    <v-divider :dark.sync="dark" :light.sync="light"></v-divider>

    <v-toolbar flat class="transparent">
        <v-list dense>
            

            <template v-for="(menu, i) in navigation.sidebar">
                
                <v-subheader
                    v-if="menu.is_header"
                    :dark.sync="dark" :light.sync="light"
                    class="text--lighten-1"
                >
                    {{ menu.text }}
                </v-subheader>

                
                <v-list-group
                    v-else-if="menu.has_children"
                    :class="menu.active?i:'XXXXXXXXXXXXnot-active'"
                    v-model="menu.active"
                    no-action
                >
                    
                    <v-list-tile slot="item" :title="menu.labels.description">
                        <v-list-tile-action v-if="menu.icon">
                            <v-icon>{{ menu.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>
                                {{ menu.labels.title }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                        <v-list-tile-action>
                            <v-icon>{{ menu.name ? 'keyboard_arrow_down' : 'keyboard_arrow_up' }}</v-icon>
                        </v-list-tile-action>
                    </v-list-tile>

                    
                    <v-list-tile
                        :key="i"
                        :class="child.active ? 'primary' : ''"
                        :href="child.slug"
                        v-for="(child, i) in menu.children"
                        
                    >
                        <v-list-tile-action>
                            <v-icon>{{ child.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>
                                {{ child.labels.title }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list-group>

                
                <v-list-tile
                    :class="menu.active ? 'primary' : ''"
                    :href="menu.slug"
                    :title="menu.labels.description"
                    v-else
                    v-model="menu.active"
                >
                    <v-list-tile-action v-if="menu.icon">
                        <v-icon :dark.sync="dark" :light.sync="light">{{ menu.icon }}</v-icon>
                    </v-list-tile-action>

                    <v-list-tile-content>
                        <v-list-tile-title>
                            {{ menu.labels.title }}
                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>

            </template>

        </v-list>
    </v-toolbar>

</v-navigation-drawer>

<?php $__env->startPush('pre-scripts'); ?>
    <script>
        mixins.push({
            data: {
                navigation: {
                    sidebar: <?php echo json_encode($navigation->sidebar->collect); ?>,
                },
            }
        });
    </script>
<?php $__env->stopPush(); ?>
