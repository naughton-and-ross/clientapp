@extends('app.template')
@section('content')
<div class="pure-g criticals">
    <div class="pure-u-8-24 projects">
        <div class="l-box">
            <p class="subheading">
                Clients <i class="fa fa-plus-square-o" @click="addProject"></i>
            </p>
            @if (count($clients) == 0)
                <p class="details">
                    No clients added.
                </p>
            @else
            @foreach ($clients as $ind_client)
            <p>
                <a href="{{url('clients')}}/{{$ind_client->id}}">
                    <strong>{{$ind_client->client_id}} &#8212; </strong>{{$ind_client->name}}
                </a>
            </p>
            @endforeach
            @endif
        </div>
    </div>
    <div class="pure-u-1-24 spacer">
    </div>
    <div class="pure-u-3-24">
        <!--
        <template id="projects-template">
            <div class="project_box" v-for="project in projects">
                <div class="l-box">
                    <p>
                        <a href="{{url('/projects/')}}/@{{project.id}}"><strong>@{{project.name}}</strong></a>
                    </p>
                    <p class="details">
                        @{{project.desc}}
                    </p>
                    <p class="details">
                        <span class="green" v-if="project.is_complete == 1"><i class="fa fa-check-circle-o"></i> Complete</span>
                        <span class="yellow" v-if="project.is_complete == 0"><i class="fa fa-circle-o-notch"></i> In Progress</span>
                    </p>
                </div>
            </div>
        </template>
    -->
    </div>
</div>
<script src="{{asset('js/vue/clients.js')}}"></script>
@endsection
