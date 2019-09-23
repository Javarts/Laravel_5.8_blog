@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>
                {{ isset($tag) ? 'Edit Tag' : 'Creat Tag' }}
                 <span class="fa fa-tags"></span>
            </strong>
        </div>
        <div class="panel-body">
            <form action="{{ isset($tags) ? route('tags.update', $tags->id) : route('tags.store') }}" method="POST">
                @csrf
                @if (isset($tags))
                    @method('PUT')                    
                @endif

                <label for="tags">Tags <span class="fa fa-caret-down"></span></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                    <input type="text" name="tags" placeholder="enter tag name" id="tags" class="form-control input-lg" value="{{ isset($tag) ? $tag->name : '' }}">
                </div><br>

                <button class="btn btn-success">
                    {{ isset($tags) ? 'Update Tag' : 'Add tag' }}
                    <span class="fa fa-save"></span>
                </button>
            </form>
        </div>
        <div class="panel-footer text-center">powered by webfliQs <span class="fa fa-cube fa-lg"></span></div>
    </div>
@endsection