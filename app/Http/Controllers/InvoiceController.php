<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Client;
use App\Invoice;
use Carbon\Carbon;
use Input;

class InvoiceController extends Controller
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
        $invoice = new Invoice;
        $client = Client::findOrFail($client_id);

        $invoice_count = $client->invoices()->count();

        $invoice->client_specific_id = $invoice_count + 1;
        $invoice->client_id = $client_id;
        $invoice->user_id = Auth::user()->id;
        $invoice->issue_date = $request->issue_date;
        $invoice->amount = $request->amount;
        $invoice->due_date = $request->due_date;
        $invoice->is_paid = 0;

        $invoice->save();

        return redirect('clients/'.$client_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->due_date_human = Carbon::parse($invoice->due_date)->diffForHumans();
        $invoice->readable_specific_id = $invoice->client_specific_id;
        if ($invoice->client_specific_id < 10) {
            $invoice->readable_specific_id = sprintf("%02d", $invoice->client_specific_id);
        }

        $client = $invoice->client;
        $client->client_id = $client->id + 999;

        return view('app.invoice', [
            'client'  => $client,
            'invoice' => $invoice
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
            $invoice = Invoice::findOrFail($id);
            $invoice->update($request->input('form_data'));
            if ($request->input('form_data')['is_paid'] == true) {
                $invoice->paid_at = Carbon::now();
            }
            $invoice->save();
        } else {
            $input = Input::all();
            $invoice = Invoice::findOrFail($id);
            $invoice->update($input);
            $invoice->save();

            return redirect('invoices/'.$invoice->id);
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
        $invoice = Invoice::findOrFail($id);
        $client_id = $invoice->client_id;
        $invoice->delete();

        return redirect('clients/'.$client_id);
    }
}
