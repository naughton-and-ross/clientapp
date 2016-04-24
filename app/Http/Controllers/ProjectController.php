<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Project;
use Input;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($client_id, Request $request)
    {
        $project = new Project;

        $project->client_id = $client_id;
        $project->user_id = Auth::user()->id;
        $project->name = $request->name;
        $project->desc = $request->desc;
        if (isset($request->is_time_based)) {
            $project->is_time_based = 1;
        }

        $project->save();

        return redirect()->action('ProjectController@show', [$project->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        $client = $project->client;

        $project->project_updates = $project->project_updates()->desc()->get();
        $project->project_activity = $project->project_activity()->desc()->get();
        $project->moodboard_posts = $project->moodboard_posts()->latest()->take(4)->get();

        foreach ($project->moodboard_posts as $mb_post) {
            if ($mb_post->post_type == "text") {
                if (strlen(utf8_decode($mb_post->text)) > 140) {
                    $mb_post->text = substr($mb_post->text,0,137).'...';
                }
            }
        }

        return view('app.project', [
            'project' => $project,
            'client'  => $client
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        $project->update($request->input('form_data'));
        $project->save();

        return $project;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
