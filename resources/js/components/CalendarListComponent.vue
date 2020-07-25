<!-- Table view of calendar -->
<template>
    <div class="calendar-list-container">
        <div class="calendar-header d-flex">
            <div class="col-6">
                <h3>{{ month }} {{ year }}</h3>
            </div>
            <div class="col-6 d-flex justify-content-end py-2 px-0">
                <button class="btn btn-info mr-1" @click="subMonth">
                    <i class="fa fa-caret-left" aria-hidden="true"></i>
                </button>
                <button class="btn btn-info" @click="addMonth">
                    <i class="fa fa-caret-right" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <table class="table table-striped table-hover" :class="customClasses">
            <tbody>
                <tr v-for="(date, index) of dates" :key="index"
                    :class="{ 'active': date.title != '' }">
                    <td class="table-label">{{ date.label }}</td>
                    <td>{{ date.title }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import dayjs from 'dayjs';

    dayjs.extend(require('dayjs/plugin/isSameOrBefore'))

    export default {
        props: {
            customClasses: {
                default: '',
                type: String
            },
            events: {
                type: Array,
                default: []
            }
        },
        data() {
            return {
                currentDate: dayjs(),
                dates: [ ],
            };
        },
        mounted() {
            this.initList();
        },
        watch: {
            events: function (newVal) {
                this._mapEventToDates();
            },
            currentDate: function (newVal) {
                this.dates = [];
                this.initList();
                this._mapEventToDates();
            }
        },
        computed: {
            month: function () {
                return this.currentDate.format('MMMM');
            },
            year: function () {
                return this.currentDate.year();
            },
        },
        methods: {
            _mapEventToDates() {
                this.dates.forEach((date, index) => {
                    let event = this.events.find(event => event.start == date.index);

                    if (event == undefined) {
                        this.dates[index]['title'] = '';
                    } else {
                        this.dates[index]['title'] = event.title;
                    }
                });
            },
            initList() {
                let current = this.currentDate.startOf('month');
                let endOfMonth = this.currentDate.endOf('month');
                
                while (current.isSameOrBefore(endOfMonth)) {
                    let index = current.format('YYYY-MM-DD');

                    this.dates.push({
                        index: index,
                        title: '',
                        label: current.format('DD ddd')                                   
                    });

                    current = current.add(1, 'day');
                }
            },
            addMonth() {
                this.currentDate = this.currentDate.add(1, 'month');
            },
            subMonth() {
                this.currentDate = this.currentDate.subtract(1, 'month');
            }
        }
    };
</script>

<style scoped>
    tr td.table-label {
        width: 30%;
    }

    tr.active {
        background: rgb(204, 255, 204) !important;
        color: #202020;
    }

    tr.active:hover {
        background: rgb(153, 255, 153) !important;
        color: #202020;
    }
</style>
