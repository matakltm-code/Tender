@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/posts" class="btn btn-link btn-sm">Go Back</a>
    <h1>{{$post->title}}</h1>
    @if ($post->image_path != null)
    <img style="width:100%" src="/{{$post->image_path}}">
    @endif
    <div>
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}} ({{$post->created_at->diffForHumans()}}) by {{$post->user->name}}</small>
    <hr>
    <div class="d-flex justify-content-between">
        @if(Auth::user()->id == $post->user_id)
        <a href="/posts/{{$post->id}}/edit" class="btn btn-info">Edit</a>

        <form method="POST" action="/posts/{{$post->id}}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                {{ __('Delete') }}
            </button>
        </form>
        @endif
    </div>
</div>
@endsection
