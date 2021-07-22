@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        @if (auth()->user()->is_bi)
        <h2>My Bidding Proposals</h2>
        @elseif (auth()->user()->is_pac)
        <h2>Bidders Proposals</h2>
        @endif
    </div>
    @if(count($proposals) > 0)
    <hr>
    @foreach($proposals as $proposal)
    <div class="card px-3 py-2 mb-2">
        <div class="row d-flex align-items-center">
            <div class="col-md-8 col-sm-8">
                <h3>
                    <a href="/proposals/{{$proposal->id}}">{{$proposal->notice->title}}</a>
                    <small>in {{$proposal->initial_payment}} ETB</small>
                </h3>
                @if (auth()->user()->id == $proposal->user_id)
                <small>You write &mdash; {{$proposal->created_at}}</small> <br>
                @else
                <small>Written on &mdash; {{$proposal->created_at}} by
                    {{$proposal->user->fname . ' ' . $proposal->user->lname}}</small> <br>
                @endif
            </div>
            <div class="col-md-4 col-sm-4">
                @if (auth()->user()->id == $proposal->user_id)
                <a href="/{{$proposal->file_path}}">Download My Attachiment</a>
                @endif
                <a href="/{{$proposal->notice->file_path}}">Download Bid Document</a>
            </div>
        </div>
    </div>
    @endforeach
    {{$proposals->links()}}
    @else
    <p>No proposals found</p>
    @endif
</div>
@endsection
