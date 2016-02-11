new Vue({
    el: '#app',

    data: {
        client_add: false,
        show_all_clients: false
    },
    methods: {
        toggleClientView: function() {
            this.show_all_clients = !this.show_all_clients;
        },
        addClient: function() {
            this.client_add = !this.client_add;
        },
        cancelNewClient: function() {
            this.client_add = false;
        },
        addInvoice: function() {
            this.invoice_add = !this.invoice_add;
        },
        addQuote: function() {
          this.quote_add = !this.quote_add;
        },
    },
});
