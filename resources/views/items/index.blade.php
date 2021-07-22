@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <h1>Items</h1>
        <a href="/items/create" class="btn btn-link btn-sm">Add new item</a>
    </div>

    <div class="card p-0 m-0">
        <div class="card-header">List of items</div>

        <div class="card-body p-0 m-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Time</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($items->count() > 0)
                    @foreach ($items as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td class="text-capitalize">{{ $item->name }}</td>
                        <td class="text-capitalize">{{ $item->quantity }}</td>
                        <td>
                            <div>Updated at: {{ $item->updated_at }}</div>
                            <div>Created at: {{ $item->created_at }}</div>
                        </td>
                        <td class="d-flex justify-content-between">
                            <div>
                                <form method="POST" action="/items/update-quantity">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <input type="number" name="quantity" class="form-control">
                                    <button type="submit" class="btn btn-primary btn-sm mt-1">
                                        Update
                                    </button>
                                </form>
                            </div>

                            <div>
                                <form method="POST" action="/items/delete-item">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <button type="submit" class="btn btn-danger btn-sm mt-1">
                                        Delete Item
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    @endforeach

                    @else
                    <tr>
                        <th colspan="5">There is no any item added</th>
                    </tr>
                    @endif


                </tbody>
            </table>
        </div>
    </div>

    {{$items->links()}}
</div>
@endsection
