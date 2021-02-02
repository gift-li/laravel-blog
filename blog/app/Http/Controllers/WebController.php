<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // Ques: use 'Auth:attempt' to login & block suspend account('status' != 0)
        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => [User::ROLE_ADMIN, User::ROLE_USER]
        ])){
            return redirect()->route('web.index');
        }
        return redirect()->route('web.signin')->withErrors('輸入帳號密碼有誤!');
    }
    
    public function logout() {
        Auth::logout();
        return redirect()->route('web.index');
    }

    public function suspend(User $user) {
        if (Gate::allows(Auth::user()->role)){
            $user = User::find($user->id);
            $user->update([
                'role' => User::ROLE_SUSPEND
            ]);
        }
        return redirect()->route('user.index');
    }
}
