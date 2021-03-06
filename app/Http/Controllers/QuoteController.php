<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Client;
use App\Quote;
use App\User;
use Input;
use SMS;

class QuoteController extends Controller
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
        $quote = new Quote;
        $client = Client::findOrFail($client_id);

        $quote_count = $client->quotes()->count();

        $quote->client_specific_id = $quote_count + 1;
        $quote->client_id = $client_id;
        $quote->user_id = Auth::user()->id;
        $quote->issue_date = $request->issue_date;
        $quote->amount = $request->amount;
        $quote->is_accepted = 0;

        $quote->save();

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
        $quote = Quote::findOrFail($id);
        $quote->readable_specific_id = $quote->client_specific_id;
        if ($quote->client_specific_id < 10) {
            $quote->readable_specific_id = sprintf("%02d", $quote->client_specific_id);
        }

        $client = $quote->client;
        $client->client_id = $client->id + 999;

        return view('app.quote', [
            'client'  => $client,
            'quote' => $quote
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
        $quote = Quote::find($id);
        $quote->update($request->input('form_data'));
        if ($request->input('form_data')['is_accepted'] == true) {
            $to_notify = User::all()->except($quote->user->id);
            foreach ($to_notify as $user) {
                SMS::send($user->phone_number, 'ClientApp: '.$quote->client->name.'\'s quote for $'.number_format($quote->amount).' has been accepted.');
            }
        }
        $quote->save();

        return $quote;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quote = Quote::findOrFail($id);
        $client_id = $quote->client_id;
        $quote->delete();

        return redirect('clients/'.$client_id);
    }
}
