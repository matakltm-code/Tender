<div class="d-flex justify-content-between">
    {{-- For Pr User --}}
    @if (auth()->user()->is_pr)
    @if(Auth::user()->id == $request->user_id)

    <form method="post" action="/requests/{{$request->id}}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">
            Delete
        </button>
    </form>
    @endif
    @endif
    {{-- For Pd User --}}
    @if (auth()->user()->is_pd)
    <form method="post" action="/requests/pd/{{$request->id}}">
        @csrf
        <button type="submit" class="btn btn-success btn-md">
            Approve Request
        </button>
    </form>
    @endif
    {{-- For casher User --}}
    @if (auth()->user()->is_casher)
    <form method="post" action="/requests/casher/{{$request->id}}">
        @csrf
        <button type="submit" class="btn btn-success btn-md">
            Approve Request
        </button>
    </form>
    @endif
    {{-- For sd User --}}
    @if (auth()->user()->is_sd)
    @if ($request->sd_status)
    <p class="h5 font-weight-bold px-3 py-2 bg-success text-white">
        Request Approved
    </p>
    @else
    <form method="post" action="/requests/sd/{{$request->id}}">
        @csrf
        <button type="submit" class="btn btn-success btn-md">
            Approve Request
        </button>
    </form>
    @endif
    @endif
</div>
