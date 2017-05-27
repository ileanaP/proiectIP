@extends('layouts.home')
@section('content')
    <form class="form-horizontal" role="form" action="{{ route('submitAddOrganization') }}" method="POST" class="login-form">
        <fieldset>

            {{ csrf_field() }}

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="orgName">Nume</label>
                <div class="col-md-4">
                    <input id="orgName" name="orgName" type="text" placeholder="nume organizatie" class="form-control input-md">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="orgAddress">Adresa</label>
                <div class="col-md-6">
                    <input id="orgAddress" name="orgAddress" type="text" placeholder="adresa organizatie" class="form-control input-md">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="orgPhone">Telefon</label>
                <div class="col-md-4">
                    <input id="orgPhone" name="orgPhone" type="text" placeholder="nr. telefon" class="form-control input-md">

                </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="orgLocation">Locatie</label>
                <div class="col-md-4">
                    <select id="orgLocation" name="orgLocation" class="form-control">
                        @foreach($locations as $loc)
                            <option value="{{$loc->id}}">{{$loc->location}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="addOrgButtonSubmit"></label>
                <div class="col-md-4">
                    <button id="addOrgButtonSubmit" name="addOrgButtonSubmit" class="btn btn-success">Adauga Organizatie</button>
                </div>
            </div>

        </fieldset>
    </form>

@stop