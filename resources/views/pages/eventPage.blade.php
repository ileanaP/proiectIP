@extends('layouts.master')
@section('content')

    <div class="row">

        @include('layouts.sidebar')

        <div class="col-md-9">

            <div>

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                @for($i = 1; $i < $n; $i++)
                                <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}"></li>
                                @endfor
                            </ol>
                            <div class="carousel-inner">

                                @foreach($pics as $i => $pic)
                                <div @if($i == 0) class="item active" @else class="item" @endif>
                                    {{ Html::image('img/'.$pic->picture, '', array('class' => 'slide-image')) }}
                                </div>
                                @endforeach

                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>

                </div>


                <div class="caption-full">
                    <h4 class="pull-right">{{$event[0]->price}} RON</h4>
                    <h4><a href="#">{{$event[0]->name}}</a>
                    </h4>
                    <p><strong>Data: </strong> {{ $event[0]->data }}</p>
                    <p>{{ $event[0]->desc }}</p>
                    <p>More info: <a target="_blank" href="{{ $event[0]->link }}">{{ $event[0]->link }}</a>.</p>
                </div>
                <div class="caption-full">
                    @if (Auth::check())
                        @if(in_array(Auth::user()->user,$attendees))
                            <a class="btn btn-default pull-right" href="{{ route('notAttendEvent', ['id' => $id] ) }}">Nu mai particip</a>
                        @else
                            <a class="btn btn-danger pull-right" href="{{ route('attendEvent', ['id' => $id] ) }}">Participa</a>
                        @endif
                    @else
                        <a class="btn btn-default disabled pull-right">Participa</a>
                    @endif
                    <h4>Organizator</h4>
                    <p>{{ $org[0]->name }}</p>
                    <h4>Participanti</h4>
                    <ul>
                    @foreach($attendees as $a)
                            <li><a href="{{ route('profile', ['id' => $a->id] ) }}">{{ $a->user }}</a></li>
                    @endforeach
                    </ul>
                </div>
            </div>


        </div>

    </div>

@stop