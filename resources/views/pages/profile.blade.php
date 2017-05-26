@extends('layouts.home')
@section('content')
        <div class="card hovercard">
            <div class="card-background">
                {{ Html::image('img/'.$user[0]->avatar, '', array('class' => 'card-bkimg')) }}
                <!-- http://lorempixel.com/850/280/people/9/ -->
            </div>
            <div class="useravatar">
                {{ Html::image('img/'.$user[0]->avatar, '', array('class' => '')) }}
            </div>
            <div class="card-info"> <span class="card-title">
                    @if(empty($user[0]->name) && empty($user[0]->surname))
                        {{$user[0]->user}}
                    @else
                        {{$user[0]->name." ".$user[0]->surname." (".$user[0]->user.")"}}
                    @endif
                </span>
            </div>
        </div>
        <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    <div class="hidden-xs">Detalii</div>
                </button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                    <div class="hidden-xs">Setari</div>
                </button>
            </div>
        </div>

        <div class="well">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1">

                <!-- events of the user from the Attends table -->
                <!-- ------ ------ ------ ------ ------ ------ ------ ------ ------ -->
                    @if(count($userEvents) != 0)
                        <legend>Evenimente la care a participat</legend>
                        <ul>
                            @foreach($userEvents as $userEvent)
                                <li><a href="{{ route('eventpage', ['id' => $userEvent->id] ) }}">{{$userEvent->name}}</a></li>
                            @endforeach
                        </ul>
                    @else
                        <h3>Nu a participat la nici un eveniment!</h3>
                    @endif
                </div>
                <div class="tab-pane fade in" id="tab2">
                    <form role="form" action="{{ route('submitChanges') }}"  enctype="multipart/form-data" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        <fieldset>

                            <!-- Form Name -->
                            <legend>Setari</legend>
                            @if(Auth::user()->id == $user[0]->id)
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="email">Email</label>
                                    <div class="col-md-5">
                                        <input id="email" name="email" type="text" value="{{$user[0]->email}}" class="form-control input-md">
                                    </div>
                                </div>

                                <!-- Password input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="password">Parola noua</label>
                                    <div class="col-md-4">
                                        <input id="password" name="password" type="password" class="form-control input-md">
                                    </div>
                                </div>

                                <!-- Password input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="confirmedPassword">Repetati parola noua</label>
                                    <div class="col-md-5">
                                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control input-md">
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="name">Nume</label>
                                    <div class="col-md-5">
                                        <input id="name" name="name" type="text" value="{{$user[0]->name}}" class="form-control input-md">
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="surname">Prenume</label>
                                    <div class="col-md-5">
                                        <input id="surname" name="surname" type="text" value="{{$user[0]->surname}}" class="form-control input-md">
                                    </div>
                                </div>

                                <!-- Select Basic -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="location">Locatie</label>
                                    <div class="col-md-5">
                                        <select id="location" name="location" clas
                                        <option value="" selected>{{$location[0]->location}}</option>
                                        @foreach($locations as $loc)
                                            <option value="{{$loc->id}}">{{$loc->location}}</option>
                                            @endforeach
                                            </select>
                                    </div>
                                </div>

                                <!-- File Button -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="image">Avatar</label>
                                    <div class="col-md-4">
                                        <input id="image" name="image" class="input-file" type="file">
                                    </div><br>
                                    <span class="help-block">Dimensiunea maxima: 1MB.</span>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="submit"></label>
                                    <div class="col-md-8">
                                        <button type="submit" id="submit" class="btn btn-success">
                                            Salvati modificarile
                                        </button>
                                    </div>
                                </div>
                            @else
                                <h3>Nu aveti dreptul de a efectua modificari</h3>
                            @endif
                        </fieldset>
                    </form>
                </div>
            </div>

            <!-- error messages related to changing user data -->
            <!-- ------ ------ ------ ------ ------ ------ ------ ------ ------ -->
            <div>
                @if  ($saveMessage != '' && !$errors->all())
                    <h4> {{ $saveMessage }}</h4>
                @endif
                @if ($errors->has('password'))
                    <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                @endif
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                @endif
                @if ($errors->has('image'))
                    <span class="help-block">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                @endif
            </div>
        </div>

@stop
