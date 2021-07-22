@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <h1>Notices</h1>
        @if (auth()->user()->is_pt)
        <a href="/notices/create" class="btn btn-link btn-sm">Create new notice</a>
        @endif
    </div>
    @if(count($notices) > 0)
    <hr>
    @foreach($notices as $notice)
    <div class="card px-3 py-2 mb-2">
        <div class="row d-flex align-items-center">


            <div class="col-md-8 col-sm-8">
                <h3><a href="/notices/{{$notice->id}}">{{$notice->title}}</a></h3>
                <small>Written on {{$notice->created_at}} by
                    {{$notice->user->fname . ' ' . $notice->user->lname}}</small> <br>
            </div>
            <div class="col-md-4 col-sm-4">
                <a href="/{{$notice->file_path}}">Download Bid Document</a>
            </div>
        </div>
    </div>
    @endforeach
    {{$notices->links()}}
    @else
    <p>No notices found</p>
    @endif
</div>
@endsection
