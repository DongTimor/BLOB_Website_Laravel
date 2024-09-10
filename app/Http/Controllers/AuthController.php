<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(){
        return view('register');
    }

    public function store()
    {

        $validatedData = request()->validate([
            'name' => 'required|string|min:5|max:30',  // Explicitly define 'string' type
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',  // Enforce a minimum password length
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('content.index')->with('success', 'User created successfully.'); // Redirect or return a response
    }

    public function login(){
        return view('login');
    }

// Trong AuthController.php

public function authentication()
{
    $validatedData = request()->validate([
        'email' => 'required|email',
        'password' => 'required|min:8',
    ]);

    if (auth()->attempt($validatedData)) {

        request()->session()->regenerate();
       
        return redirect()->route('content.index')->with('success', 'Logged in successfully.'); // Corrected message
    }

    return redirect()->route('login')->withErrors(['password' => 'Invalid credentials.']); // Corrected message
}


public function logout(){
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('content.index')->with('success', 'Logged out successfully.');
}

}
