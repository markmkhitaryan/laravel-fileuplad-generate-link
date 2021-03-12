<tr @foreach($files as $file)>
    <th scope="row">{{$file->id}}</th>
    <td><a href="{{route('file',['slug'=>$file->slug])}}">{{$file->slug }}</a></td>
    <td>{{$file->original_name}}</td>
    <td>
    {{$file->path}}
    <td>{{$file->count_download}}</td>
    <td><button type="button" class="btn btn-danger deleteFile" data-id="{{$file->id}}">Delete</button></td>
</tr @endforeach>