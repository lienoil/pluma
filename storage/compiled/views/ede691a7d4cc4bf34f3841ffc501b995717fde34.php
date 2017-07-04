<v-list-item v-for="(child, i) in item.children" :key="i">
    <v-list-tile>
        <v-list-tile-action v-if="child.icon">
            <v-icon><?php echo e(child.icon); ?></v-icon>
        </v-list-tile-action>
        <v-list-tile-content>
            <v-list-tile-title>
                {{ child.text }}
            </v-list-tile-title>
        </v-list-tile-content>
    </v-list-tile>
</v-list-item>
