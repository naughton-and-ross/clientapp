new Vue({
    el: '#app',

    data: {
        quote_id: quote_id,
        is_accepted: is_accepted,
        is_rejected: is_rejected,
        invoice_data: null,
        form_data: {
            is_accepted: !is_accepted,
            is_rejected: !is_rejected
        }
    },
    ready: function() {
    },
    methods: {
        markQuoteAccepted: function(quote_id) {
            var quote = this.$resource('/quotes/:id');
            this.form_data.is_accepted = 1;
            this.form_data.is_rejected = 0;
            quote.update({id: quote_id}, {form_data: this.form_data}).then(function (response) {
                this.is_rejected = 0;
                this.is_accepted = 1;
          }.bind(this), function (response) {
              alert('its fucked');
          });
      },
      markQuoteRejected: function(quote_id) {
          var quote = this.$resource('/quotes/:id');
          this.form_data.is_accepted = 0;
          this.form_data.is_rejected = 1;
          quote.update({id: quote_id}, {form_data: this.form_data}).then(function (response) {
              this.is_rejected = 1;
              this.is_accepted = 0;
        }.bind(this), function (response) {
            alert('its fucked');
        });
    },
    deleteQuote: function(quote_id) {
        var quote = this.$resource('/quotes/:id');
        quote.delete({id: quote_id}).then(function (response) {
            window.history.back(true);
      }.bind(this), function (response) {
          alert('its fucked');
      });
    }
    }
});
