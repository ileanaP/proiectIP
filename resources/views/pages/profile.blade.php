@extends('layouts.home')
@section('content')
    <div class="container">
        <div class="card hovercard">
            <div class="card-background">
                {{ Html::image('img/'.$user[0]->avatar, '', array('class' => 'card-bkimg')) }}

            </div>
            <div class="useravatar">
                {{ Html::image('img/'.$user[0]->avatar, '', array('class' => '')) }}
            </div>
            <div class="card-info">
                <span class="card-title">
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
                <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
                    <div class="hidden-xs">Setari</div>
                </button>
            </div>
        </div>

        <div class="well">
            <div class="tab-content">
                <div class="tab-pane fade in" id="tab2">
                    <form role="form" action="{{ route('submitChanges') }}"  enctype="multipart/form-data" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        <fieldset>

                            <!-- Form Name -->
                            <legend>Setari</legend>

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
                                    @if ($errors->has('password_confirmed'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmed') }}</strong>
                                    </span>
                                    @endif

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
                                    <select id="location" name="location" class="form-control">
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
                                <span class="help-block">Va puteti modifica avatarul deja existent introducand o noua poza;</span>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="submit"></label>
                                <div class="col-md-8">
                                    <button type="submit" id="submit" class="btn btn-success">
                                        Salvati modificarile
                                    </button>
                                </div>
                            </div>

                        </fieldset>
                    </form>


                </div>
            </div>
        </div>

        <div>
            @if  ($saveMessage != '' && !$errors->all())
                <h4> {{ $saveMessage }}</h4>
            @endif
        </div>
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

    </div>

@stop
