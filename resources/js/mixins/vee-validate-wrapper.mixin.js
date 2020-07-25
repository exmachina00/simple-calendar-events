import { extend, ValidationObserver, ValidationProvider, localize } from 'vee-validate';
import * as rules from 'vee-validate/dist/rules';
import en from 'vee-validate/dist/locale/en.json';


export default {
    components: {
        ValidationObserver, ValidationProvider,
    },
    data: {
        defaultVeeValidateRules: [
            'required', 'max',
        ]
    },
    mounted() {
        this.addDefaultRules();
        localize({ en });
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
                    return value >= target; 
                },
                
                params: ['target'],
                message: '{_field_} must be greater than or equal to {target}.'
            });
        }
    }
}
