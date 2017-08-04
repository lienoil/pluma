<template>
    <v-card>
        <v-card-title>
            Nutrition
            <v-spacer></v-spacer>
            <v-text-field
                append-icon="search"
                label="Search"
                single-line
                hide-details
                v-model="search"
            ></v-text-field>
        </v-card-title>
        <v-data-table
                v-bind:headers="headers"
                v-bind:items="items"
                v-bind:search="search"
            >
            <template slot="items" scope="props">
                <td>
                    <v-edit-dialog
                        @open="props.item._name = props.item.name"
                        @cancel="props.item.name = props.item._name || props.item.name"
                        lazy
                    > {{ props.item.name }}
                        <v-text-field
                            slot="input"
                            label="Edit"
                            v-bind:value="props.item.name"
                            v-on:change="val => props.item.name = val"
                            single-line counter="counter"
                        ></v-text-field>
                    </v-edit-dialog>
                </td>
                <td class="text-xs-right">{{ props.item.calories }}</td>
                <td class="text-xs-right">{{ props.item.fat }}</td>
                <td class="text-xs-right">{{ props.item.carbs }}</td>
                <td class="text-xs-right">{{ props.item.protein }}</td>
                <td class="text-xs-right">{{ props.item.sodium }}</td>
                <td class="text-xs-right">{{ props.item.calcium }}</td>
                <td>
                    <v-edit-dialog
                        class="text-xs-right"
                        @open="props.item._iron = props.item.iron"
                        @cancel="props.item.iron = props.item._iron || props.item.iron"
                        large
                        lazy
                    >
                        <div class="text-xs-right">{{ props.item.iron }}</div>
                        <div slot="input" class="mt-3 title">Update Iron</div>
                        <v-text-field
                            slot="input"
                            label="Edit"
                            v-model="props.item.iron"
                            single-line
                            counter
                            autofocus
                        ></v-text-field>
                    </v-edit-dialog>
                </td>
            </template>
            <template slot="pageText" scope="{ pageStart, pageStop }">
                From {{ pageStart }} to {{ pageStop }}
            </template>
        </v-data-table>
    </v-card>
</template>
