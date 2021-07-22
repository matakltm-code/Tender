<div class="row mt-3 mb-4">
    {{-- Display status if the user is bi user_type --}}
    @if (auth()->user()->is_bi)

    {{-- If this proposal is a winner --}}
    @if ($proposal->winner_pt_status)
    <div class="col-md-12">
        <div class="alert alert-success" role="alert"><strong>
                <h5>Congratulations</h5> Your bid proposal is selected.
                <p>We will contact you as soon as posible!</p>
                <p>Thank you!</p>
            </strong>
        </div>
    </div>
    @else
    {{-- if this is not a winner or under proccess show them a status of thier bid proposal status --}}
    <div class="col-md-12">
        {{-- Proposal submitted --}}
        <div class="alert alert-info" role="alert">
            <strong>
                <h5>Step 1</h5> Proposal Submited
            </strong>
        </div>

        {{-- your documment is under assessed --}}
        @if ($proposal->assessed_pac_status)
        <div class="alert alert-success" role="alert"><strong>
                <h5>Step 2</h5> File successfuly assessed
            </strong>
        </div>

        <div class="alert alert-warning" role="alert"><strong>
                <h5>Step 3</h5> Bid winner is under review please frequently check the winners tab
            </strong>
        </div>
        @elseif (!$proposal->assessed_pac_status)
        <div class="alert alert-danger" role="alert">
            <strong>
                <h5>Sorry</h5> Your attachiment file is disqualified for bidding.
            </strong>
        </div>
        @else
        <div class="alert alert-warning" role="alert">
            <strong>
                <h5>Step 2</h5> Your attachiment file is under review
            </strong>
        </div>
        @endif
    </div>
    {{-- ./@if ($proposal->winner_pt_status) --}}
    @endif
    {{-- ./@if (auth()->user()->is_bi) --}}
    @endif

    <div class="col-md-12">
        <p class="h4 text-center font-weight-bold">
            Bidding Info
        </p>
    </div>

    <div class="col-md-12">
        <div class="card p-3">
            <div class="d-flex flex-column">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <p><strong>Initial Payment:</strong> {{ $proposal->initial_payment }}</p>
                    </div>
                    <div>
                        @if (auth()->user()->is_pac)
                        <a class="btn btn-sm btn-success" href="/{{$proposal->file_path}}">Download User Attachment
                            File</a>
                        @else
                        @if (auth()->user()->id == $proposal->user_id)
                        <a class="btn btn-sm btn-success" href="/{{$proposal->file_path}}">Download My Attachment
                            File</a>
                        @endif

                        @endif
                    </div>
                </div>
                <div>
                    <p><strong>Your Advantage</strong></p>
                </div>
                <div>{!! $proposal->bid_advantage !!}</div>

            </div>
        </div>
    </div>

</div>
