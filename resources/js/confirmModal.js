document.addEventListener('alpine:init', () => {
    Alpine.data('confirmModal', () => ({
        show: false,
        form: null,
        title: '',
        message: '',

        open(data) {
            this.show = true;
            this.form = data.form;
            this.title = data.title;
            this.message = data.message;
        },

        submit() {
            this.show = false;
            this.form.submit();
        }
    }));
});