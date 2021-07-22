@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between">
            <p class="h5">Requests</p>
            @if (auth()->user()->is_pr)
            <div>
                <a href="/requests/create" class="btn btn-link">+ Add Request</a>
            </div>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('order-request.shared.order-requests-list')
        </div>
    </div>
</div>
@endsection
