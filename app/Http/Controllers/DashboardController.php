<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Client;
use App\Invoice;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function renderDashboard()
    {
        $now = Carbon::now()->toDateTimeString();
        $clients = Client::where('status', 'active')->get();

        foreach ($clients as $client) {
            $client->client_id = $client->id + 1000;
        }

        $active_invoices = Invoice::where('is_paid', '0')->get();
        $overdue_invoices = Invoice::overdue()->get();
        $active_total = $active_invoices->sum('amount');
        $overdue_total = $overdue_invoices->sum('amount');

        return view('app.dashboard', [
            'clients'       => $clients,
            'active_total'  => $active_total,
            'overdue_total' => $overdue_total,
        ]);
    }
}
