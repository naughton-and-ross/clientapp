@extends('app.template')
@section('content')
<div class="pure-g criticals">
    <div class="pure-u-8-24 projects">
        <div class="l-box">
            <p class="subheading">
                Active Clients <i class="fa fa-plus-square-o" @click="addClient"></i>
            </p>
            <div class="project_box new_project_box" v-if="client_add" transition="expand">
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
            <p>
                <a href="{{url('clients')}}/{{$ind_client->id}}">
                    <strong>{{$ind_client->client_id}} &#8212; </strong>{{$ind_client->name}}
                </a>
            </p>
            @endforeach
            @endif
        </div>
    </div>
    <div class="pure-u-13-24 data">
        <div class="pure-g">
            <div class="pure-u-8-24">
                <div class="l-box">
                    <p class="subheading">
                        Total Outstanding:
                    </p>
                    <p class="highlight">
                        ${{number_format($active_total)}}
                    </p>
                </div>
            </div>
            <div class="pure-u-7-24">
                <div class="l-box">
                    <p class="subheading">
                        Total Overdue:
                    </p>
                    <p class="highlight @if ($overdue_total > 0) red @endif">
                        ${{number_format($overdue_total)}}
                    </p>
                </div>
            </div>
            <div class="pure-u-9-24">
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
            <div class="pure-u-1 invoices">
                <div class="l-box">
                    <p class="subheading">
                        Active Invoices
                    </p>
                    @if (count($active_invoices) == 0)
                        <p class="details">
                            No invoices issued.
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
