@extends('layouts.master')
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Slug</th>
            <th scope="col">Original name</th>
            <th scope="col">Path</th>
            <th scope="col">Count download</th>
        </tr>
        </thead>
        <tbody>
        @foreach($files as $file)
            <tr id="item-{{$file->id}}">
            <th scope="row">{{$file->id}}</th>
            <td><a href="{{route('file',['slug'=>$file->slug])}}">{{$file->slug }}</a></td>
            <td>{{$file->original_name}}</td>
            <td>
                {{$file->path}}
            <td>{{$file->count_download}}</td>
            <td><button type="button" class="btn btn-danger deleteFile" data-id="{{$file->id}}">Delete</button></td>
        </tr >
        @endforeach
        </tbody>
    </table>
    <div class="modal" tabindex="-1" id="confirmDelete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary checkDelete" data-dismiss="modal">Yes</button>
                    <button type="button" class="btn btn-primary">No</button>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="" id="fileId">
@endsection
@section('scripts')
    <script type="text/javascript">
        $('body').on('click', '.deleteFile', function () {
            $('#fileId').val($(this).attr('data-id'))
           $('#confirmDelete').modal('show');
        })
        $('body').on('click', '.checkDelete', function () {
          let id =$('#fileId').val();
            $.ajax({
                url: '/file/'+id,
                method: 'DELETE',
                data: {id, _token: '{!! csrf_token() !!}',},
                success: function(result) {
                    console.log(id)

                    $(`#item-${id}`).remove();
                    console.log(result)
                },
                error: function(result){
                    console.log(result)
                }
            });
        })
    </script>
@endsection