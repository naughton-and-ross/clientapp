new Vue({
    el: '#app',

    data: {
        projects: [],
        invoices: [],
        project_update_add: false,
        project_name: '',
        project_desc: ''
    },

    methods: {
        addProjectUpdate: function() {
            this.project_update_add = !this.project_update_add;
        },
        cancelNewProjectUpdate: function() {
            this.project_update_add = false;
        }
    }
});
