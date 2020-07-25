import Toast from 'vue-toasted';

Vue.use(Toast);

export default {
    data: {
        defaultToastOption: {
            position: 'top-right',
            duration : 3000,
            keepOnHover: true,
            action: {
                'text': 'x',
                onClick: (e, toastObject) => {
                    toastObject.goAway(0);
                }
            },
        },
    },
    methods: {
        showSuccessToast(message, option = {}) {
            if (option.icon == undefined) {
                option.iconPack = 'fontawesome';
                option.icon = 'check-circle';
            }

            this.show(message, 'success', option);
        },
        showErrorToast(message, option = {}) {
            if (option.icon == undefined) {
                option.iconPack = 'fontawesome';
                option.icon = 'exclamation-circle';
            }

            this.show(message, 'error', option);
        },
        show(message, type, option = {}) {
            option = Object.assign(this.defaultToastOption, option);

            option.type = type;

            this.$toasted.show(message, option);
        }
    },
}
