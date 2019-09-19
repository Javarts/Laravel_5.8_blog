@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Create Post</strong></div>

        <div class="panel-body">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label for="title">Title <span class="fa fa-caret-down"></span></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                    <input type="text" class="form-control input-lg" name="title" value="" placeholder="" id="title">
                </div><br>

                <label for="description">Description <span class="fa fa-caret-down"></span></label>
                    <textarea name="description" id="description" cols="5" rows="5" class="form-control"></textarea><br>
                
                <label for="content">Content <span class="fa fa-caret-down"></span></label>
                    <textarea name="content" id="content" cols="5" rows="5" class="form-control"></textarea><br>

                <label for="published_at">Published At <span class="fa fa-caret-down"></span></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control input-lg" name="published_at" value="" placeholder="" id="published_at">
                </div><br>

                <label for="image">Post Image <span class="fa fa-caret-down"></span></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-image"></i></span>
                    <input type="file" class="form-control input-lg" name="image" value="" placeholder="" id="image">
                </div><br><br>

                <button type="submit" class="btn btn-success btn-lg">
                    Create Post <span class="fa fa-save"></span>
                </button>

            </form>
        </div>
    </div>
@endsection