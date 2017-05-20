@extends('layouts.home')
@section('content')
    {!! $calendar->calendar() !!}
    {!! $calendar->script() !!}
@stop