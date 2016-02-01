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
            $client->client_id = $client->id + 999;
        }

        $active_invoices = Invoice::active()->get();
        $overdue_invoices = Invoice::overdue()->get();
        $thirty_day_invocies = Invoice::paidInLastThirtyDays()->get();
        $previous_thirty_day_invocies = Invoice::paidInPreviousThirtyDays()->get();
        $active_total = $active_invoices->sum('amount');
        $overdue_total = $overdue_invoices->sum('amount');
        $thirty_day_total = $thirty_day_invocies->sum('amount');
        $previous_thirty_day_total = $previous_thirty_day_invocies->sum('amount');

        $position_difference = $thirty_day_total - $previous_thirty_day_total;

        foreach ($active_invoices as $invoice) {
            $invoice->client_id = $invoice->client_id + 999;

            if ($invoice->client_specific_id < 10) {
                $invoice->client_specific_id = sprintf("%02d", $invoice->client_specific_id);
            }

            $issue_date = Carbon::parse($invoice->issue_date);
            $due_date = Carbon::parse($invoice->due_date);
            $invoice->terms_diff = $issue_date->diffInDays($due_date);

            if ($now > $due_date) {
                $invoice->is_overdue = true;
            } else {
                $invoice->is_overdue = false;
            }
        }

        return view('app.dashboard', [
            'clients'                   => $clients,
            'active_total'              => $active_total,
            'overdue_total'             => $overdue_total,
            'thirty_day_total'          => $thirty_day_total,
            'previous_thirty_day_total' => $previous_thirty_day_total,
            'position_diffeence'        => $position_difference,
            'active_invoices'           => $active_invoices
        ]);
    }
}
