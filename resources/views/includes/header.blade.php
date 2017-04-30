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
                <li id="home"><a href="/">Acasa</a></li>
                <li><a id="upcomingEvents" href="/upcomingEvents">Evenimente</a></li>
                @if (Auth::check())
                    @if (in_array(Auth::user()->id, $orgIds))
                        <li><a id="addEventForm" href="/addEventForm">Adaugare eveniment</a></li>
                    @endif
                @endif
                <li><a id="profile" href="/profile">Profil</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li><a id="register" href="/register">Inregistrare</a></li>
                <li><a id="login" href="/login">Autentificare</a></li>
                <li><a href="logout">Iesire din cont</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
