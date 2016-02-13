@extends('app.template')
@section('content')
<script>
    var invoice_id = {{$invoice->id}}
    var is_paid = {{$invoice->is_paid}}
</script>
<div class="pure-g criticals">
    <div class="pure-u-1-3 pure-u-md-4-24">
        <div class="l-box">
            <p>
                Invoice for:
            </p>
            <p class="highlight">
                ${{number_format($invoice->amount, 2)}}
            </p>
        </div>
    </div>
    <div class="pure-u-1-3 pure-u-md-6-24">
        <div class="l-box">
            <p>
                Issued on:
            </p>
            <p class="highlight">
                {{date('F jS, Y', strtotime($invoice->issue_date))}}
            </p>
        </div>
    </div>
    <div class="pure-u-1-3 pure-u-md-5-24">
        <div class="l-box">
            <p>
                Due:
            </p>
            <p class="highlight">
                {{$invoice->due_date_human}}
            </p>
        </div>
    </div>
</div>
<div class="pure-g criticals">
    <div class="pure-u-20-24 pure-u-md-6-24 actions">
        <div class="l-box">
            <p class="subheading">
                Details <i class="fa fa-plus-square-o" @click="addInvoiceDetails"></i>
            </p>
            <div class="project_box new_project_box" v-if="add_invoice_details">
                <div class="l-box">
                    <form method="post" action="/invoices/{{$invoice->id}}">
                        {{ method_field('PUT') }}
                        <p>
                            <input type="text" class="details" placeholder="@if (!empty($invoice->summary)) Update @endif Invoice details" name="summary">
                        </p>
                        <p class="details">
                            <button class="pure-button pure-button-primary">Comment</button>
                            <a class="pure-button" @click="cancelAddInvoiceDetails">Cancel</a>
                        </p>
                    </form>
                </div>
            </div>
            <p>
                {{$invoice->summary}}
            </p>
            <p>
                This invoice for <strong>${{number_format($invoice->amount, 2)}}</strong>, issued to <strong>{{$invoice->client->name}}</strong> on <strong>{{date('F jS, Y', strtotime($invoice->issue_date))}}</strong>, will be due <strong>{{$invoice->due_date_human}}</strong>.
            </p>
        </div>
    </div>
    <div class="pure-u-2-24 spacer desktop">

    </div>
    <div class="pure-u-20-24 pure-u-md-14-24 actions">
        <div class="l-box">
            <p class="subheading">
                Actions
            </p>
            <form method="post" @submit.prevent="markInvoicePaid({{$invoice->id}})" v-if="!invoice_paid">
                <input type="hidden" name="is_paid" value="1">
                <button class="pure-button button-green">Mark as Paid</button>
            </form>
            <form method="post" @submit.prevent="markInvoiceUnpaid({{$invoice->id}})" v-if="invoice_paid">
                <input type="hidden" name="is_paid" value="0">
                <button class="pure-button button-yellow">Mark as Unpaid</button>
            </form>
            <form method="post" action="/invoices/{{$invoice->id}}">
                {{ method_field('DELETE') }}
                <input type="hidden" name="is_paid" value="0">
                <button class="pure-button button-red">Delete Invoice</button>
            </form>
            <!--
                <button class="pure-button">Provide Payment Extension</button>
            -->
        </div>
    </div>
</div>
<script src="{{asset('js/vue/invoices.js')}}"></script>
@endsection
