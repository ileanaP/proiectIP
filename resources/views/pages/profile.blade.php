@extends('layouts.home')
@section('content')
    <div class="container">
        <div class="card hovercard">
            <div class="card-background">
                {{ Html::image('img/'.$user[0]->avatar, '', array('class' => 'card-bkimg')) }}
                <!-- http://lorempixel.com/850/280/people/9/ -->
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
                <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    <div class="hidden-xs">Stars</div>
                </button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
                    <div class="hidden-xs">Setari</div>
                </button>
            </div>
            <!--<div class="btn-group" role="group">
                <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    <div class="hidden-xs">Following</div>
                </button>
            </div>-->
        </div>

        <div class="well">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1">
                    <h3>This is tab 1</h3>
                </div>
                <div class="tab-pane fade in" id="tab2">

                    <form class="form-horizontal">
                        <fieldset>

                            <!-- Form Name -->
                            <legend>Setari</legend>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Email</label>
                                <div class="col-md-5">
                                    <input id="textinput" name="textinput" type="text" placeholder="{{$user[0]->email}}" class="form-control input-md">
                                    <span class="help-block">Schimbati-va email-ul</span>
                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="parolanoua">Parola noua</label>
                                <div class="col-md-4">
                                    <input id="parolanoua" name="parolanoua" type="password" placeholder="******" class="form-control input-md">
                                    <span class="help-block">Schimbati-va parola</span>
                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="parolanouarepeat">Repetati parola noua</label>
                                <div class="col-md-5">
                                    <input id="parolanouarepeat" name="parolanouarepeat" type="password" placeholder="******" class="form-control input-md">
                                    <span class="help-block">Repetati parola noua</span>
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="prenume">Prenume</label>
                                <div class="col-md-5">
                                    <input id="prenume" name="prenume" type="text" placeholder="{{$user[0]->name}}" class="form-control input-md">
                                    <span class="help-block">Schimbati-va prenumele</span>
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="nume">Nume</label>
                                <div class="col-md-5">
                                    <input id="nume" name="nume" type="text" placeholder="{{$user[0]->surname}}" class="form-control input-md">
                                    <span class="help-block">Schimbati-va numele</span>
                                </div>
                            </div>

                            <!-- Select Basic -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="locatie">Locatie</label>
                                <div class="col-md-5">
                                    <select id="locatie" name="locatie" class="form-control">
                                        <option value="" selected disabled>{{$location[0]->location}}</option>
                                        @foreach($locations as $loc)
                                            <option value="{{$loc->id}}">{{$loc->location}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- File Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="avatar">Avatar</label>
                                <div class="col-md-4">
                                    <input id="avatar" name="avatar" class="input-file" type="file">
                                </div>
                            </div>

                            <!-- Button (Double) -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="button1id"></label>
                                <div class="col-md-8">
                                    <button id="button1id" name="button1id" class="btn btn-success">Salvati</button>
                                    <button id="button2id" name="button2id" class="btn btn-danger">Anulati</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>


                </div>
                <div class="tab-pane fade in" id="tab3">
                    <h3>This is tab 3</h3>
                </div>
            </div>
        </div>

    </div>


@stop