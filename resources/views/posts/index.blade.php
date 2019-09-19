@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Posts</h4>
            <a style="margin-top: -36px;" href="{{ route('posts.create') }}" class="btn btn-success pull-right" title="Add new Post"><span class="fa fa-plus"></span></a>
            <div class="clearfix"></div>
        </div>

        <div class="panel-body" style="overflow:auto;">
           @if ($posts->count() > 0)
                <table class="table table-bordered table-hover">
                    <thead>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td><img src="{{ asset('storage/'.$post->image) }}" alt=""></td>
                                <td>{{ @$post->title }}</td>

                                <td>
                                    @if (!$post->trashed())
                                        <a href="" class="btn btn-info"><span class="fa fa-edit"></span></a>
                                    @endif

                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">
                                            {{ $post->trashed() ? 'Delete' : 'Trash' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
           @else
               <div class="text-center">
                   <h1>NO RECORDS FOUND</h1>
                   <a href="{{ route('posts.create') }}" class="btn btn-success" title="Add new Post">Add New Post <span class="fa fa-plus"></span></a>
               </div>
           @endif
        </div>
    </div>
@endsection