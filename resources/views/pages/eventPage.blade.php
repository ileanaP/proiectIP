@extends('layouts.master')
@section('content')

    <div class="row">

        @include('includes.sidebar')

        <div class="col-md-9">

            <div>
                @if(count($pics) > 0)
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

                                @foreach ($pics as $i => $pic)
                                <div @if ($i == 0) class="item active" @else class="item" @endif>
                                    {{ Html::image('img/' . $pic->picture, '', ['class' => 'slide-image', 'width' => 250, 'height' => 150]) }}
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
                @endif

                <div class="caption-full">
                    <h4 class="pull-right">{{$event[0]->price}} RON</h4>
                    <h4><a href="#">{{$event[0]->name}}</a>
                    </h4>
                    <p><strong>Data: </strong> {{ $event[0]->data }}</p>
                    <p>{{ $event[0]->desc }}</p>
                    <p>Mai multe informatii: <a target="_blank" href="{{ $event[0]->link }}">{{ $event[0]->link }}</a>.</p>
                </div>
                <div class="caption-full">
                    @if ($event[0]->data < date('Y-m-d h:i:s') && Auth::check())
                        <a class="btn btn-default disabled pull-right">Participa</a>
                    @elseif (Auth::check())
                        @if (!$attendees->isEmpty())
                            @if(in_array(Auth::user()->id,$usrid))
                                <a class="btn btn-default pull-right" href="{{ route('notAttendEvent', ['id' => $id] ) }}">Nu mai particip</a>
                            @else
                                <a class="btn btn-danger pull-right" href="{{ route('attendEvent', ['id' => $id] ) }}">Participa</a>
                            @endif
                        @else
                            <a class="btn btn-danger pull-right" href="{{ route('attendEvent', ['id' => $id] ) }}">Participa</a>
                        @endif
                    @endif

                    <h4>Organizator</h4>
                    <p>{{ $org[0]->name }}</p>
                    <h4>Participanti</h4>
                    @if(!$attendees->isEmpty())
                        <ul>
                            @foreach($attendees as $a)
                                    <li><a href="{{ route('profile', ['id' => $a->id] ) }}">{{ $a->user }}</a></li>
                            @endforeach
                        </ul>
                    @elseif ($event[0]->data > date('Y-m-d h:i:s'))
                         <p>Acest eveniment nu are momentan participanti!</p>
                    @else <p>Acest eveniment nu a avut participanti!</p>
                    @endif
                </div>

                    <div>
                    @if ($event[0]->data < date('Y-m-d h:i:s'))
                        <h4> Evenimentul s-a incheiat!</h4>
                        @if (Auth::check())
                            @if(in_array(Auth::user()->id, $usrid))
                                <form role="form" action="{{ route('addFeedback') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $id }}" name="eventId" id="eventId">

                                    <input class="star star-5" id="star-5-2" name="5" type="radio" />
                                    <label class="star star-5" for="star-5-2"></label>
                                    <input class="star star-4" id="star-4-2" name="4" type="radio" />
                                    <label class="star star-4" for="star-4-2"></label>
                                    <input class="star star-3" id="star-3-2" name="3" type="radio" />
                                    <label class="star star-3" for="star-3-2"></label>
                                    <input class="star star-2" id="star-2-2" type="radio" name="2" />
                                    <label class="star star-2" for="star-2-2"></label>
                                    <input class="star star-1" id="star-1-2" type="radio" name="1"/>
                                    <label class="star star-1" for="star-1-2"></label>

                                    <br>
                                    <textarea rows="2" cols="50" id="feedbackReason" name="feedbackReason" placeholder="Completeaza aici feedback-ul tau despre eveniment.."></textarea>
                                <br>
                                    <button type="submit">Trimite!
                                    </button>
                                </form>
                                <br><br>
                            @endif
                        @endif
                    @endif
                        @if ($feedbackMessage != '')
                            <h4 style="color:red"> {{ $feedbackMessage }} </h4>
                        @endif
                    </div>

            </div>


            @if ($event[0]->data < date('Y-m-d h:i:s'))
            <div>
                <div>
                    @if (count($feedback))
                        <p class="lead">Mai multe opinii despre eveniment:</p>
                        <div class="list-group">
                            <table class="table" style="border-top: 1px solid #cdd0d4">
                                @foreach($feedback as $userFeedback)
                                    <tr style="border-left: 1px solid #cdd0d4;border-right: 1px solid #cdd0d4;width:70%">
                                        <td> <h4 align="left"> {{ $userFeedback->user }}: </h4>
                                            @if ($userFeedback->stars == 1) &#x2605;</span>
                                            @elseif ($userFeedback->stars ==2) &#x2605;&#x2605;
                                            @elseif ($userFeedback->stars == 3) &#x2605;&#x2605;&#x2605;
                                            @elseif ($userFeedback->stars == 4) &#x2605;&#x2605;&#x2605;&#x2605;
                                            @elseif ($userFeedback->stars == 5) &#x2605;&#x2605;&#x2605;&#x2605;&#x2605;
                                            @endif
                                        </td>
                                        <td align="right">{{ $userFeedback->created_at }}
                                            <br></td>
                                    </tr>
                                    <tr style="border-left: 1px solid #cdd0d4;border-bottom: 1px solid #cdd0d4; border-right: 1px solid #cdd0d4" >
                                        <td colspan="2"> {{ $userFeedback->comm }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @else
                        <p class="lead">Nu exista feedback pentru acest eveniment!</p>
                    @endif
                </div>

            </div>
            @endif

        </div>

    </div>

@stop