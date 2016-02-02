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
                <div class="pure-u-5-24 user">
                    <div class="l-box">
                        <p>
                            Client Login
                        </p>
                    </div>
                </div>
            </div>
            <div class="pure-u-1">
                <div class="l-box">
                    <img src="http://img2.goodfon.su/original/2560x1440/b/35/iskusstvo-nachtwacht-kartina.jpg" width="100%" />
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
                        <input type="text" name="name" placeholder="Your Name"/>
                        <input type="password" name="password" placeholder="Your Password"/>
                        <button type="submit" class="pure-button pure-button-primary">Login</button>
                    </form>
                </div>
            </div>
            <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.12/vue.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.1.17/vue-resource.js"></script>
        </div>
    </body>
</html>
