<template>
    <v-toolbar>
        <v-toolbar-title>as</v-toolbar-title>
    </v-toolbar>
</template>

<script>
    export default {
        name: 'utilitybar',
        model: {
            prop: 'items',
        },
        props: {
            items: []
        },
        data () {
            return {
                dataset: {
                    items: [],
                }
            }
        },
        mounted () {
            this.dataset.items = this.items
        },
        watch: {
            'items': function (items) {
                this.$emit('input', items);
            }
        }
    }
</script>

<style scoped>
    /**/
</style>
