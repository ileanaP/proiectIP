@extends('layouts.master')
@section('content')

    <div class="row">
        @include('includes.sidebar')

        <div class="col-md-9">

            <div class="row">

                @if (count($events))
                @foreach($events as $event)
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail" style="border:0px">
                            @if($event->picture != '')
                            {{ Html::image('img/' . $event->picture, '', ['width' => 250, 'height' => 150]) }}
                            @endif
                            <div class="caption">
                                <h4 class="pull-right">{{$event->price}} RON</h4>
                                <h4><a href="{{ route('eventpage', ['id' => $event->id] ) }}">{{ $event->name }}</a>
                                </h4>
                                <p class="read-more">{{ $event->desc }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                    <h4>Momentan nu exista evenimente inregistrate in aceasta categorie!</h4>
                @endif

            </div>

        </div>

    </div>

@stop