@extends('layouts.form')
@section('content')

    <div class="top-content">

        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>Adauga un nou eveniment din urmatoarele categorii disponibile:</h3>
                            </div>
                        </div>
                        <div class="form-bottom">
                            <form role="form" action="{{ route('addEvent') }}" method="POST" class="login-form">
                                {{ csrf_field() }}

                                @include('layouts.categoryList')
                                <br><br>

                                <div class="form-group">Titlu:
                                    <input type="text" name="title" id="title" class="form-username form-control">
                                </div>

                                <div class="form-group">Descriere:
                                    <label class="sr-only" for="form-password">Descriere eveniment</label>
                                    <textarea name="description" id="description" class="form-username form-control">
                                    </textarea>
                                </div>

                                <div class="form-group">Adresa:
                                    <label class="sr-only" for="form-username">Adresa:</label>
                                    <input type="text" name="address" id="address" class="form-username form-control">
                                </div>

                                <div class="form-group">Pretul unui bilet la eveniment:
                                    <input type="text" name="price" id="price" class="form-username form-control">
                                </div>

                                <div class="form-group">Link catre pagina evenimentului:
                                    <input type="text" name="link" id="link" class="form-username form-control">
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- Javascript -->
    <script src="../resources/assetsLogin/js/jquery-1.11.1.min.js"></script>
    <script src="../resources/assetsLogin/bootstrap/js/bootstrap.min.js"></script>
    <script src="../resources/assetsLogin/js/jquery.backstretch.min.js"></script>
    <script src="../resources/assetsLogin/js/scripts.js"></script>

    <!--[if lt IE 10]>
    <script src="../resources/assetsLogin/js/placeholder.js"></script>
    <![endif]-->

@stop