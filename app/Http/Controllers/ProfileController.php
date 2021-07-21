<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::findorfail(auth()->user()->id);
        return view('profile.index', [
            'user' => $user
        ]);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }


    public function edit()
    {
        // ProfileController::checkIfItsMe($user->id);

        $user = User::findorfail(auth()->user()->id);
        return view('profile.edit', [
            'user' => $user
        ]);
    }

    public function update(User $user)
    {
        // ProfileController::checkIfItsMe($user->id);

        $data = request()->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'sex' => ['required', 'max:1'],
            'phone' => ['required', 'max:15'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
        // dd($data);
        User::where('id', auth()->user()->id)->update($data);
        return redirect('/profile')->with('success', 'Profile updated successfuly!');
    }

    public function edit_specialty()
    {
        // Check user is admin
        if (!auth()->user()->is_counselor) {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }

        $user = User::findorfail(auth()->user()->id);
        return view('profile.edit-specialty', [
            'user' => $user
        ]);
    }

    public function update_specialty(User $user)
    {
        // $data = request()->validate([
        //     'title' => ['required', 'string', 'min:5'],
        //     'detail' => ['required', 'min:15'],
        // ]);
        // Counselorspecialty::where('user_id', auth()->user()->id)->update($data);
        // return back()->with('success', 'Profile specialty detail updated successfuly!');
    }


    public function destroy(User $user)
    {
        //
    }
}
