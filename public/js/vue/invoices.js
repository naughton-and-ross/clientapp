new Vue({
    el: '#app',

    data: {
        invoice_id: invoice_id,
        invoice_paid: is_paid,
        invoice_data: null,
        add_invoice_details: false,
        form_data: {
            is_paid: !is_paid
        }
    },
    ready: function() {
    },
    methods: {
        addInvoiceDetails: function() {
            this.add_invoice_details = !this.add_invoice_details;
        },
        cancelAddInvoiceDetails: function() {
            this.add_invoice_details = false;
        },
        markInvoicePaid: function(invoice_id) {
            var invoice = this.$resource('/invoices/:id');
            invoice.update({id: invoice_id}, {form_data: this.form_data}).then(function (response) {
                this.invoice_paid = 1;
                this.form_data.is_paid = !this.form_data.is_paid;
          }.bind(this), function (response) {
              alert('its fucked');
          });
      },
      markInvoiceUnpaid: function(invoice_id) {
          var invoice = this.$resource('/invoices/:id');
          invoice.update({id: invoice_id}, {form_data: this.form_data}).then(function (response) {
              this.invoice_paid = 0;
        }.bind(this), function (response) {
            alert('its fucked');
        });
    },
    deleteInvoice: function(invoice_id) {
        var invoice = this.$resource('/invoices/:id');
        invoice.delete({id: invoice_id}).then(function (response) {
            this.invoice_paid = 0;
      }.bind(this), function (response) {
          alert('its fucked');
      });
    }
    }
});
