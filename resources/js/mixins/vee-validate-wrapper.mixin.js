import { extend, ValidationObserver, ValidationProvider } from 'vee-validate';
// import { required, email } from 'vee-validate/dist/rules';
import * as rules from 'vee-validate/dist/rules';
import moment from 'moment';

export default {
    components: {
        ValidationObserver, ValidationProvider,
    },
    data: {
        defaultVeeValidateRules: [
            'required',
        ]
    },
    mounted() {
        this.addDefaultRules();
    },
    methods: {
        addDefaultRules() {
            this.defaultVeeValidateRules.forEach(rule => {
                extend(rule, rules[rule]);
            });

            this.addDateFormatRule();
        },
        addDateFormatRule() {
            extend('date_equal_or_after', {
                validate(value, { target } ) {
                    console.log('fuck');
                    return value >= target; 
                },
                params: ['target'],
                message: '{_field_} must be greater than or equal to {target}.'
            });
        }
    }
}
