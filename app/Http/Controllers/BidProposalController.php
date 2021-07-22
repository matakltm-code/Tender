<?php

namespace App\Http\Controllers;

use App\Models\BidProposal;
use Illuminate\Http\Request;

class BidProposalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // My Bidding Tab For bi user types
    public function index()
    {
        $user_type = auth()->user()->user_type;
        $user_id = auth()->user()->id;

        if (!in_array($user_type, ['bi'])) {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        $proposals = BidProposal::where('user_id', $user_id)->orderBy('created_at', 'desc')->paginate(10);

        return view('proposals.index')->with('proposals', $proposals);
    }

    // My Bidding Tab For bi user types
    public function winner_index()
    {
        $user_type = auth()->user()->user_type;

        if (!in_array($user_type, ['bi', 'pt', 'casher'])) {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        $proposals = BidProposal::where('winner_pt_status', true)->orderBy('created_at', 'desc')->paginate(10);

        return view('proposals.winners')->with('proposals', $proposals);
    }

    // My Bidding Tab For bi user types
    public function choose_winner_index()
    {
        $user_type = auth()->user()->user_type;

        if (!in_array($user_type, ['pt'])) {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        $proposals = BidProposal::where('assessed_pac_status', true)->orderBy('created_at', 'desc')->paginate(10);

        return view('proposals.winners')->with('proposals', $proposals);
    }

    // For pac user types
    // Not approved bid proposal
    public function assesse_index()
    {
        $user_type = auth()->user()->user_type;
        if (!in_array($user_type, ['pac'])) {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        $proposals = BidProposal::where('is_pac_evaluated', false)->orderBy('created_at', 'desc')->paginate(10);

        return view('proposals.index')->with('proposals', $proposals);
    }
    // Approved bid proposal and sent to pt user to notify the winner
    public function assessed_index()
    {
        $user_type = auth()->user()->user_type;
        if (!in_array($user_type, ['pac'])) {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        $proposals = BidProposal::where('is_pac_evaluated', true)->orderBy('created_at', 'desc')->paginate(10);

        return view('proposals.index')->with('proposals', $proposals);
    }


    public function confirm_winner_pt_status(BidProposal $proposal)
    {
        $proposal->update([
            'winner_pt_status' => true,
        ]);
        return back()->with('success', 'Winner selected for this notice.');
    }

    public function approve_assessed_pac_status(BidProposal $proposal)
    {
        $proposal->update([
            'assessed_pac_status' => true,
            'is_pac_evaluated' => true,
        ]);
        return back()->with('success', 'User attachiment/documents confirmed for bidding.');
    }

    public function dis_approve_assessed_pac_status(BidProposal $proposal)
    {
        $proposal->update([
            'assessed_pac_status' => false,
            'is_pac_evaluated' => true,
        ]);
        return back()->with('success', 'User attachiment/documents is disqulaified for bidding.');
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BidProposal  $bidProposal
     * @return \Illuminate\Http\Response
     */
    public function show(BidProposal $bidProposal)
    {
        $user_type = auth()->user()->user_type;
        if (!in_array($user_type, ['bi', 'pac', 'pt', 'casher'])) {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }

        // check if the bidder is only see his/her proposal
        if ($user_type == 'bi') {
            $user_id = auth()->user()->id;
            if ($bidProposal->user_id != $user_id) {
                return redirect('/')->with('error', 'Your are not allowed to see this page');
            }
        }

        // dd($bidProposal);
        return view('proposals.show')->with('proposal', $bidProposal);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BidProposal  $bidProposal
     * @return \Illuminate\Http\Response
     */
    public function edit(BidProposal $bidProposal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BidProposal  $bidProposal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BidProposal $bidProposal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BidProposal  $bidProposal
     * @return \Illuminate\Http\Response
     */
    public function destroy(BidProposal $bidProposal)
    {
        //
    }
}
