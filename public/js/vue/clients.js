new Vue({
    el: '#app',

    data: {
        projects: [],
        invoices: [],
        project_add: false,
        project_name: '',
        project_desc: '',
        invoice_add: false,
        invoice_data: {
            issue_date: '',
            amount: '',
            due_date: ''
        },
        quote_add: false,
        quote_data: {
            issue_date: '',
            amount: '',
            due_date: ''
        },
    },
    methods: {
        fetchInvoicesList: function() {
            this.$http.get('/api/');
        },
        addProject: function() {
            this.project_add = !this.project_add;
        },
        cancelNewProject: function() {
            this.project_add = false;
        },
        addInvoice: function() {
            this.invoice_add = !this.invoice_add;
        },
        postInvoice: function(client_id) {
            var invoice = this.$resource('/api/clients/:id/invoices');
            invoice.save({id: client_id}, {form_data: this.invoice_data}).then(function (response) {
          }, function (response) {
              alert('its fucked');
          });
      },
      addQuote: function() {
          this.quote_add = !this.quote_add;
      },
      postQuote: function(client_id) {
          var quote = this.$resource('/api/clients/:id/quotes');
          quote.save({id: client_id}, {form_data: this.quote_data}).then(function (response) {
        }, function (response) {
            alert('its fucked');
        });
      }
    }
});
