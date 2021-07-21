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
                            <h4>Edit Your Profile</h4>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="/profile/{{ $user->id }}">
                                @csrf
                                @method('PATCH')
                                <div class="form-group row">
                                    <label for="fname" class="col-4 col-form-label">First Name</label>
                                    <div class="col-8">
                                        <input value="{{ old('fname') ?? $user->fname }}" id="fname" name="fname"
                                            placeholder="First Name"
                                            class="form-control  @error('fname') is-invalid @enderror" type="text"
                                            autofocus>
                                        @error('fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lname" class="col-4 col-form-label">Last Name</label>
                                    <div class="col-8">
                                        <input value="{{ old('lname') ?? $user->lname }}" id="lname" name="lname"
                                            placeholder="First Name"
                                            class="form-control  @error('lname') is-invalid @enderror" type="text">
                                        @error('lname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="sex" class="col-4 col-form-label">{{ __('Sex') }}</label>

                                    <div class="col-8">
                                        <select name="sex" id="sex"
                                            class="form-control @error('sex') is-invalid @enderror">
                                            <option value="F" @if (old('sex')=='F' ) selected="selected" @endif>Femal
                                            </option>
                                            <option value="M" @if (old('sex')=='M' ) selected="selected" @endif>Male
                                            </option>
                                        </select>
                                        @error('sex')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone" class="col-4 col-form-label">Phone</label>
                                    <div class="col-8">
                                        <input value="{{ old('phone') ?? $user->phone }}" id="phone" name="phone"
                                            placeholder="phone"
                                            class="form-control  @error('phone') is-invalid @enderror" type="text">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="username" class="col-4 col-form-label">{{ __('Userame') }}</label>

                                    <div class="col-8">
                                        <input id="username" type="text"
                                            class="form-control @error('username') is-invalid @enderror" name="username"
                                            value="{{ old('username') ?? $user->username }}" required
                                            autocomplete="username">

                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-4 col-form-label">Email</label>
                                    <div class="col-8">
                                        <input value="{{ old('email') ?? $user->email }}" id="email" name="email"
                                            placeholder="Email"
                                            class="form-control  @error('email') is-invalid @enderror"
                                            required="required" type="email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="offset-4 col-8">
                                        <button name="submit" type="submit" class="btn btn-primary">Update My
                                            Profile</button>
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
