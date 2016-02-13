@extends('app.template')
@section('content')
<div class="pure-g criticals">
    <div class="pure-u-1 pure-u-md-8-24 projects">
        <div class="l-box">
            <div class="pure-g">
                <div class="pure-u-1-2">
                    <p class="subheading">
                        <span v-if="show_all_clients">All Clients</span><span v-if="!show_all_clients">Active Clients</span> <i class="fa fa-plus-square-o" @click="addClient"></i>
                    </p>
                </div>
                <div class="pure-u-4-24"></div>
                <div class="pure-u-6-24">
                    <p class="subheading">
                        <div class="onoffswitch">
                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" @click="toggleClientView">
                            <label class="onoffswitch-label" for="myonoffswitch"></label>
                        </div>
                    </p>
                </div>
            </div>

            <div class="project_box new_project_box" v-if="client_add">
                <div class="l-box">
                    <form method="post" action="/clients">
                        <p>
                            <strong><input type="text" placeholder="Client Name" name="name"></strong>
                        </p>
                        <p class="details">
                            <input type="text" class="details" placeholder="Client Industry" name="industry">
                        </p>
                        <p class="details">
                            <input type="text" class="details" placeholder="Client Contact Name" name="contact_name">
                        </p>
                        <p class="details">
                            <input type="text" class="details" placeholder="Client Contact Email" name="contact_email">
                        </p>
                        <p class="details">
                            <input type="text" class="details" placeholder="Client Contact Phone" name="contact_phone">
                        </p>
                        <p class="details">
                            <input type="text" class="details" placeholder="Client Contact Address" name="contact_address">
                        </p>
                        <p class="details">
                            <button class="pure-button pure-button-primary">Create</button>
                            <a class="pure-button" @click="cancelNewClient">Cancel</a>
                        </p>
                    </form>
                </div>
            </div>
            @if (count($clients) == 0)
                <p class="details">
                    No active clients.
                </p>
            @else
            @foreach ($clients as $ind_client)
            <p @if ($ind_client->status !== "active") v-if="show_all_clients" transition="expand" @endif >
                <a href="{{url('clients')}}/{{$ind_client->id}}">
                    <strong>{{$ind_client->client_id}} &#8212; </strong>{{$ind_client->name}}
                </a>
            </p>
            @endforeach
            @endif
        </div>
    </div>
    <div class="pure-u-1 pure-u-md-16-24 data">
        <div class="pure-g">
            <div class="pure-u-1-2 pure-u-md-7-24">
                <div class="l-box">
                    <p class="subheading">
                        Total Outstanding:
                    </p>
                    <p class="highlight">
                        ${{number_format($active_total)}}
                    </p>
                </div>
            </div>
            <div class="pure-u-1-2 pure-u-md-7-24">
                <div class="l-box">
                    <p class="subheading">
                        Total Overdue:
                    </p>
                    <p class="highlight @if ($overdue_total > 0) red @endif">
                        ${{number_format($overdue_total)}}
                    </p>
                </div>
            </div>
            <div class="pure-u-1 pure-u-md-9-24">
                <div class="l-box">
                    <p class="subheading">
                        30-day Position:
                    </p>
                    <p class="highlight">
                        ${{number_format($thirty_day_total)}} &#8211;
                        <span class="@if ($thirty_day_total > $previous_thirty_day_total) green @else red @endif)">
                        @if ($position_diffeence > 0)
                        <i class="fa fa-angle-up"></i>
                        @else
                        <i class="fa fa-angle-down"></i>
                        @endif
                        ${{number_format(abs($position_diffeence))}}
                        </span>
                    </p>
                </div>
            </div>
            <div class="pure-u-10-24 pure-u-md-7-24">
                <div class="l-box">
                    <p class="subheading">
                        This Year:
                    </p>
                    <p class="highlight">
                        ${{number_format($this_year_total)}}
                    </p>
                    <div class="progress_bar_wrap hint--bottom hint--rounded" data-hint="{{floor($year_difference_percent)}}% towards beating last year's total of ${{number_format($last_year_total)}}">
                        <div class="progress_bar progress_bar--green" style="width: {{$year_difference_percent}}%"></div>
                    </div>
                </div>
            </div>
            <div class="pure-u-14-24 pure-u-md-7-24">
                <div class="l-box">
                    <p class="subheading">
                        This Financial Year:
                    </p>
                    <p class="highlight">
                        ${{number_format($this_financial_year_total)}}
                    </p>
                    <div class="progress_bar_wrap hint--bottom hint--rounded" data-hint="{{floor($financial_year_difference_percent)}}% towards beating last year's total of ${{number_format($last_financial_year_total)}} &#10; ({{floor($projected_fy_earnings_percent)}}% with projection)">
                        <div class="progress_bar progress_bar--green" style="width: {{$financial_year_difference_percent}}%"></div>
                        <div class="progress_bar progress_bar--yellow progress_bar--estimate" style="width: {{$projected_fy_earnings_percent}}%"></div>
                    </div>
                </div>
            </div>
            <div class="pure-u-1 pure-u-md-8-24 desktop">
                <div class="l-box">
                    <p class="subheading">
                        Your Activity on CA:
                    </p>
                    <div id="hc-test" class="pure-u-1" style="height: 100px;">

                    </div>
                    <script>
                        $(function () {
                            $('#hc-test').highcharts({
                                title: {
                                    enabled: false
                                },
                                tooltip: {
                                    valueSuffix: ' requests'
                                },
                                legend: {
                                    layout: 'vertical',
                                    align: 'right',
                                    verticalAlign: 'middle',
                                    borderWidth: 0
                                },
                                series: [{
                                    name: 'Requests',
                                    data: [
                                        @foreach ($user_resuest_log as $day_log)
                                        {{$day_log->request_count}},
                                        @endforeach
                                    ]
                                }]
                            });
                        });
                    </script>
                </div>
            </div>
            <div class="pure-u-1 invoices">
                <div class="l-box">
                    <p class="subheading">
                        Active Invoices
                    </p>
                    @if (count($active_invoices) == 0)
                        <p class="details">
                            No active invoices.
                        </p>
                    @else
                    <table id="hor-minimalist-a">
                        <tr>
                            <th>Inv. No.</th>
                            <th>Dated</th>
                            <th>Owed</th>
                            <th>Terms</th>
                            <th>Due</th>
                            <th>Status</th>
                        </tr>
                        @foreach ($active_invoices as $ind_invoice)
                        <tr>
                            <td>{{$ind_invoice->client_id}}-{{$ind_invoice->client_specific_id}}</td>
                            <td>{{date('d.m.Y', strtotime($ind_invoice->issue_date))}}</td>
                            <td>${{number_format($ind_invoice->amount, 2)}}</td>
                            <td>{{$ind_invoice->terms_diff}} days</td>
                            <td>{{$ind_invoice->HumanDueDate($ind_invoice->due_date)}}</td>
                            @if ($ind_invoice->is_paid == 1)
                            <td>Paid<div class="client_status green"></div></td>
                            @elseif ($ind_invoice->is_overdue == true && $ind_invoice->is_paid == 0)
                            <td>Overdue<div class="client_status red"></div></td>
                            @else
                            <td>Unpaid<div class="client_status yellow"></div></td>
                            @endif
                            <td class="actions">
                                <a href="/invoices/{{$ind_invoice->id}}">
                                    <i class="fa fa-arrow-circle-o-right"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="pure-u-3-24">
        <!--
        <template id="projects-template">
            <div class="project_box" v-for="project in projects">
                <div class="l-box">
                    <p>
                        <a href="{{url('/projects/')}}/@{{project.id}}"><strong>@{{project.name}}</strong></a>
                    </p>
                    <p class="details">
                        @{{project.desc}}
                    </p>
                    <p class="details">
                        <span class="green" v-if="project.is_complete == 1"><i class="fa fa-check-circle-o"></i> Complete</span>
                        <span class="yellow" v-if="project.is_complete == 0"><i class="fa fa-circle-o-notch"></i> In Progress</span>
                    </p>
                </div>
            </div>
        </template>
    -->
    </div>
</div>
<script src="{{asset('js/vue/home.js')}}"></script>
@endsection
