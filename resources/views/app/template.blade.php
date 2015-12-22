<!DOCTYPE html>
<html>
    <head>
        @include('app.partials.head')
        <title>@if (isset($project)) {{$project->name}} &#8212; @endif @if (isset($client)) {{$client->name}} &#8212; @endif ClientApp</title>
    </head>
    <body>
        <div id="app">
            @include('app.partials.banner')
            <div class="pure-g header">
                @include('app.partials.header')
                <div class="pure-u-5-24 user">
                    <div class="l-box">
                        <p>
                            {{Auth::user()->name}}
                        </p>
                    </div>
                </div>
            </div>
            @yield('content')
            <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.12/vue.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.1.17/vue-resource.js"></script>
        </div>
    </body>
</html>
