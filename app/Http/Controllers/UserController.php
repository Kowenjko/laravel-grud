<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|min:4',
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        Auth::login($user);


        return redirect('/')->with('success', 'Registration successful!');
    }
    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'login_name' => 'required',
            'login_password' => 'required',
        ]);

        if (Auth::attempt(['name' => $incomingFields['login_name'], 'password' => $incomingFields['login_password']])) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'You are now logged in!');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'You have been logged out.');
    }
}
