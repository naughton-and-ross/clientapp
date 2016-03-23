<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Client;
use App\Project;
use Carbon\Carbon;
use DB;
use Input;
use Mail;

class APIController extends Controller
{
    public function projectsByClient($id)
    {
        return Client::find($id)->projects()->orderBy('id', 'desc')->get();
    }

    public function addNewProject($client_id, Request $request)
    {
        $project = new Project;

        $project->client_id = $client_id;
        $project->user_id = Auth::user()->id;
        $project->name = $request->name;
        $project->desc = $request->desc;

        $project->save();

        return $project;
    }

    public function addNewProjectUpdate($project_id, Request $request)
    {
        $input = Input::all();

        return $input;
    }

    public function returnReuqest(Request $request)
    {
        $input = Input::all();
        return $input;
    }

    public function testMailQueue()
    {
        $data = [
            'name' => 'FlogManiac',
            'title' => 'Mail Queue Test',
            'description' => 'Testing ClientApp\'s mail queue service'
        ];
        Mail::queue('emails.test', $data, function ($message) {
            $message->to('william.gravette@gmail.com');
        });

        return "queued";
    }

    public function receive_push(Request $request)
    {
        DB::table('pushes')->insert([
            'payload' => $request->payload,
            'created_at' => Carbon::now()
        ]);
    }
}
