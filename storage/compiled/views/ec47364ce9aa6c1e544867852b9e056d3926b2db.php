<v-navigation-drawer
    temporary
    right
    v-model="rightsidebar.model"
    overflow
>
    <v-toolbar flat class="transparent">
        <v-list class="pa-0">
            <v-list-tile tag="div">
                <v-list-tile-content>
                    <v-list-tile-title :dark.sync="light" :light.sync="dark"><?php echo e(__('Quick Settings')); ?></v-list-tile-title>
                </v-list-tile-content>
                <v-list-tile-action>
                    <v-btn
                        icon
                        @click.native.stop="rightsidebar.model = !rightsidebar.model"
                    >
                        <v-icon>chevron_right</v-icon>
                    </v-btn>
                </v-list-tile-action>
            </v-list-tile>
        </v-list>
    </v-toolbar>

    <v-divider :dark.sync="light" :light.sync="dark"></v-divider>

    <?php echo $__env->yieldPushContent('pre-rightsidebar'); ?>

    <v-toolbar flat class="transparent">
        <v-list dense>
            
            <v-subheader
                :dark.sync="light" :light.sync="dark"
                class="text--lighten-1"
                v-if="page.model"
            >
                Page Settings
            </v-subheader>
            <?php echo $__env->yieldPushContent("page-settings"); ?>
            

            <v-divider></v-divider>

            <v-subheader
                :dark.sync="light" :light.sync="dark"
                class="text--lighten-1"
            >
                <span><?php echo e(__('Theme')); ?></span>
                <v-spacer></v-spacer>
                <v-icon :dark.sync="light" :light.sync="dark">style</v-icon>
            </v-subheader>
            <v-layout row class="pa-1">
                <v-flex xs12>
                    <v-card class="elevation-0">
                        <v-card-text>
                            <div class="text-xs-left">
                                <span>{{ `Font size: ${settings.fontsize.model}px` }}</span>
                                <v-btn icon title="<?php echo e(__('Reset font size')); ?>" @click.native="setStorage('settings.fontsize', (settings.fontsize.model = settings.fontsize.default))"><v-icon>refresh</v-icon></v-btn>
                            </div>
                            <v-slider
                                role="button"
                                v-model="settings.fontsize.model"
                                thumb-label
                                v-on:input="setStorage('settings.fontsize', settings.fontsize.model)"
                                v-bind:min="10"
                                v-bind:max="76"
                            ></v-slider>
                        </v-card-text>
                        <v-card-text>
                            <div class="text-xs-left">
                                <span><?php echo e(__('Main Sidebar')); ?></span>
                            </div>
                            <v-switch v-bind:label="`Extend Utilitybar`" v-on:change="setStorage('sidebar.floating', sidebar.floating)" v-model="sidebar.floating"></v-switch>
                            <v-switch v-bind:label="`Mini sidebar`" v-on:change="setStorage('sidebar.mini', sidebar.mini)" v-model="sidebar.mini"></v-switch>
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>

            <v-subheader
                :dark.sync="light" :light.sync="dark"
                class="text--lighten-1"
            >
                <span><?php echo e(__('Local Storage')); ?></span>
                <v-spacer></v-spacer>
                <v-icon :dark.sync="light" :light.sync="dark">save</v-icon>
            </v-subheader>
            <v-list-tile
                @click.native.stop="showDialog({
                    icon: 'delete',
                    title: '<?php echo e(__("Delete Storage Data")); ?>',
                    description: '<?php echo e(__("You are about to reset settings for Sidebar Mode, Theme, and any other features settings stored on your Local Storage. Are you sure you want to proceed?")); ?>',
                    confirmHandler: () => { clearStorage() },
                })">
                <v-list-tile-action>
                    <v-icon>delete</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>
                        Clear Local Storage
                    </v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
    </v-toolbar>

</v-navigation-drawer>
