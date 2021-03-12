@extends('layouts.master')

@section('content')

            <div class="card">
                <div class="card-link">
                    <a href="{{route('file.create')}}" class="btn btn-outline-secondary btn-lg btn-block">
                        Upload file
                    </a>
                </div>
            </div>

@endsection
