@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        @if (auth()->user()->is_pt)
        <h2>Assessed Proposals</h2>
        @else
        <h2>Winner Proposals</h2>
        @endif
    </div>
    @if(count($proposals) > 0)
    <hr>
    @foreach($proposals as $proposal)
    <div>
        @if (auth()->user()->id == $proposal->user_id)
        <div class="bg-success p-2 col-md-12 text-white text-center">Your Proposal</div>
        @endif
        @if ($proposal->winner_pt_status)
        <div class="bg-success p-2 col-md-12 text-white text-center">Selected as a winner</div>
        @endif
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
                    @endif <br>
                </div>
                <div class="col-md-4 col-sm-4">
                    @if (auth()->user()->id == $proposal->user_id)
                    <a href="/{{$proposal->file_path}}">Download My Attachiment</a>
                    @endif
                    <a href="/{{$proposal->notice->file_path}}">Download Bid Document</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    {{$proposals->links()}}
    @else
    @if (auth()->user()->is_pt)
    <p>No assessed proposals found</p>
    @else
    <p>No winner proposals found</p>
    @endif
    @endif
</div>
@endsection
