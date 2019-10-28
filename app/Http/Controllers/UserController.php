<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //
        $role_id = 4;
        $users = User::with('role')->get()->where('role_id', $role_id);
        return view('users/index')->with('users', $users);
    }

    public function admins()
    {
        //
        $role_id = 2;
        $users = User::with('role')->get()->where('role_id' , $role_id);
        return view('users/admins')->with('users', $users);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $first_name =  $request->input('fname');
        $last_name  = $request->input('lname');
        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');

        $admin = User::create([
            'fname' => $first_name,
            'lname' => $last_name,
            'email' => $email,
            'role_id' => 2,
            'password' => Hash::make($password),
            'username' => $username,

        ]);

        if($admin){
            return redirect()->route('admins')->with('success', 'New admin has been successfully added.');
        }
        return back()->withInput()->with('danger', 'Error adding a new admin.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        
    }
}
