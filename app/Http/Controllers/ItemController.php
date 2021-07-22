<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!in_array(auth()->user()->user_type, ['pd'])) {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        $items = Item::where('quantity', '>', 0)->orderBy('created_at', 'desc')->paginate(10);
        return view('items.index')->with('items', $items);
    }

    public function create()
    {
        if (!in_array(auth()->user()->user_type, ['pd'])) {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        return view('items.create');
    }

    public function store(Request $request)
    {
        if (!in_array(auth()->user()->user_type, ['pd'])) {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        $data = $this->validate($request, [
            'name' => 'required',
            'quantity' => 'required|integer',
        ]);

        Item::create($data);

        return redirect('/items')->with('success', 'Post Created');
    }

    public function update_quantity(Request $request)
    {
        if (!in_array(auth()->user()->user_type, ['pd'])) {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        $data = $this->validate($request, [
            'item_id' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

        // Item::create($data);
        $item = Item::find($data['item_id']);

        $item->quantity = $data['quantity'];

        $item->save();

        return back()->with('success', 'Quantity Updated');
    }

    public function delete_item(Request $request)
    {
        if (!in_array(auth()->user()->user_type, ['pd'])) {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }
        $data = $this->validate($request, [
            'item_id' => 'required|integer',
        ]);

        // Item::create($data);
        $item = Item::find($data['item_id']);

        $item->delete();

        return back()->with('success', 'Item Deleted');
    }
}
