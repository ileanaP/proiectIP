@extends('layouts.home')
@section('content')
<!-- Half Page Image Background Carousel Header -->
<header id="myCarousel" class="carousel slide">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for Slides -->
    <div class="carousel-inner">
        <div class="item active">
            <!-- Set the first background image using inline CSS below. -->
            <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide One');"></div>
            <div class="carousel-caption">
                <h2>Caption 1</h2>
            </div>
        </div>
        <div class="item">
            <!-- Set the second background image using inline CSS below. -->
            <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Two');"></div>
            <div class="carousel-caption">
                <h2>Caption 2</h2>
            </div>
        </div>
        <div class="item">
            <!-- Set the third background image using inline CSS below. -->
            <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Three');"></div>
            <div class="carousel-caption">
                <h2>Caption 3</h2>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="icon-next"></span>
    </a>

</header>

<!-- Page Content -->
<div class="container">

    <hr>

    <div class="row">
        <div class="col-sm-8">
            <h2>Bine ati venit la "Fundatia Gabriela Tudor"!</h2>
            <div>
                <br><br>
                <h4> Ce puteti gasi la noi ?</h4>
                <br>
                <p>
                    Aplicaţia este un agregator de evenimente, cursuri si spectacole de dans. Ea vine în întâmpinarea tuturor persoanelor pasionate de dans, interesate de evenimente din cel puţin una din categoriile de evenimente gestionate de aceasta (spectacole de dans, ateliere de dans, filme de dans sau alte evenimente). Desi „gusturile nu se discută”, userii isi pot face o idee despre un eveniment trecand prin review-urile lasate de alti useri la evenimente trecute similare sau apartinand aceluiasi organizator.
                </p>
                <p>
                    În plus, există o multitudine de evenimente, mai mult sau mai puțin promovate, motiv pentru care pentru un pasionat al dansului  sa fie la curent cu toate acestea ar insemna o investitie mare de timp. Cu ajutorul nostru,  timpul necesar pentru a prospecta piața va scădea considerabil, deoarece aici gasiti toate evenimentele din domeniul dansului demne de luat in considerare.
                </p>
            </div>

        </div>
    </div>
</div>
<!-- /.container -->

@stop