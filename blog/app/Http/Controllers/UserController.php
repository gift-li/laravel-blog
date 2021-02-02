<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Remember to add Auth class
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
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
            return view('user.show')->withUsers(User::find(Auth::id()));
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
            'role' => User::ROLE_USER
        ]);
        if ($this->authorize('create', Auth::user())){
            $user['role'] = User::ROLE_ADMIN;
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
