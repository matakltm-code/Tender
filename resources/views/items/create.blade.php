@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Add Item</h1>
    <form action="/items" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-12 col-form-label">Item Name</label>
            <div class="col-12">
                <input value="{{ old('name') }}" id="name" name="name" placeholder="Enter name"
                    class="form-control  @error('name') is-invalid @enderror" type="text">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="quantity" class="col-12 col-form-label">Item Quantity</label>
            <div class="col-12">
                <input value="{{ old('quantity') }}" id="quantity" name="quantity" placeholder="Enter quantity"
                    class="form-control  @error('quantity') is-invalid @enderror" type="number">
                @error('quantity')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>


        <div class="form-group row">
            <div class="col-12">
                <button name="submit" type="submit" class="btn btn-primary">Add Item</button>
            </div>
        </div>
    </form>
</div>
@endsection
