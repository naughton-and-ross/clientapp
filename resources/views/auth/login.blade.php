<!DOCTYPE html>
<html>
    <head>
        @include('app.partials.head')
        <title>Login &#8212; ClientApp</title>
        <meta http-equiv="Cache-control" content="no-cache">
        <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
        <META HTTP-EQUIV="Expires" CONTENT="-1">
    </head>
    <body>
        <div id="app">
            @include('app.partials.banner')
            <div class="pure-g header">
                <div class="pure-u-19-24 context_menu">
                    <div class="l-box">
                        <p class="">
                            Login to ClientApp
                        </p>
                    </div>
                </div>
                <div class="pure-u-5-24 user desktop">
                    <div class="l-box">
                        <p>
                            Client Login
                        </p>
                    </div>
                </div>
            </div>
            <div class="pure-u-1">
                <div class="l-box">
                    <img src="{{asset('img/clientapp-front.jpg')}}" width="100%" />
                </div>
                <div class="l-box">
                    @if (count($errors) > 0)
                       <ul class="errors">
                           @foreach ($errors->all() as $error)
                               <li>{{ $error }}</li>
                           @endforeach
                       </ul>
                   @endif
                    <form class="pure-form" method="post">
                        <input type="text" name="name" placeholder="Your Name" class="pure-u-1 pure-u-md-6-24" autocomplete="off" />
                        <input type="password" name="password" class="pure-u-1 pure-u-md-6-24" placeholder="Your Password"/>
                        <button type="submit" class="pure-button pure-button-primary">Login</button>
                    </form>
                </div>
            </div>
            <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.12/vue.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.1.17/vue-resource.js"></script>
        </div>
    </body>
</html>
