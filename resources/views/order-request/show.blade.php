@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <div>
            <h1>{{$request->user->fname . ' ' . $request->user->lname}}</h1>
        </div>
        <div>
            @if (!auth()->user()->is_pt)
            <a href="/requests" class="btn btn-link btn-sm">Go Back</a>
            @endif
        </div>
    </div>

    <div>
        {!!$request->request_form_detail!!}
    </div>
    <hr>
    <small>Written on {{$request->created_at}}</small>
    <hr>
    @include('order-request.shared.footer-for-show')
</div>
@endsection
