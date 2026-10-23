<?php
namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class WebAuthController extends Controller
{
    // create user 
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign default role (e.g., "user")
        $user->assignRole('buyer');

        Auth::login($user);

        return redirect()->intended('/auctions');
    }

    // Show the Login Page
    public function showLogin()
    {
        return Inertia::render('Auth/Login');
    }

    // Handle Login Request
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // Role-based Redirection Logic
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    //show the dashboard
    public function dashboard(Request $request)
    {
        $user = Auth::user();
        if($user->hasRole('admin')) {
            return Inertia::render('Admin::Dashboard');
        } elseif ($user->hasRole('seller')) {
            return Inertia::render('seller/Dashboard');
        } else {
            return Inertia::render('user/Dashboard');
        }

    }
}