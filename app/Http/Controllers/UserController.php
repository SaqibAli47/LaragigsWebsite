<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show Register Create Form
    public function create(){
        return view('users.register');
    }

    // Create New Users
    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create User
        $user = User::create($formFields);

        // Login
        auth()->login($user);
        return redirect('/')->with('message', 'User Created and Loggedin');

    }

    // logout user
    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'You have been logged out');
    }

    // Show Login Form
    public function login(){
        return view('users.login');
    }

    // Authenticate users
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        // attempt statment if users auth
        if(auth()->attempt($formFields)){
            // regenrate session id
            $request->session()->regenerate();
            // redirect
            return redirect('/')->with('message', 'You are now Logged In!');
        }
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

}
