
@extends('layouts.form')
@section('content')

    <div class="col-md-3">
        <p class="lead">Organizatori</p>
        <div class="list-group">
            @foreach($org as $organizer)
                <a href="{{ route('upcomingEvents', ['id' => $organizer->id]) }}" class="list-group-item">{{$organizer->name}}</a>
            @endforeach
        </div>
    </div>

    <div class="top-content">

        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>Adauga un alt user deja existent in categoria organizatori:</h3>
                            </div>
                        </div>
                        <div class="form-bottom">
                            <form role="form" action="{{ route('addOrganizer') }}" method="POST" class="login-form">
                                {{ csrf_field() }}

                                @include('layouts.userList')
                                <br><br>
                                <button type="submit" class="btn btn-success">
                                    Submit
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@stop