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
                            <h4 class="font-weight-bold">
                                {{ $user->is_admin ? 'Admin - ':'' }}
                                {{ $user->is_counselor ? 'Counselor - ':'' }}
                                {{ $user->is_student ? 'Student - ':'' }}
                                User Profile
                            </h4>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="h5 pb-1">
                                First Name: {{ $user->fname }}
                            </p>
                            <p class="h5 pb-1">
                                Last Name: {{ $user->lname }}
                            </p>
                            <p class="h5 pb-1">
                                Sex: {{ $user->sex }}
                            </p>
                            <p class="h5 pb-1">
                                Username: {{ $user->username }}
                            </p>
                            <p class="h5 pb-1">
                                Email: {{ $user->email }}
                            </p>
                            <p class="h5 pb-1">
                                Phone: {{ $user->phone }}
                            </p>

                            <p class="h5 pb-1">
                                Account status: {{ ($user->active_account == true ? 'Active' : 'Disabled') }}
                            </p>
                            <p class="h5 pb-1">
                                User Type: {{ $user->account_type_text($user->user_type) }}
                            </p>
                            <p class="h5 pb-1">
                                Account created at: {{ $user->created_at->diffForHumans() }}
                            </p>
                            <p class="h5 pb-1">
                                Last logged in: {{ \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() }}
                            </p>

                        </div>
                    </div>
                    @if ($user->is_counselor)
                    <hr>
                    <p class="font-weight-bold h4">Your Counselling Specialty</p>
                    <div class="row">
                        @if ($user->specialty->detail != '')
                        <div class="h4 b col-12">Title</div>
                        <div class="col-12 mb-2">{!! $user->specialty->title ?? '-' !!}</div>
                        <div class="h4 b col-12">Detail</div>
                        <div class="col-12">{!! $user->specialty->detail ?? '-' !!}</div>
                        <div class="row">
                            <a href="/profile/edit/specialty" class="btn btn-warning btn-md ml-5">Edit Specialty
                                Detail</a>
                        </div>
                        @else
                        <div class="alert alert-danger b w-100" role="alert">
                            Please add your counselling specialty. So to add <a href="/profile/edit/specialty"
                                class="btn btn-link btn-sm">Click Me</a>
                        </div>
                        @endif
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
