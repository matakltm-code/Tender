{{-- @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif --}}

@if(session('success'))
<div class="container">
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <b>{!! session('success') !!}</b>
    </div>
</div>
@endif

@if(session('error'))
<div class="container">
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! session('error') !!}
    </div>
</div>
@endif
