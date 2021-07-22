@extends('layouts.app')

@section('content')
<div class="container mb-4">
    <div class="d-flex justify-content-between">
        <h1>{{$proposal->notice->title}}</h1>
        @if (auth()->user()->is_pac)
        @if ($proposal->is_pac_evaluated)
        <a href="#" class="btn btn-primary btn-md disabled" role="button" aria-disabled="true">
            Document Evaluated as <br>
            @if ($proposal->assessed_pac_status) Confirmed @else Disqualified @endif
        </a>
        @else
        <div class="d-flex">
            <div>
                <form method="post" action="/proposal/approve_assessed_pac_status/{{$proposal->id}}">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">
                        Confirm Bider Documents
                    </button>
                </form>
            </div>
            <div>
                <form method="post" action="/proposal/dis_approve_assessed_pac_status/{{$proposal->id}}">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm ml-2">
                        Disqualify Bider Documents
                    </button>
                </form>
            </div>
        </div>
        @endif
        @else
        {{-- Notify the winner --}}
        @if (auth()->user()->is_pt)
        <form method="post" action="/proposal/confirm_winner_pt_status/{{$proposal->id}}">
            @csrf
            <button type="submit" class="btn btn-success btn-sm">
                Confirm Winner and<br>
                Notify The Bidder
            </button>
        </form>
        @else
        <a href="/proposals" class="btn btn-link btn-sm">Go Back</a>
        @endif
        @endif
    </div>
    <hr>
    <div class="d-flex justify-content-between">
        <div>
            <small>Written on {{$proposal->notice->created_at}} by
                {{$proposal->notice->user->fname . ' ' . $proposal->notice->user->lname}}</small>
        </div>
        <div>
            <a class="btn btn-success btn-sm" href="/{{$proposal->notice->file_path}}">Download Bid Document</a>
        </div>
    </div>
    <hr>
    <div>
        {!!$proposal->notice->notice_detail!!}
    </div>


    {{-- This is private info so display only for the user --}}
    @if (auth()->user()->id == $proposal->user_id)
    {{-- Display Bidders Bidding Proposal Form inpute values --}}
    @include('proposals.forms.bidding-info')
    @elseif (auth()->user()->is_pac)
    @include('proposals.forms.bidding-info')
    @elseif (auth()->user()->is_pt)
    @include('proposals.forms.bidding-info')
    @endif
</div>
@endsection
