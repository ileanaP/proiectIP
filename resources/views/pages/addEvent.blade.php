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
                            <form role="form" action="{{ route('addEvent') }}" enctype="multipart/form-data" method="POST" class="login-form">
                                {{ csrf_field() }}

                                @include('layouts.categoryList')
                                <br><br>
                                <br>
                                <div>Titlu:</div>
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif

                                </div>

                                <div class="form-group">Descriere:
                                    <textarea name="description" id="description" class="form-control">
                                    </textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif

                                </div>

                                <div class="form-group">Adresa:
                                    <input type="text" name="address" id="address" value="{{ old('address') }}" class="form-control">
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">Pretul unui bilet la eveniment:
                                    <input type="text" name="price" id="price" value="{{ old('price') }}" class="form-control">
                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">Link catre pagina evenimentului:
                                    <input type="text" name="link" id="link" value="{{ old('link') }}" class="form-control">
                                    @if ($errors->has('link'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">Data evenimentului:
                                    <input type="text" name="date" id="date" value="{{ old('date') }}" class="form-control">
                                    @if ($errors->has('date'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                    @endif
                                </div>


                                <div class="form-group">Adauga o imagine reprezentativa:

                                    <input type="file" name="image" id="image">

                                </div>
                                <button type="submit" class="submit">
                                    Submit
                                </button>

                                @if ($errorMessage != '')
                                    <h4>{{ $errorMessage }}</h4>
                                @endif

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