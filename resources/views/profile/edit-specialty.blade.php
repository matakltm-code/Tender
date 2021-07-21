@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 ">
            @include('profile.shared.side-navigation')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Edit Your Counselling Specialty Detail</h4>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="/profile/{{ $user->id }}/specialty">
                                @csrf
                                @method('PATCH')
                                <div class="form-group row">
                                    <label for="title" class="col-12 col-form-label">Title</label>
                                    <div class="col-12">
                                        <input value="{{ old('title') ?? $user->specialty->title }}" id="title"
                                            name="title" placeholder="Enter your specialty title"
                                            class="form-control  @error('title') is-invalid @enderror" type="text"
                                            autofocus>
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="editor" class="col-12 col-form-label">Specialty detail
                                        description</label>

                                    <div class="col-12">
                                        <textarea name="detail" class="editor" id="editor"
                                            value="{!! old('detail') ?? $user->specialty->detail !!}"></textarea>
                                        @error('detail')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>




                                <div class="form-group row">
                                    <div class="offset-4 col-8">
                                        <button name="submit" type="submit" class="btn btn-primary">Update My
                                            Counselling Specialty</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
