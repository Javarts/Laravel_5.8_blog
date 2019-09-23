@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>Tags <span class="fa fa-tag"></span></strong>
            <a style="margin-top: -7px;" href="{{ route('tags.create') }}" class="btn btn-success pull-right" title="Add Tag"><span class="fa fa-plus"></span></a>
        </div>

        <div class="panel-body">
            @if ($tags->count() > 0)
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $tag->name }}</td>
                        <td>
                            <a href="{{ route('tags.edit', $tag->id) }}" class="btn  btn-primary"><span class="fa fa-edit"></span></a>
                            <a href="{{ route('tags.destroy', $tag->id) }}" class="btn  btn-danger"><span class="fa fa-trash"></span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="text-center">
                    <h1>NO RECORDS FOUND</h1>
                    <a href="{{ route('tags.create') }}" class="btn btn-success" title="Add new Post">Add New <span
                            class="fa fa-plus"></span></a>
                </div>
            @endif

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
            
                    <!-- Modal content-->
                    <form action="" method="POST" id="deleteCategoryForm">
            
                        @method('DELETE')
                        @csrf
            
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Delete Category</h4>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete <strong><u>{{ @$category->name }}?</u></strong> </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><span
                                        class="fa fa-angle-left fa-lg"></span> No, Go back</button>
                                <button type="submit" class="btn btn-danger"><span class="fa fa-trash-o fa-lg"></span> Yes, Delete
                                </button>
                            </div>
                        </div>
            
                    </form>
            
                </div>
            </div>
        </div>

        <div class="panel-footer"></div>
    </div>
@endsection

@section('scripts')
    <script>
        function trashCategory(id) {

                var form = document.getElementById('deleteCategoryForm');
                form.action = '/categories/'+id;

                $('#myModal').modal('show');
            }
    </script>
@endsection