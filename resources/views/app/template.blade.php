<!DOCTYPE html>
<html>
    <head>
        @include('app.partials.head')
        <title>@if (isset($invoice)) Invoice No. {{$client->client_id}}-{{$invoice->readable_specific_id}} &#8212; @endif @if (isset($project)) {{$project->name}} &#8212; @endif @if (isset($client)) {{$client->name}} &#8212; @endif ClientApp</title>
        <meta http-equiv="Cache-control" content="no-cache">
        <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
        <META HTTP-EQUIV="Expires" CONTENT="-1">
    </head>
    <body>
        <div class="pure-g" id="app">
            <div class="pure-u-1">
                @include('app.partials.banner')
                <div class="pure-g header">
                    @include('app.partials.header')
                    <div class="pure-u-5-24 user desktop">
                        <div class="l-box">
                            <p>
                                {{Auth::user()->name}}
                                <span>
                                    <a href="/auth/logout">
                                        <i class="fa fa-sign-out"></i>
                                    </a>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                @yield('content')
                <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.12/vue.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.1.17/vue-resource.js"></script>
                <script>
                jQuery(document).ready(function() {
                  jQuery(".timeago").timeago();
                });
                </script>
            </div>
            <div class="pure-u-4-24">
                
            </div>
        </div>
    </body>
</html>
