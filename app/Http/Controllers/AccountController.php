<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


use Carbon\Carbon;

class AccountController extends Controller
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
        // Check user is admin
        if (auth()->user()->user_type != 'admin') {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }

        return view('admin.account.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'sex' => ['required', 'max:1'],
            'phone' => ['required', 'max:15'],
            'user_type' => ['required'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
        // dd($data);
        User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'sex' => $data['sex'],
            'phone' => $data['phone'],
            'user_type' => $data['user_type'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'last_login_at' => Carbon::now()->toDateTimeString()
        ]);



        return redirect('/account')->with('success', 'Account created successfuly!');
    }



    public function login_history()
    {
        // Check user is admin
        if (auth()->user()->user_type != 'admin') {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }

        $users = User::orderBy('last_login_at', 'DESC')->paginate(10);
        return view('admin.loginhistory.index', [
            'users' => $users
        ]);
    }

    public function enable_disable_account(Request $request)
    {
        // Check user is admin
        if (auth()->user()->user_type != 'admin') {
            return redirect('/')->with('error', 'Your are not allowed to see this page');
        }

        $user_id = $request['user_id'];
        $status = $request['status'];
        $message = '';
        if ($status) {
            $status = false;
            $message = env('ADMIN_CAN_DELETE_USER_NOT_ENABLE_OR_DISABLE') ? 'User account Deleted' : 'User account Disabled';
        } else {
            $status = true;
            $message = env('ADMIN_CAN_DELETE_USER_NOT_ENABLE_OR_DISABLE') ? 'User account Restored' : 'User account Enabled';
        }
        $data = [
            'active_account' => $status
        ];

        User::where('id', $user_id)->update($data);
        return back()->with('success', $message);
    }
}
