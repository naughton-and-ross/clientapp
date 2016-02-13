@extends('app.template')
@section('content')
<script>
    var quote_id = {{$quote->id}}
    var is_accepted = {{$quote->is_accepted}}
    var is_rejected = {{$quote->is_rejected}}
</script>
<div class="pure-g criticals">
    <div class="pure-u-1-3 pure-u-md-4-24">
        <div class="l-box">
            <p>
                Quote for:
            </p>
            <p class="highlight">
                ${{number_format($quote->amount, 2)}}
            </p>
        </div>
    </div>
    <div class="pure-u-1-3 pure-u-md-6-24">
        <div class="l-box">
            <p>
                Issued on:
            </p>
            <p class="highlight">
                {{date('F jS, Y', strtotime($quote->issue_date))}}
            </p>
        </div>
    </div>
    <div class="pure-u-1-3 pure-u-md-5-24">
        <div class="l-box">
            <p>
                Status:
            </p>
            <p class="highlight" v-if="is_accepted">
                Accepted
            </p>
            <p class="highlight" v-if="!is_accepted & !is_rejected">
                Awaiting
            </p>
            <p class="highlight" v-if="is_rejected">
                Rejected
            </p>
        </div>
    </div>
</div>
<div class="pure-g criticals">
    <div class="pure-u-1 pure-u-md-14-24 actions">
        <div class="l-box">
            <p class="subheading">
                Actions
            </p>
            <form method="post" @submit.prevent="markQuoteAccepted({{$quote->id}})" v-if="!is_accepted">
                <input type="hidden" name="is_paid" value="1">
                <button class="pure-button button-green">Mark as Accepted</button>
            </form>
            <form method="post" @submit.prevent="markQuoteRejected({{$quote->id}})" v-if="is_accepted">
                <input type="hidden" name="is_paid" value="0">
                <button class="pure-button button-red">Mark as Rejected</button>
            </form>
            <form method="post" action="/quotes/{{$quote->id}}">
                {{ method_field('DELETE') }}
                <input type="hidden" name="is_paid" value="0">
                <button class="pure-button button-red">Delete Quote</button>
            </form>
        </div>
    </div>
</div>
<script src="{{asset('js/vue/quotes.js')}}"></script>
@endsection
