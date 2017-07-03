<template v-for="(item, i) in sidebar">
    <v-list-group v-else-if="item.children" v-model="true" no-action>
        <v-list-item slot="item">
            <v-list-tile>
                <v-list-tile-action>
                    <v-icon>{{ item.icon }}</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>
                        {{ item.text }}
                    </v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list-item>
        <!--<v-list-item v-for="(child, i) in item.children" :key="i">
            <v-list-tile>
                <v-list-tile-action v-if="child.icon">
                    <v-icon><?php echo e(@child.icon); ?></v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>
                        {{ child.text }}
                  </v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>
            </v-list-item>
          </v-list-group>
          <v-list-item v-else>
            <v-list-tile>
              <v-list-tile-action>
                <v-icon><?php echo e(item.icon); ?></v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>
                  <?php echo e(item.text); ?>

                </v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </v-list-item>-->
    </v-list-group>
</template>
