@extends('app.template')
@section('content')
<script>
    var project_id = {{$project->id}}
    var is_complete = {{$project->is_complete}}
</script>
 <div class="pure-g criticals">
    <div class="pure-u-20-24 pure-u-md-7-24 project_updates">
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
            <p class="details">
                No Project Updates
            </p>
            @endif
        </div>
    </div>
    <div class="pure-u-1-24 spacer desktop"></div>
    <div class="pure-u-1 pure-u-md-8-24 project_activity">
        <div class="l-box">
            <p class="subheading">
                Project Activity Log <i class="fa fa-plus-square-o" @click="addProjectActivity"></i>
            </p>
            <div class="project_box new_project_box" v-if="project_activity_add">
                <div class="l-box">
                    <form method="post" action="/api/projects/{{$project->id}}/activity">
                        <p>
                            <strong><input type="text" class="details" placeholder="Activity Title" name="activity_title"></strong>
                        </p>
                        <p>
                            <input type="text" class="details" placeholder="Activity Description (optional)" name="activity_desc">
                        </p>
                        <p>
                            <input type="text" class="details" placeholder="FontAwesome icon-code (optional)" name="activity_icon_code">
                        </p>
                        <p>
                            Activity type
                            <select name="activity_type">
                                <option value="normal">
                                    Normal
                                </option>
                                <option value="milestone">
                                    Milestone (Green)
                                </option>
                                <option value="problem">
                                    Problem (Yellow)
                                </option>
                                <option value="major">
                                    Major Problem (Red)
                                </option>
                            </select>
                        </p>
                        <p class="details">
                            <button class="pure-button pure-button-primary">Log Activity</button>
                            <a class="pure-button" @click="cancelNewProjectActivity">Cancel</a>
                        </p>
                    </form>
                </div>
            </div>
            <div class="pure-u-1 project_activity_block" v-if="project_complete">
                <div class="pure-g">
                    <div class="pure-u-2-24 activity_icon">
                        <div class="l-box">
                            <p class="green">
                                <i class="fa fa-check-circle-o"></i>
                            </p>
                        </div>
                    </div>
                    <div class="pure-u-19-24 activity_info">
                        <div class="l-box">
                            <p class="activity_title">
                                Project Complete
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @if (count($project->project_activity) > 0)
            @foreach ($project->project_activity as $projectActivity)
            <div class="pure-u-1 project_activity_block">
                <div class="pure-g">
                    <div class="pure-u-2-24 activity_icon">
                        <div class="l-box">
                            <p class="
                                @if ($projectActivity->activity_type == "milestone")
                                green
                                @elseif ($projectActivity->activity_type == "problem")
                                yellow
                                @elseif ($projectActivity->activity_type == "major")
                                red
                                @endif
                            ">
                                <i class="fa fa-{{$projectActivity->activity_icon_code}}"></i>
                            </p>
                        </div>
                    </div>
                    <div class="pure-u-21-24 activity_info">
                        <div class="l-box">
                            <p class="activity_title">
                                {{$projectActivity->activity_title}}
                            </p>
                            <p class="details">
                                {{$projectActivity->activity_desc}}
                            </p>
                            <p class="details">
                                {{$projectActivity->created_at->diffForHumans()}} by {{$projectActivity->user->name}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            <div class="pure-u-1 project_activity_block">
                <div class="pure-g">
                    <div class="pure-u-2-24 activity_icon">
                        <div class="l-box">
                            <p class="green">
                                <i class="fa fa-play-circle-o"></i>
                            </p>
                        </div>
                    </div>
                    <div class="pure-u-19-24 activity_info">
                        <div class="l-box">
                            <p class="activity_title">
                                Project Established
                            </p>
                            <p class="details">
                                {{$project->created_at->diffForHumans()}} by {{$project->user->name}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pure-u-1-24 spacer desktop"></div>
    <div class="pure-u-7-24 project_files desktop">
        <div class="l-box">
            <p class="subheading">
                Project Files <i class="fa fa-plus-square-o" @click="addProjectFile"></i>
            </p>
            <div class="project_box new_project_box" v-if="project_file_add">
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
            <p class="details">
                Doesn't work yet.
            </p>
        </div>
    </div>
    <div class="pure-u-1 moodboard">
        <div class="l-box">
            <p class="subheading">
                Moodboard
            </p>
        </div>
        <div class="pure-g">
            @foreach($project->moodboard_posts as $mb_post)
            <div class="mb-post pure-u-6-24" style="
            @if($mb_post->post_type == "img_link")
            background-image:url({{$mb_post->url}})
            @endif
            ">
                @if($mb_post->post_type == "text")
                <div class="text l-box">
                    <p>
                        {{$mb_post->text}}
                    </p>
                    <p class="details">
                        {{$mb_post->created_at->diffForHumans()}}
                    </p>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    <div class="pure-u-14-24 actions">
        <div class="l-box">
            <p class="subheading">
                Actions
            </p>
            <form method="post" @submit.prevent="markProjectComplete({{$project->id}})" v-if="!project_complete">
                <input type="hidden" name="is_complete" value="1">
                <button class="pure-button button-green">Mark as Complete</button>
            </form>
            <form method="post" @submit.prevent="markProjectInProgress({{$project->id}})" v-if="project_complete">
                <input type="hidden" name="is_complete" value="0">
                <button class="pure-button button-yellow">Mark as In Progress</button>
            </form>
        </div>
    </div>
</div>
<script src="{{asset('js/vue/projects.js')}}"></script>
@endsection
