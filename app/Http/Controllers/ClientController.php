<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use App\Client;
use App\Invoice;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Client::all();
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
        //
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
        $client->client_id = $client->id + 1000;

        foreach ($invoices as $invoice) {
            $issue_date = Carbon::createFromFormat('Y-m-d', $invoice->issue_date);
            $due_date = Carbon::createFromFormat('Y-m-d', $invoice->due_date);
            $now = Carbon::now();
            $invoice->terms = $due_date->diffForHumans();
            if ($now > $due_date) {
                $invoice->is_overdue = true;
            } else {
                $invoice->is_overdue = false;
            }
            if ($invoice->client_specific_id < 10) {
                $invoice->client_specific_id = sprintf("%02d", $invoice->client_specific_id);
            }
            $invoice->terms_diff = $issue_date->diffInDays($due_date);
        }

        foreach ($quotes as $quote) {
            if ($quote->client_specific_id < 10) {
                $quote->client_specific_id = sprintf("%02d",$quote->client_specific_id);
            }
        }

        $totalPaid = $client->invoices()->where('is_paid', '1')->sum('amount');
        $totalOutstanding = $client->invoices()->where('is_paid', '0')->sum('amount');

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
        //
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
