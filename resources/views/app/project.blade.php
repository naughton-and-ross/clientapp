@extends('app.template')
@section('content')
<div class="pure-g criticals">
    <div class="pure-u-7-24 project_updates">
        <div class="l-box">
            <p class="subheading">
                Project Updates <i class="fa fa-plus-square-o" @click="addProjectUpdate"></i>
            </p>
            <div class="project_box new_project_box" v-if="project_update_add">
                <div class="l-box">
                    <form method="post" action="/api/projects/{{$project->id}}/updates">
                        <p>
                            <input type="text" class="details" placeholder="Your comment" v-model="project_update_comment" name="comment">
                        </p>
                        <p class="details">
                            <button class="pure-button pure-button-primary">Comment</button>
                            <a class="pure-button" @click="cancelNewProjectUpdate">Cancel</a>
                        </p>
                    </form>
                </div>
            </div>
            @if (count($project->project_updates) > 0)
            @foreach ($project->project_updates as $projectUpdate)
            <div class="project_update">
                <p class="update_details">
                    <strong>{{$projectUpdate->user->name}}</strong> &middot; <span>{{$projectUpdate->created_at->diffForHumans()}}</span>
                </p>
                <p>
                    {{$projectUpdate->comment}}
                </p>
            </div>
            @endforeach
            @else
            <p>
                nutin
            </p>
            @endif
        </div>
    </div>
    <div class="pure-u-1-24 spacer"></div>
    <div class="pure-u-7-24 project_updates">
        <div class="l-box">
            <p class="subheading">
                Project Timeline <i class="fa fa-plus-square-o" @click="addProjectUpdate"></i>
            </p>
        </div>
    </div>
</div>
<script src="{{asset('js/vue/projects.js')}}"></script>
@endsection
