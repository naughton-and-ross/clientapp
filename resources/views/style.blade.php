<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="{{asset('css/pure/pure.css')}}">
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="{{asset('css/pure/grids-responsive-old-ie-min.css')}}">
        <![endif]-->
        <!--[if gt IE 8]><!-->
            <link rel="stylesheet" href="{{asset('css/pure/grids-responsive-min.css')}}">
        <!--<![endif]-->
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/_tooltips.css')}}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    </head>
    <body>
        <div id="app">
            <div class="pure-g clientapp">
                <div class="pure-u-1 banner">
                    <div class="l-box">
                        <p>
                            Naughton & Ross ClientApp
                        </p>
                    </div>
                </div>
            </div>
            <div class="pure-g header">
                <div class="pure-u-19-24 context_menu">
                    <div class="l-box">
                        <p class="upper_level">
                            Clients
                        </p>
                        <span class="upper_level">/</span>
                        <p>
                            Jumping Green Frog
                        </p>
                        <div class="client_status tooltipped tooltipped-n" aria-label="This is the tooltip."></div>
                        <p class="details">
                            1018<span>&middot;</span>81752021<span>&middot;</span>Managed by <strong>Tom Ross</strong>
                        </p>
                        <p class="details">
                            Phone Accessories<span>&middot;</span>Contact Mark Hazelwood
                        </p>
                    </div>
                </div>
                <div class="pure-u-5-24">
                    <div class="l-box">
                        <p>
                            William Naughton-Gravette
                        </p>
                    </div>
                </div>
            </div>
            <div class="pure-g criticals">
                <div class="pure-u-9-24 projects">
                    <div class="l-box">
                        <p class="subheading">
                            Projects <i class="fa fa-plus-square-o"></i>
                        </p>
                        <div class="project_box">
                            <div class="l-box">
                                <p>
                                    <strong>Company Establishment</strong>
                                </p>
                                <p class="details">
                                    Website and branding material.
                                </p>
                                <p class="details">
                                    <span class="yellow"><i class="fa fa-circle-o-notch"></i> In Progress</span>
                                </p>
                            </div>
                        </div>
                        <div class="project_box">
                            <div class="l-box">
                                <p>
                                    <strong>Splash Page and Promotional Material</strong>
                                </p>
                                <p class="details">
                                    Intro for website and basic marketing matierals for the pre-launch.
                                </p>
                                <p class="details">
                                    <span class="green"><i class="fa fa-check-circle-o"></i> Complete</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pure-u-1-24 spacer">
                </div>
                <div class="pure-u-12-24 invoices">
                    <div class="l-box">
                        <p class="subheading">
                            Invoices <i class="fa fa-plus-square-o"></i>
                        </p>
                        <table id="hor-minimalist-a">
                            <tr>
                            	<th>Inv. No.</th>
                            	<th>Dated</th>
                            	<th>Owed</th>
                                <th>Terms</th>
                                <th>Due</th>
                                <th>Status</th>
                            </tr>
                            <tr>
                            	<td>1018-01</td>
                            	<td>14.12.2015</td>
                            	<td>#374.00</td>
                                <td>30 Days</td>
                                <td>in 26 days</td>
                                <td>Paid<div class="client_status tooltipped tooltipped-n" aria-label="This is the tooltip."></div></td>

                            </tr>
                        </table>
                    </div>
                </div>
                <div class="pure-u-3-24">

                </div>
            </div>
        </div>
    </body>
</html>
