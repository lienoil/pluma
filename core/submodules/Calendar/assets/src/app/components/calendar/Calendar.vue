<template>
    <div class="calendar">
        <!-- Main Calendar Display -->
        <slot name="header">
            <div class="calendar-header">
                <v-btn icon><v-icon>keyboard_arrow_left</v-icon></v-btn>
                {{ date.current().getFullYear() }}
            </div>
        </slot>
        <slot name="calendar">
            <div class="calendar-grid">
                <div class="calendar-body">
                    <div class="calendar-week">
                        <span class="calendar-day">1</span>
                        <span class="calendar-day">2</span>
                        <span class="calendar-day">3</span>
                        <span class="calendar-day">4</span>
                        <span class="calendar-day">5</span>
                        <span class="calendar-day">6</span>
                        <span class="calendar-day">7</span>
                    </div>
                </div>
            </div>
        </slot>
        <!-- /Main Calendar Display -->
    </div>
</template>

<script>
    export default {
        name: 'Calendar',
        props: {
            color: {
                type: String,
                default: 'primary',
            },
        },

        computed: {
            date () {
                return {
                    current () { return new Date(); }
                }

            }
        },

        data () {
            return {
                eventCalendar: {
                    events: [],
                },
            };
        }
    };
</script>
