new Vue({
    el: '#app',

    data: {
        projects: [],
        invoices: [],
        project_update_add: false,
        project_activity_add: false,
        project_name: '',
        project_desc: '',
        project_id: project_id,
        project_complete: is_complete,
        form_data: {
            is_complete: !is_complete
        }
    },

    methods: {
        addProjectUpdate: function() {
            this.project_update_add = !this.project_update_add;
        },
        cancelNewProjectUpdate: function() {
            this.project_update_add = false;
        },
        addProjectActivity: function() {
            this.project_activity_add = !this.project_activity_add;
        },
        cancelNewProjectActivity: function() {
            this.project_activity_add = false;
        },
        markProjectComplete: function(project_id) {
            var project = this.$resource('/projects/:id');
            project.update({id: project_id}, {form_data: this.form_data}).then(function (response) {
                this.project_complete = 1;
                this.form_data.is_complete = !this.form_data.is_complete;
          }.bind(this), function (response) {
              alert('its fucked');
          });
      },
      markProjectInProgress: function(project_id) {
          var project = this.$resource('/projects/:id');
          project.update({id: project_id}, {form_data: this.form_data}).then(function (response) {
              this.project_complete = 0;
              this.form_data.is_complete = !this.form_data.is_complete;
        }.bind(this), function (response) {
            alert('its fucked');
        });
      }
    }
});
