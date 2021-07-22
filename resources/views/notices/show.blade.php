@extends('layouts.app')

@section('content')
<div class="container mb-4">
    <div class="d-flex justify-content-between">
        <h1>{{$notice->title}}</h1>
        <a href="/notices" class="btn btn-link btn-sm">Go Back</a>
    </div>
    <hr>
    <div class="d-flex justify-content-between">
        <div>
            <small>Written on {{$notice->created_at}} by
                {{$notice->user->fname . ' ' . $notice->user->lname}}</small>
        </div>
        <div>
            <a class="btn btn-success btn-sm" href="/{{$notice->file_path}}">Download Bid Document</a>
        </div>
    </div>
    <hr>
    <div>
        {!!$notice->notice_detail!!}
    </div>
    <div class="d-flex justify-content-between">
        @if(Auth::user()->id == $notice->user_id)
        <form method="post" action="/notices/{{$notice->id}}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                {{ __('Delete') }}
            </button>
        </form>
        @endif
    </div>


    @if (auth()->user()->is_bi)
    {{-- Bidders Bidding Proposal Form --}}
    @include('notices.forms.bidders-biding-form')
    @endif
</div>
@endsection
