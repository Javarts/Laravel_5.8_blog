@extends('layouts.app')


@section('content')
   

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Categories</h4>
            <a style="margin-top: -36px;" href="{{ route('categories.create') }}" class="btn btn-success pull-right" title="Add Category"><span class="fa fa-plus"></span></a>
            <div class="clearfix"></div>
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <th>Name</th>
                    <th>Actions</th>
                </thead>

                <tbody>
                    @foreach ($categories as $category)
                         <tr>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-xsms"><span class="fa fa-edit"></span></a>
                                <a href="" class="btn btn-danger btn-sm"><span class="fa fa-trash-o"></span></a>
                            </td>
                        </tr>
                    @endforeach
                   
                </tbody>
            </table>
        </div>
    </div>
@endsection
