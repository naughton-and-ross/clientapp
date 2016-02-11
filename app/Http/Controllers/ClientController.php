<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Carbon\Carbon;
use App\Client;
use App\Invoice;
use Input;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::where('status', 'active')->get();
        foreach ($clients as $client) {
            $client->client_id = $client->id + 1000;
        }
        return $clients;
        return view('app.clients', [
            'clients' => $clients
        ]);
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
    public function store(Request $request)
    {
        $client = new Client($request->input());
        $client->public_id = str_random(8);
        $client->user_id = Auth::user()->id;
        $client->status = "active";
        $client->save();

        return redirect('clients/'.$client->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);
        $projects = Client::find($id)->projects()->orderBy('id', 'desc')->get();
        $invoices = Client::find($id)->invoices()->orderBy('id', 'desc')->get();
        $quotes = Client::find($id)->quotes()->orderBy('id', 'desc')->get();
        $client->client_id = $client->id + 999;

        foreach ($invoices as $invoice) {
            $issue_date = Carbon::parse($invoice->issue_date);
            $due_date = Carbon::parse($invoice->due_date);
            $now = Carbon::now();
            if ($now > $due_date) {
                $invoice->is_overdue = true;
            } else {
                $invoice->is_overdue = false;
            }
            $invoice->readable_specific_id = $invoice->client_specific_id;
            if ($invoice->client_specific_id < 10) {
                $invoice->readable_specific_id = sprintf("%02d", $invoice->client_specific_id);

            }
            $invoice->terms_diff = $issue_date->diffInDays($due_date);
        }

        foreach ($quotes as $quote) {
            if ($quote->client_specific_id < 10) {
                $quote->client_specific_id = sprintf("%02d",$quote->client_specific_id);
            }
        }

        foreach ($projects as $project) {
            $project->latest_activity = $project->project_activity()->latest()->first();
        }

        $totalPaid = $client->invoices()->paid()->sum('amount');
        $totalOutstanding = $client->invoices()->active()->sum('amount');

        return view('app.client', [
            'client'            => $client,
            'projects'          => $projects,
            'invoices'          => $invoices,
            'quotes'            => $quotes,
            "total_paid"        => $totalPaid,
            'total_outstanding' => $totalOutstanding,
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
        if ($request->ajax()) {
            $client = Client::findOrFail($id);
            $client->update($request->input('client_data'));
            $client->save();
        } else {
            $input = Input::all();
            $client = Client::findOrFail($id);
            $client->update($input);
            $client->save();

            return redirect('clients/'.$client->id);
        }
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
