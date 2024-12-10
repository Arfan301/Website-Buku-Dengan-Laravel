<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            Log::debug('Validation failed: ', $validator->errors()->toArray());

            return redirect()->route('register')
                            ->withErrors($validator)
                            ->withInput();
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);


            return redirect()->route('login')->with('success', 'Registration successful! You can now log in.');
        } catch (\Exception $e) {
            Log::debug('Step 2 failed: Error creating user', ['error' => $e->getMessage()]);
            
            return redirect()->route('register')->with('error', 'Failed to create user');
        }
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|string|min:8',
            ],
            [
                'email.required' => 'Please enter your email address.',
                'email.email' => 'The email must be a valid email address.',
                'password.required' => 'Please enter your password.',
                'password.min' => 'The password must be at least 8 characters.',
            ]
        );
    
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/main');
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ]);
    }

    // logout function here
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
