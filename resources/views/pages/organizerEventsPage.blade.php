@extends('layouts.form')
@section('content')

    <div class="top-content">

    @include('layouts.organizerList')

        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>Adauga un alt user in categoria organizatori:</h3>
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

        @if (count($events) == 0)
            <h4> Acest organizator nu are evenimente in trecut!</h4>
        @else
        <h4>Toate evenimentele din trecut: </h4>
        <table class="table" style="border-top: 1px solid #cdd0d4">
            <tr><th>Nume eveniment</th>
                <th>Nota eveniment (maxim 5)</th>
            </tr>
            @foreach($events as $event)
                <tr style="border-left: 1px solid #cdd0d4;border-right: 1px solid #cdd0d4;width:70%">
                    <td>{{ $event->name}}</td>
                    <td> @if ($event->average != -1)
                            {{ $event->average}}
                         @else
                            Nu exista feedback pentru acest eveniment!
                         @endif
                    </td>
                </tr>
            @endforeach
        </table>
        @endif


    </div>


@stop