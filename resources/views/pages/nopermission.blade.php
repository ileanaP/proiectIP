@extends('layouts.master')
@section('content')
    <div align="center">{{Html::image('img/access_denied.png')}}</div>
    <div class="alert alert-danger">
        <strong>X</strong>
        @if(isset($errMessage))
            {{$errMessage}}
        @else
            Nu aveti permisiunea de a accesa aceasta pagina.
        @endif
    </div>
@stop