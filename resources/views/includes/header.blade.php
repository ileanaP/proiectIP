<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Evenimente dans</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li id="home"><a href="/">Home</a></li>
                <li><a id="register" href="/register">Inregistrare</a></li>
                <li><a id="login" href="/login">Autentificare</a></li>
                <li><a id="upcomingEvents" href="/events">Evenimente</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../navbar/">Default</a></li>
                <li><!--<form id="logout-form" method="post"><a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Logout</a></form>-->
                    <a href="logout">Logout</a></li>
                <li class="active"><a href="./">Fixed top <span class="sr-only">(current)</span></a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

{{--<nav class="navbar navbar-default" role="navigation">--}}
    {{--<div class="container">--}}
        {{--<!-- Brand and toggle get grouped for better mobile display -->--}}
        {{--<div class="navbar-header">--}}
            {{--<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-brand-centered">--}}
                {{--<span class="sr-only">Toggle navigation</span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
            {{--</button>--}}
            {{--<div class="navbar-brand navbar-brand-centered">Brand</div>--}}
        {{--</div>--}}

        {{--<!-- Collect the nav links, forms, and other content for toggling -->--}}
        {{--<div class="collapse navbar-collapse" id="navbar-brand-centered">--}}
            {{--<ul class="nav navbar-nav">--}}
                {{--<li><a href="#">Link</a></li>--}}
                {{--<li><a href="#">Link</a></li>--}}
                {{--<li><a href="#">Link</a></li>--}}
            {{--</ul>--}}
            {{--<ul class="nav navbar-nav navbar-right">--}}
                {{--<li><a href="#">Link</a></li>--}}
                {{--<li><a href="#">Link</a></li>--}}
                {{--<li><a href="#">Link</a></li>--}}
            {{--</ul>--}}
        {{--</div><!-- /.navbar-collapse -->--}}
    {{--</div><!-- /.container-fluid -->--}}
{{--</nav>--}}