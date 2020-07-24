import toast from './mixins/toast.mixin';
import FullCalendar from './components/CalendarComponent';
import veeValidate from './mixins/vee-validate-wrapper.mixin';

import { BFormDatepicker, BootstrapVueIcons } from 'bootstrap-vue'

export default new Vue({
    mixins: [ toast, veeValidate ],
    components: {
        BFormDatepicker, FullCalendar
    },
    data() {
        return {
            processing: false,
            events: [],
            model: {
                name: '',
                from: '',
                to: '',
            }
        };
    },
    mounted() {
        this.initData();
    },
    methods: {
        store() {

            this.processing = true;

            let formData = new FormData(this.$refs.eventForm);
            let action = this.$refs.eventForm.getAttribute('action');
            
            axios.post(action, formData).then((response) => {
                if (response.data.success) {
                    this.events = response.data.data;
                    this._parseEventItems();
                    this.showSuccessToast(response.data.message);
                }
            });

            this.processing = false;
        },
        initData() {
            this.events = JSON.parse(this.$refs.events.innerHTML);
            this._parseEventItems();
        },
        _parseEventItems() {
            this.events = _.map(this.events, (item) => {
                return {
                    title: item.event.name,
                    start: item.schedule
                }
            });
        }
    }
});
