<?php

namespace App\Http\Controllers;

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
        return view('order-request.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'file' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if ($request->hasFile('file')) {
            $image_path = 'storage/' . $request->file->store('uploads', 'public');
        } else {
            $image_path = null;
        }

        // Create Post
        $post = new Notice;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->image_path = $image_path;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }

    public function show(Notice $notice)
    {
        return view('posts.show')->with('notice', $notice);
    }

    public function edit(Notice $notice)
    {
        // Check for correct user
        if (auth()->user()->id !== $notice->user_id) {
            return redirect('/notices')->with('error', 'Unauthorized Page');
        }

        return view('notices.edit')->with('notice', $notice);
    }

    public function update(Request $request, Notice $notice)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'file' => 'image|nullable|max:1999'
        ]);
        // Handle File Upload
        if ($request->hasFile('file')) {
            // Check if there is any before uploaded image
            if ($notice->image_path != null) {
                // Delete Image
                Storage::delete($notice->image_path);
            }
            $image_path = 'storage/' . $request->file->store('uploads', 'public');
        } else {
            $image_path = null;
        }


        // Update notice
        $notice->title = $request->input('title');
        $notice->body = $request->input('body');
        $notice->image_path = $image_path;
        $notice->save();

        return redirect('/notices')->with('success', 'notice Updated');
    }

    public function destroy(Notice $notice)
    {
        // Check for correct user
        if (auth()->user()->id !== $notice->user_id) {
            return redirect('/notices')->with('error', 'Unauthorized Page');
        }

        if ($notice->image_path != null) {
            // Delete Image
            Storage::delete($notice->image_path);
        }

        $notice->delete();
        return redirect('/notices')->with('success', 'notice Removed');
    }
}
