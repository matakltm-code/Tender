@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Create Post</h1>
    <form action="/posts" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="title" class="col-12 col-form-label">Title</label>
            <div class="col-12">
                <input value="{{ old('title') }}" id="title" name="title" placeholder="Enter title"
                    class="form-control  @error('title') is-invalid @enderror" type="text">
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="editor" class="col-12 col-form-label">Description</label>
            <div class="col-12">
                <textarea name="body" class="editor" rows="10" value="{!! old('body') !!}"></textarea>
            </div>
            @error('body')
            <span class="text-danger pl-3" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="input-group row p-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Image File</span>
            </div>
            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" id="inputGroupFile01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
            @error('file')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group row">
            <div class="col-12">
                <button name="submit" type="submit" class="btn btn-primary">Create Post</button>
            </div>
        </div>
    </form>
</div>
@endsection
