<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Post;
use App\User;

class WebController extends Controller
{
    public function index(){
        return view('web.index')->withPosts(Post::all()->sortByDesc('id'));
    }

    public function getSignup() {
        return view('web.signup');
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
            'role' => User::ROLE_USER
        ]);
        $user->save();
        Auth::login($user);

        return redirect()->route('web.index');
    }

    public function getSignin(Request $request){
        return view('web.signin');
    }

    public function postSignin(Request $request){
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string|min:4'
        ]);

        // Problem: have no idea to make code cleaner
        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => [User::ROLE_ADMIN, User::ROLE_USER]
        ])){
            return redirect()->route('web.index');
        }
        return redirect()->route('web.signin')->withErrors('帳號密碼有誤or帳號已被停權');
    }
    
    public function logout() {
        Auth::logout();
        return redirect()->route('web.index');
    }

    // Ques: 'role' of the user->id model cannot be update
    public function suspend(User $user) {
        if (Gate::allows('admin')){
            User::where('id', $user->id)->update([
                'role' => User::ROLE_SUSPEND
            ]);
        }
        return redirect()->route('user.index');
    }
    public function restore(User $user) {
        if (Gate::allows('admin')){
            User::where('id', $user->id)->update([
                'role' => User::ROLE_USER
            ]);
        }
        return redirect()->route('user.index');
    }
}
