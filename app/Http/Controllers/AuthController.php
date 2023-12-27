<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Sponsor;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{ // ! reset password, remember on login
    public function __construct()
    {
        $this->middleware('admin')->only(['users', 'update', 'edit']);
        $this->middleware('guest')->except(['logout', 'users', 'profile', 'edit', 'update']);
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function edit(User $user)
    {
        return view('auth.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate(['name' => ['required', 'min:3', 'max:50']]);

        $user->update([
            'name' => $request['name'], 'role' => $request['role'] ?: $user->role,
        ]);

        if (Auth::user()->role == 'sponsor') return redirect()->route('user.show', $user->id);
        else return redirect()->route('user.index');
    }

    public function register(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:5'],
        ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);

        try {
            Mail::to($request['email'])->send(new WelcomeMail());
        } catch (\Exception $e) {
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function users()
    {
        $users = User::paginate(10);
        return view('user.index', compact('users'));
    }

    public function profile(User $user)
    {
        $sponsors = Sponsor::where('user_id', $user->id)->get();
        return view('dashboard.profile', compact('user', 'sponsors'));
    }
}
