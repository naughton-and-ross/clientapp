<div class="pure-u-19-24 context_menu">
    <div class="l-box">
        <p class="@if ($client) upper_level @endif">
            Clients
        </p>
        @if (isset($client))
        <span class="upper_level">/</span>
        <p class="@if (isset($project)) upper_level @endif">
            @if (isset($project))
            <a href="{{url('/clients/')}}/{{$client->id}}">
            @endif
                {{$client->name}}
            @if (isset($project))
            </a>
            @endif
        </p>
        @if (!isset($project))
        <div class="client_status green tooltipped tooltipped-n" aria-label="This is the tooltip."></div>
        @endif
        @if (isset($project))
        <span class="upper_level">/</span>
        <p>
            {{$project->name}}
        </p>
        <div class="client_status @if ($project->is_complete == 1) green @else yellow @endif"></div>
        <div class="pure-u-1">
            <div class="pure-u-12-24">
                <p class="details">
                    {{$project->desc}}
                </p>
            </div>
        </div>
        @endif
        @if (!isset($project))
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
