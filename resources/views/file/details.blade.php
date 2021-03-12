@extends('layouts.master')
@section('content')
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">{{$file->original_name}}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{$file->created_at}}</h6>
            <a href="{{route('download',['id'=>$file->id])}}" class="card-link">download</a>
        </div>
    </div>
@endsection