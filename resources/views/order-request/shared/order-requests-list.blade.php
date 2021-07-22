@if ($orderRequests->count() > 0)
@foreach ($orderRequests as $request)
<div class="card mb-3">
    <div class="card-header py-1 text-capitalize d-flex justify-content-between">
        <div>
            {{ $request->user->fname . ' ' . $request->user->lname }} - {{ $request->created_at }}
        </div>
        <div>
            <a href="/requests/{{ $request->id }}" class="btn btn-sm btn-link">Show Detail</a>
        </div>
    </div>

    <div class="card-body d-flex">
        <div class="col-md-6">
            <p class="b d-flex flex-column">
                <small>Request From</small>
                <span class="font-weight-bold">{{ $request->user->fname . ' ' . $request->user->lname }}</span>
                <span class="font-weight-bold">{{ $request->user->sex }}</span>
                <span class="font-weight-bold">{{ $request->user->phone }}</span>
                <span class="font-weight-bold">{{ $request->user->email }}</span>

            </p>
        </div>
        <div class="col-md-6">
            <div class="d-flex flex-column">
                <span class="badge @if($request->pd_status) badge-success @else badge-secondary @endif my-2 p-2">
                    Property Department Status - @if($request->pd_status) Approved @else Pending @endif
                </span>
                <span class="badge @if($request->casher_status) badge-success @else badge-secondary @endif my-2 p-2">
                    Casher Status - @if($request->casher_status) Approved @else Pending @endif
                </span>
                <span class="badge @if($request->sd_status) badge-success @else badge-secondary @endif my-2 p-2">
                    Scientific Director Status - @if($request->sd_status) Approved @else Pending @endif
                </span>
            </div>
        </div>

    </div>
</div>
@endforeach
<div class="mt-2">
    {{ $orderRequests->links() }}
</div>
@else
<div class="alert alert-danger pt-3 font-weight-bold" role="alert">
    <p>There is no any requests available yet!</p>
</div>
@endif
