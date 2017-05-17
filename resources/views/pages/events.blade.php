@extends('layouts.master')
@section('content')

    <div class="row">
        @include('includes.sidebar')

        <div class="col-md-9">

            <div class="row">

                @foreach($events as $event)
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail" style="border:0px">
                            {{ Html::image('img/' . $event->picture) }}
                            <div class="caption">
                                <h4 class="pull-right">{{$event->price}} RON</h4>
                                <h4><a href="{{ route('eventpage', ['id' => $event->id] ) }}">{{ $event->name }}</a>
                                </h4>
                                <p class="read-more">{{ $event->desc }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>

    </div>

@stop