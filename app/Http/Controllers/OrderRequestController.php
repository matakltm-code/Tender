<?php

namespace App\Http\Controllers;

use App\Models\OrderRequest;
use Illuminate\Http\Request;

class OrderRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_type = auth()->user()->user_type;

        if (!in_array($user_type, ['pr', 'pd', 'casher', 'sd'])) {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        $orderRequests = OrderRequest::orderBy('created_at', 'desc')->paginate(10);
        // Pending request for pd
        if ($user_type == 'pd') {
            $orderRequests = OrderRequest::where('pd_status', false)->orderBy('created_at', 'desc')->paginate(10);
        }
        // Pending request for casher
        if ($user_type == 'casher') {
            $orderRequests = OrderRequest::where('casher_status', false)->orderBy('created_at', 'desc')->paginate(10);
        }
        // Filter request order for sd user type
        if ($user_type == 'sd') {
            $orderRequests = OrderRequest::where('pd_status', true)->where('casher_status', true)->where('sd_status', false)->orderBy('created_at', 'desc')->paginate(10);
        }

        return view('order-request.index', [
            'orderRequests' => $orderRequests,
        ]);
    }

    public function index_approved()
    {
        if (!in_array(auth()->user()->user_type, ['pt', 'sd'])) {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }

        $orderRequests = OrderRequest::where('pd_status', true)->where('casher_status', true)->where('sd_status', true)->orderBy('created_at', 'desc')->paginate(10);

        return view('order-request.index', [
            'orderRequests' => $orderRequests,
        ]);
    }

    public function create()
    {
        return view('order-request.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'user_id' => 'required|integer',
            'sender_user_type' => 'required',
            'request_form_detail' => 'required'
        ]);

        // Create Post
        OrderRequest::create($data);

        return redirect('/requests')->with('success', 'Request created');
    }

    public function show(OrderRequest $request)
    {
        return view('order-request.show')->with([
            'request' => $request
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderRequest  $orderRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderRequest $orderRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderRequest  $orderRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderRequest $orderRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderRequest  $orderRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderRequest $request)
    {
        // Check for correct user
        // dd($request->user_id . ' - ' . auth()->user()->id);
        if (auth()->user()->id != $request->user_id) {
            return redirect('/requests')->with('error', 'Unauthorized action');
        }


        $request->delete();
        return redirect('/requests')->with('success', 'Request Removed');
    }


    public function pd_approve(OrderRequest $request)
    {
        $request->update([
            'pd_status' => true
        ]);
        return redirect('/requests')->with('success', 'Request Updated');
    }
    public function casher_approve(OrderRequest $request)
    {
        $request->update([
            'casher_status' => true
        ]);
        return redirect('/requests')->with('success', 'Request Updated');
    }
    public function sd_approve(OrderRequest $request)
    {
        $request->update([
            'sd_status' => true
        ]);
        return redirect('/requests')->with('success', 'Request Updated');
    }
}
