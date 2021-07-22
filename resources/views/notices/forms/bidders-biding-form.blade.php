<div class="row mt-3 mb-4">
    {{-- {{ dd($notice->proposal) }} // if there is no any row it will null --}}
    {{-- Check bidder is not summited before now --}}
    @if (!$notice->proposal)
    {{-- @if (!$notice->proposal->exists) --}}
    {{-- Header --}}
    <div class="col-md-12">
        <p class="h4 text-center font-weight-bold">
            Start Bidding
        </p>
    </div>


    {{-- form --}}
    <div class="col-md-12">
        <form action="/submit-notices" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="notice_id" value="{{$notice->id}}">
            <div class="form-group row">
                <label for="initial_payment" class="col-12 col-form-label">Initial Payment</label>
                <div class="col-12">
                    <input value="{{ old('initial_payment') }}" id="initial_payment" name="initial_payment"
                        placeholder="Enter your initial payment"
                        class="form-control  @error('initial_payment') is-invalid @enderror" type="number">
                    @error('initial_payment')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="editor" class="col-12 col-form-label">Bid Advantage</label>
                <div class="col-12">
                    <textarea name="bid_advantage" class="editor" rows="10"
                        value="{!! old('bid_advantage') !!}"></textarea>
                    <small id="passwordHelpBlock" class="form-text text-muted">
                        What is your advantage you give for us? when there is a same/duplicated winner like you!
                    </small>
                </div>
                @error('bid_advantage')
                <span class="text-danger pl-3" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="input-group row p-2">
                <div class="input-group-prepend">
                    <span class="input-group-text">Attach Bid Document</span>
                </div>
                <div class="custom-file">
                    <input type="file" name="file" class="custom-file-input" id="inputGroupFile01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    <small id="passwordHelpBlock" class="form-text text-muted">
                        Attach the file you filled the bid document
                    </small>
                </div>
                @error('file')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group row">
                <div class="col-12">
                    <button name="submit" type="submit" class="btn btn-primary">Submit Proposal</button>
                </div>
            </div>
        </form>
    </div>

    @else

    <div class="col-md-12">
        <div class="alert alert-info d-flex justify-content-between" role="alert">
            <strong>Proposal Submited</strong>
            <a href="/proposals/{{$notice->proposal->id}}">Show Submited Proposal Detail</a>
        </div>
    </div>

    @endif
</div>
