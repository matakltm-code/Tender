@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Create Request</h1>
    <form action="/requests" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="sender_user_type" value="{{ auth()->user()->user_type }}">
        <div class="form-group row">
            <label for="editor" class="col-12 col-form-label">Request detail info</label>
            <div class="col-12">
                <textarea name="request_form_detail" class="editor"
                    value="{!! old('request_form_detail') !!}"></textarea>
            </div>
            @error('request_form_detail')
            <span class="text-danger pl-3" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>


        <div class="form-group row">
            <div class="col-12">
                <button name="submit" type="submit" class="btn btn-primary">Create Request</button>
            </div>
        </div>
    </form>
</div>
@endsection
