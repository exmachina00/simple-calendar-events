<template>
    <FullCalendar :options="options"></FullCalendar>
</template>

<script>
    import FullCalendar from '@fullcalendar/vue';
    import dayGridPlugin from '@fullcalendar/daygrid';

    export default {
        props: {
            events: {
                type: Array,
                default: () => [],
            },
            config: {
                default: Object,
                default: () => {
                    return {
                        plugins: [ dayGridPlugin ],
                        initialView: 'dayGridMonth',
                        events: () => []
                    };
                },
            }
        },
        components: {
            FullCalendar
        },
        computed: {
            options: function () {
                return Object.assign(this.config, { events: this.events });
            }
        }
    };
</script>
