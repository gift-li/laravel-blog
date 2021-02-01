<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Remember to add Auth class
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function getSignup() {
        return view('user.signup');
    }

    public function postSignup(Request $request){
        $this->validate($request, [
            'name' => 'required|string|unique:users',
            'email' => 'required|email|unique:users', // Email type is better
            'password' => 'string|min:4'
        ]);

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'status' => '1'
        ]);
        $user->save();
        Auth::login($user);

        return redirect()->route('post.index');
    }

    public function getSignin(Request $request){
        return view('user.signin');
    }

    public function postSignin(Request $request){
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'string|min:4'
        ]);
        // Better way to perform your code
        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ])){
            return redirect()->route('post.index');
        }
        return redirect()->route('post.index');
    }
    
    //  Be careful of the name
    public function logout() {
        Auth::logout();
        // return redirect()->back(); // Be careful of the routes you set to redirect
        return redirect()->route('post.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->authorize('viewAny', Auth::user())){ // If not admin, this throws 403 error. The way to implementation this function should be reconstruct.
            // return redirect()->route('user.index'); // You fall into an infinite loop.
            return view('user.index')->withUsers(User::all()->sortByDesc('id'));
        }else if ($this->authorize('view', Auth::user())){
            return view('user.show')->withUser(User::find(Auth::id()));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:users', // Is this needed to be unique
            'email' => 'required|string|unique:users',
            'password' => 'required|string|min:4' // Required
        ]);
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'status' => '2'
        ]);
        if ($this->authorize('create', Auth::user())){
            $user['status'] = 1;
            $user->save();
        }else {
            $user->save();
        }

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if ($this->authorize('view', Auth::user())){
            return view('user.show')->withUser($user);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if ($this->authorize('view', Auth::user())){
            return view('user.edit')->withUser($user);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|string', // Is this needed to be unique
            'email' => 'required|string',
            'password' => 'required|string|min:4' // Required
        ]);

        if ($this->authorize('update', Auth::user())){
            $user['name'] = $request->input('name');
            $user['email'] = $request->input('email');
            $user['password'] = bcrypt($request->input('password'));
            $user->save();
        }

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $deleteUser)
    {
        if ($this->authorize('delete', Auth::user())){
            $deleteUser->delete();
        }
        return redirect()->route('user.index');
    }
}
