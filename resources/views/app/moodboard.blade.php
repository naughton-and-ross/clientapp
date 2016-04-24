@extends('app.template')
@section('content')
<script>
    var project_id = {{$project->id}}
    var is_complete = {{$project->is_complete}}
</script>
 <div class="pure-g criticals">
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
