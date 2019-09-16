@extends('layouts.app')


@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{ isset($category) ? 'Edit Category' : 'Create Category' }}</h4>
        </div>

        <div class="panel-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item text-danger">
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
                @csrf

                @if (isset($category))
                    @method('PUT')                      
                @endif
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input id="name" type="text" class="form-control" name="name" placeholder="Enter a category name" value="{{ isset($category)? $category->name : '' }}">

                </div>

                <div class="form-group">
                    <button class="btn btn-success">
                        {{ isset($category) ? 'Update Category' : 'Add Category' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
