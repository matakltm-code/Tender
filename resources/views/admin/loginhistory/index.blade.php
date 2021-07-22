@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Users login history') }}</div>

                <div class="card-body">
                    <p>Last logged in of 10 users</p>
                    {{-- </div> --}}
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Account Type</th>
                                <th scope="col">Created</th>
                                <th scope="col">Last Logged In</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($users->count() > 0)
                            @foreach ($users as $user)
                            {{-- hide disable and not active user --}}
                            @if (env('ADMIN_CAN_DELETE_USER_NOT_ENABLE_OR_DISABLE'))
                            @if ($user->active_account)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td class="text-capitalize">{{ $user->fname }}</td>
                                <td class="text-capitalize">{{ $user->lname }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->account_type_text($user->user_type) }}</td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() }}</td>
                                <td>
                                    {{-- Enable or disable by post request to /account/enable-disable --}}
                                    <form method="POST" action="/account/enable-disable">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <input type="hidden" name="status" value="{{ $user->active_account }}">
                                        @if ($user->active_account)
                                        <button type="submit" class="btn btn-danger">
                                            @if(env('ADMIN_CAN_DELETE_USER_NOT_ENABLE_OR_DISABLE')) {{ __('Delete') }}
                                            @else {{ __('Disable') }}@endif
                                        </button>
                                        @else
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Enable') }}
                                        </button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                            @endif
                            @elseif(!env('ADMIN_CAN_DELETE_USER_NOT_ENABLE_OR_DISABLE'))
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td class="text-capitalize">{{ $user->fname }}</td>
                                <td class="text-capitalize">{{ $user->lname }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->account_type_text($user->user_type) }}</td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() }}</td>
                                <td>
                                    {{-- Enable or disable by post request to /account/enable-disable --}}
                                    <form method="POST" action="/account/enable-disable">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <input type="hidden" name="status" value="{{ $user->active_account }}">
                                        @if ($user->active_account)
                                        <button type="submit" class="btn btn-danger">
                                            @if(env('ADMIN_CAN_DELETE_USER_NOT_ENABLE_OR_DISABLE')) {{ __('Delete') }}
                                            @else {{ __('Disable') }}@endif
                                        </button>
                                        @else
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Enable') }}
                                        </button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                            @endif

                            @endforeach

                            @else
                            <tr>
                                <th colspan="9">There is no any user added</th>
                            </tr>
                            @endif


                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
