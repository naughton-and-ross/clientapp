<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Client;
use App\Invoice;
use App\Quote;
use Carbon\Carbon;

use Auth;
use DB;
use Mail;

class DashboardController extends Controller
{
    public function renderDashboard()
    {
        $now = Carbon::now()->toDateTimeString();
        $clients = Client::all();

        foreach ($clients as $client) {
            $client->client_id = $client->id + 999;
        }

        $active_invoices = Invoice::active()->get();
        $overdue_invoices = Invoice::overdue()->get();
        $thirty_day_invocies = Invoice::paidInLastThirtyDays()->get();
        $previous_thirty_day_invocies = Invoice::paidInPreviousThirtyDays()->get();
        $this_year_invoices = Invoice::paidThisCalenderYear()->get();
        $last_year_invoices = Invoice::paidLastCalenderYear()->get();
        $this_financial_year_invoices = Invoice::paidThisFinancialYear()->get();
        $last_financial_year_invoices = Invoice::paidLastFinancialYear()->get();
        $active_total = $active_invoices->sum('amount');
        $overdue_total = $overdue_invoices->sum('amount');
        $thirty_day_total = $thirty_day_invocies->sum('amount');
        $previous_thirty_day_total = $previous_thirty_day_invocies->sum('amount');
        $this_year_total = $this_year_invoices->sum('amount');
        $last_year_total = $last_year_invoices->sum('amount');
        $this_financial_year_total = $this_financial_year_invoices->sum('amount');
        $last_financial_year_total = $last_financial_year_invoices->sum('amount');

        $accepted_quotes = Quote::issuedThisFinancialYear()->accepted()->get();
        $accepted_quotes_total = $accepted_quotes->sum('amount');

        $user_resuest_log = DB::table('request_log')->where('user_id', Auth::user()->id)->get();

        $position_difference = $thirty_day_total - $previous_thirty_day_total;

        if ($this_year_total !== 0 && $last_year_total !== 0) {
            $year_difference_percent = $this_year_total / $last_year_total * 100;
        } else {
            $year_difference_percent = 0;
        }

        if ($this_financial_year_total !== 0 && $last_financial_year_total !== 0) {
            $financial_year_difference_percent = $this_financial_year_total / $last_financial_year_total * 100;
        } else {
            $financial_year_difference_percent = 0;
        }

        $projected_fy_earnings = $this_financial_year_total + $accepted_quotes_total;
        $projected_fy_earnings_percent = $projected_fy_earnings / $last_financial_year_total * 100;

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
            'clients'                             => $clients,
            'active_total'                        => $active_total,
            'overdue_total'                       => $overdue_total,
            'thirty_day_total'                    => $thirty_day_total,
            'previous_thirty_day_total'           => $previous_thirty_day_total,
            'this_year_total'                     => $this_year_total,
            'last_year_total'                     => $last_year_total,
            'this_financial_year_total'           => $this_financial_year_total,
            'last_financial_year_total'           => $last_financial_year_total,
            'position_diffeence'                  => $position_difference,
            'year_difference_percent'             => $year_difference_percent,
            'financial_year_difference_percent'   => $financial_year_difference_percent,
            'projected_fy_earnings'               => $projected_fy_earnings,
            'projected_fy_earnings_percent'       => $projected_fy_earnings_percent,
            'active_invoices'                     => $active_invoices,
            'user_resuest_log'                    => $user_resuest_log
        ]);
    }
}
