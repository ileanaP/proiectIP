
@extends('layouts.form')
@section('content')

    <div class="top-content">


        <table class="table" style="border-top: 1px solid #cdd0d4">
            @foreach($events as $event)
                <tr style="border-left: 1px solid #cdd0d4;border-right: 1px solid #cdd0d4;width:70%">
                    <td>{{ $event->name}}</td>
                </tr>
            @endforeach
        </table>


    </div>


@stop