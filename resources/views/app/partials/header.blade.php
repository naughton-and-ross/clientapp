<div class="pure-u-19-24 context_menu">
    <div class="l-box">
        <p class="@if (isset($client)) upper_level @endif">
            <a href="{{url('/dashboard')}}">
                Dashboard
            </a>
        </p>
        @if (isset($client))
        <span class="upper_level">/</span>
        <p class="@if (isset($project) or isset ($invoice) or isset($quote)) upper_level @endif">
            @if (isset($project) or isset($invoice) or isset($quote))
            <a href="{{url('/clients/')}}/{{$client->id}}">
            @endif
                {{$client->name}}
            @if (isset($project) or isset($invoice) or isset($quote))
            </a>
            @endif
        </p>
        @if (!isset($project) && !isset($invoice) && !isset($quote))
        <div class="client_status green tooltipped tooltipped-n" aria-label="This is the tooltip."></div>
        @endif
        @if (isset($invoice))
        <span class="upper_level">/</span>
        <p>
            Invoice No. {{$client->client_id}}-{{$invoice->readable_specific_id}}
        </p>
        @if (isset($invoice))
        <div class="client_status green tooltipped tooltipped-n" aria-label="This is the tooltip." v-if="invoice_paid"></div>
        <div class="client_status yellow tooltipped tooltipped-n" aria-label="This is the tooltip." v-if="!invoice_paid"></div>
        @endif
        @endif
        @if (isset($project))
        <span class="upper_level">/</span>
        <p>
            {{$project->name}}
        </p>
        <div class="client_status green" v-if="project_complete"></div>
        <div class="client_status yellow" v-if="!project_complete"></div>
        <div class="pure-u-1">
            <div class="pure-u-12-24">
                <p class="details">
                    {{$project->desc}}
                </p>
            </div>
        </div>
        @endif
        @if (isset($quote))
        <span class="upper_level">/</span>
        <p>
            Quote No. {{$client->client_id}}-{{$quote->readable_specific_id}}
        </p>
        <div class="client_status green tooltipped tooltipped-n" aria-label="This is the tooltip." v-if="is_accepted"></div>
        <div class="client_status yellow tooltipped tooltipped-n" aria-label="This is the tooltip." v-if="!is_accepted & !is_rejected"></div>
        <div class="client_status red tooltipped tooltipped-n" aria-label="This is the tooltip." v-if="is_rejected"></div>
        @endif
        @if (!isset($project) && !isset($invoice))
        <p class="details">
            {{$client->client_id}}<span>&middot;</span>{{$client->public_id}}<span>&middot;</span>Managed by <strong>{{$client->user->name}}</strong>
        </p>
        <p class="details">
            {{$client->industry}}<span>&middot;</span>Contact <strong>{{$client->contact_name}}</strong>
        </p>
        @endif
        @endif
    </div>
</div>
