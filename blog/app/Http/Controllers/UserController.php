<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function getSignup() {
        return view('user.signup');
    }
    public function postSignup(Request $request){
        $this->validate($request, [
            'name' => 'required|string|unique:users',
            'email' => 'required|string|unique:users',
            'password' => 'string|min:4'
        ]);

        $user = new User([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
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
        if (Auth::attempt(['email' => $request->input('email'),
                        'password' => $request->input('password')])){
            return redirect()->route('post.index');
        }
        return redirect()->back();
    }
    public function logout() {
        Auth::logout();
        return redirect()->back();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->authorize('viewAny', Auth::user())){
            return redirect()->route('user.index');
        }else if ($this->authorize('view', Auth::user())){
            return redirect()->route('user.show', Auth::user());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('user.create');
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
            'name' => 'required|string|unique:users',
            'email' => 'required|string|unique:users',
            'password' => 'string|min:4'
        ]);
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'status' => 2
        ]);
        if ($this->authorize('create', $user)){
            $user['status'] = 1;
            $user->save();
        }else {
            $user->save();
        }

        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if ($this->authorize('view', $user)){
            return redirect()->route('user.show');
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
        if ($this->authorize('view', $user)){
            return redirect()->route('user.show')->withUser($user);
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
        if ($this->authorize('update', $user)){
            if ($this->authorize('viewAny', $user)){
                return redirect()->route('user.index');
            }else if ($this->authorize('view', $user)){                
                return redirect()->route('user.show')->withUser($user);
            }
        }

        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($deleteUser)
    {
        if ($this->authorize('delete', $deleteUser)){
            $deleteUser->delete();
            return redirect()->route('user.index');
        }
        return redirect()->route('user.show');
    }
}
