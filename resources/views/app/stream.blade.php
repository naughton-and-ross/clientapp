@extends('app.template')
@section('content')
<div class="pure-g criticals">
    <div class="pure-u-1 pure-u-md-20-24 projects">
        <div class="l-box">
            <div class="pure-g">
                <div class="pure-u-1-2">
                    <p class="subheading">
                        <span>Activity Stream</span><span class="grey"> &#8212; Forever<i class="fa fa-angle-down"></i></span>
                    </p>
                </div>
                <div class="pure-u-4-24"></div>
            </div>
            <div class="pure-g">
                @foreach ($user_activity as $activity)
                <div class="pure-u-3-24">
                    <p>
                        {{$activity->created_at->diffForHumans()}}
                    </p>
                    @if ($activity->read_status() !== 1)
                    <div class="client_status blue"></div>
                    @endif
                </div>
                <div class="pure-u-16-24">
                    <p>
                        <strong>
                            {{$activity->user->name}}
                        </strong>
                        @if ($activity->activity_type == "invoice")
                        issued
                        <strong>
                            <a href="/invoices/{{$activity->invoice->id}}">an invoice</a>
                        </strong> to
                        <strong>
                            <a href="/clients/{{$activity->invoice->client->id}}">{{$activity->invoice->client->name}}</a>
                        </strong> for
                        <strong>
                            ${{number_format($activity->invoice->amount)}}
                        </strong>
                        @elseif ($activity->activity_type == "quote")
                        issued
                        <strong>
                            <a href="/quotes/{{$activity->quote->id}}">a quote</a>
                        </strong> to
                        <strong>
                            <a href="/clients/{{$activity->quote->id}}">{{$activity->quote->client->name}}</a>
                        </strong> for
                        <strong>
                            ${{number_format($activity->quote->amount)}}
                        </strong>
                        @elseif ($activity->activity_type == "client")
                        created
                        <strong>
                            a new client record:
                        </strong>
                        <strong>
                            <a href="/clients/{{$activity->client->id}}">{{$activity->client->name}}</a>
                        </strong>
                        @elseif ($activity->activity_type == "project")
                        created
                        <strong>
                            a project
                        </strong> for
                        <strong>
                            <a href="/clients/{{$activity->project->client->id}}">{{$activity->project->client->name}}</a>
                        </strong> called
                        <strong>
                            <a href="/projects/{{$activity->project->id}}">{{$activity->project->name}}</a>
                        </strong>
                        @elseif ($activity->activity_type == "project_update")
                        posted
                        <strong>
                            a project update
                        </strong> on
                        <strong>
                            <a href="/projects/{{$activity->project_update->project->id}}">{{$activity->project_update->project->name}}</a>
                        </strong>
                        @elseif ($activity->activity_type == "project_activity")
                        updated the
                        <strong>
                            project activity stream
                        </strong> on
                        <strong>
                            <a href="/projects/{{$activity->project_activity->project->id}}">{{$activity->project_activity->project->name}}</a>
                        </strong>
                        @endif
                    </p>
                </div>
                <div class="pure-u-1-24">
                    <div class="l-box">

                    </div>
                </div>
                <div class="pure-u-3-24 spacer">

                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/vue/stream.js')}}"></script>
@endsection
