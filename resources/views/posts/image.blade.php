@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"></div>

        <div class="panel-body">
            {{ isset($Post) ? 'wow' : 'noope' }}
        </div>

        <div class="panel-footer"></div>
    </div>
@endsection