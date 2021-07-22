<?php

namespace App\Http\Controllers;

use App\Models\BidProposal;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $notices = Notice::orderBy('created_at', 'desc')->paginate(10);
        return view('notices.index')->with('notices', $notices);
    }

    public function create()
    {
        $user_type = auth()->user()->user_type;

        if (!in_array($user_type, ['pt'])) {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        return view('order-request.create');
    }

    public function store(Request $request)
    {
        $user_type = auth()->user()->user_type;

        if (!in_array($user_type, ['pt'])) {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }

        $this->validate($request, [
            'title' => 'required',
            'notice_detail' => 'required',
            'file' => 'required|file|max:1999'
        ]);

        $file_path = 'storage/' . $request->file->store('uploads', 'public');

        // Create Notice
        $notice = new Notice;
        $notice->user_id = auth()->user()->id;
        $notice->title = $request->input('title');
        $notice->notice_detail = $request->input('notice_detail');
        $notice->file_path = $file_path;
        $notice->save();

        return redirect('/notices')->with('success', 'Notice Created');
    }
    // This is for bidders to submit proposal from the notice detail view
    public function submit_notices_store(Request $request)
    {
        $user_type = auth()->user()->user_type;

        if (!in_array($user_type, ['bi'])) {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }

        $this->validate($request, [
            'notice_id' => 'required|integer',
            'initial_payment' => 'required',
            'bid_advantage' => 'required',
            'file' => 'required|file|max:1999'
        ]);

        $file_path = 'storage/' . $request->file->store('uploads', 'public');

        // Create BidProposal
        $notice = new BidProposal;
        $notice->user_id = auth()->user()->id;
        $notice->notice_id = $request->input('notice_id');
        $notice->initial_payment = $request->input('initial_payment');
        $notice->bid_advantage = $request->input('bid_advantage');
        $notice->file_path = $file_path;
        $notice->save();

        return redirect('/notices')->with('success', 'Proposal submited successfuly. <br/> Please frequently check your "<u><strong>My Biding</strong></u>" tab.');
    }

    public function show(Notice $notice)
    {
        return view('notices.show')->with('notice', $notice);
    }

    public function destroy(Notice $notice)
    {
        // Check for correct user
        if (auth()->user()->id !== $notice->user_id) {
            return redirect('/notices')->with('error', 'Unauthorized Page');
        }

        if ($notice->file_path != null) {
            // Delete File
            Storage::delete($notice->file_path);
        }

        $notice->delete();
        return redirect('/notices')->with('success', 'notice Removed');
    }
}
