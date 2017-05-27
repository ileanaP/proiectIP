@extends('layouts.master')
@section('content')

    <div class="row">

        <div class="col-md-9">

            <div class="row">

                @if (count($events) == 0)
                    <h3>Nu ai evenimente in trecut!</h3>
                @else

                @foreach($events as $event)
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail" style="border:0px">
                            {{ Html::image('img/' . $event->picture) }}
                            <div class="caption">
                                <h4 class="pull-right">{{$event->price}} RON</h4>
                                <h4><a href="{{ route('editEvent', ['id' => $event->id]) }}">{{ $event->name }}</a>
                                </h4>
                                <p class="read-more">{{ $event->desc }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

                @endif

            </div>
        </div>
    </div>

@stop