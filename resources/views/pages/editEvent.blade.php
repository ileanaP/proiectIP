@extends('layouts.home')
@section('content')
    <div class="container">
        <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
                    <div class="hidden-xs">Editati evenimentul</div>
                </button>
            </div>
        </div>

        <div class="well">
            <div class="tab-content">
                <div class="tab-pane fade in" id="tab2">
                    <form role="form" action="{{ route('submitEventChanges') }}"  enctype="multipart/form-data" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        <fieldset>

                            <legend>Detalii despre eveniment:</legend>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="email">Nume</label>
                                <div class="col-md-5">
                                    <input id="name" name="name" type="text" value="{{$eventInfo[0]->name}}" class="form-control input-md">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="name">Pret</label>
                                <div class="col-md-5">
                                    <input id="price" name="price" type="text" value="{{$eventInfo[0]->price}}" class="form-control input-md">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="name">Descriere</label>
                                <div class="col-md-5">
                                    <input id="desc" name="desc" type="text" value="{{$eventInfo[0]->desc}}" class="form-control input-md">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="name">Link eveniment</label>
                                <div class="col-md-5">
                                    <input id="link" name="link" type="text" value="{{$eventInfo[0]->link}}" class="form-control input-md">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label" for="image">Imagine</label>
                                <div class="col-md-4">
                                    <input id="mainImage" name="mainImage" class="input-file" type="file">
                                    <span class="help-block">Aici puteti schimba imaginea principala a evenimentului;</span>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label" for="image">Poze</label>
                                <div class="col-md-4">
                                    <input id="image" name="image" class="input-file" type="file">
                                    <span class="help-block">Aici puteti adauga poze care sa apara pe pagina evenimentului;</span>
                                </div>
                            </div>
                            <input type="hidden" id="eventId" name="eventId" value="{{$eventInfo[0]->id}}">

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
            @if ($saveMessage != '')
                <h4> {{ $saveMessage }} </h4>
            @endif
        </div>

    </div>


@stop