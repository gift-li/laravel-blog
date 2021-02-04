<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Remember to add Auth class
use Illuminate\Support\Facades\Gate;
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
        if (Gate::allows('admin')){ // If not admin, this throws 403 error. The way to implementation this function should be reconstruct.
            // return redirect()->route('user.index'); // You fall into an infinite loop.
            return view('user.index')->withUsers(User::all()->sortByDesc('id'));
        }else if (Gate::allows('user')){
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
            'role' => User::ROLE_USER
        ]);
        if (Gate::allows('admin')){
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
        // Ques: 以下作法403，檢查過policy、參數、dd()，都正常卻無法正常運作
        //      if ($this->authorize('view', Auth::user())){
        if (Gate::allows('user')){
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
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string|min:4'
        ]);

        if (Gate::allows('user')){
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
    public function destroy(User $user)
    {
        if (Gate::allows('user')){
            $user->delete();
        }
        return redirect()->route('user.index');
    }
    
    // Ques: 'role' of the user->id model cannot be update
    // status: $user is an empty User instance
    //     which means the parameter passed from View('user.index')->停權btn isn't successful; 
    public function suspend(Request $request, User $user) {
        if (Gate::allows('admin')){
            User::find($user->id)->update([
                'role' => User::ROLE_SUSPEND
            ]);
        }
        return redirect()->route('user.index');
    }

    public function restore(Request $request, User $user) {
        if (Gate::allows('admin')){
            User::find($user->id)->update([
                'role' => User::ROLE_USER
            ]);
        }
        return redirect()->route('user.index');
    }
}