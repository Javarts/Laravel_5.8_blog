@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>{{ isset($post) ? $post->title : 'Create Post' }}</strong>
        </div>

        <div class="panel-body">
            <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if (isset($post))
                    @method('PUT')
                @endif

                <label for="title">Title <span class="fa fa-caret-down"></span></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                    <input type="text" class="form-control input-lg" name="title" value="{{ isset($post) ? $post->title : '' }}" placeholder="" id="title">
                </div><br>

                <label for="description">Description <span class="fa fa-caret-down"></span></label>
                    <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ isset($post) ? $post->description : '' }}</textarea><br>

                <label for="content">Content <span class="fa fa-caret-down"></span></label>
                    <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : '' }}">
                    {{-- trix editor initializition --}}
                    <trix-editor input="content"></trix-editor><br>

                <label for="published_at">Published At <span class="fa fa-caret-down"></span></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control input-lg" name="published_at" value="{{ isset($post) ? $post->published_at : '' }}" placeholder="" id="published_at">
                </div><br>

                <label for="image">Post Image <span class="fa fa-caret-down"></span></label>
                @if (isset($post))
                    <img src="{{ asset('storage/'.$post->image) }}" alt="" style="width:50px; margin-bottom:10px; border-radius:50px; border:2px solid black;">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file"></i></span>
                        <input type="file" class="form-control input-lg" name="image" value="" placeholder="" id="image">
                    @else
                        <input type="file" class="form-control input-lg" name="image" value="" placeholder="" id="image">
                    @endif
                </div>

               <div class="col-md-12">
                   <label for="category">Category <span class="fa fa-caret-down"></span></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                        <select name="category" id="category" class="form-control input-lg">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"  
                                    
                                    @if (isset($post))
                                        @if ($category->id === $post->category_id)
                                            selected
                                        @endif
                                    @endif
                                    >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div><br>
               </div>

               <div class="col-md-12">
                    <button type="submit" class="btn btn-success btn-lg">
                        @if (isset($post))
                        Edit Post <span class="fa fa-edit"></span>
                        @else
                        Create Post <span class="fa fa-save"></span>
                        @endif
                    </button>
                </div>
                <div class="clearfix"></div><br>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/trix-editor.js') }}"></script>
    <script src="{{ asset('js/flat-pickr.js') }}"></script>

    <script>
        flatpickr('#published_at', {
            enableTime: true
        });
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/trix-editor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flat-pickr.min.css') }}">
@endsection
