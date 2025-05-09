<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // // Check if the user is logged in
        // if (session()->has('user')) {
        //     return redirect()->route('home');
        // }
        // // If not logged in, redirect to the login page
        // return redirect()->route('login');

        return view('home');
    }

    public function login()
    {
        return view('login');
    }
    
    public function access()
    {
        $user = User::where('email', request('email'))->first();
        if ($user && password_verify(request('password'), $user->password)) {
            session(['user' => $user]);
            return redirect()->route('home');
        } else {
            return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function register()
    {
        return view('register');
    }
    
    public function createUser(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        User::create($data);

        return redirect()->route('login')->with('success', 'User created successfully');
    }
    public function logout()
    {
        session()->forget('user');
        return redirect()->route('login');
    }

    public function password()
    {
        return view('password');
    }
    // si despues quieres crear mas vistas, prueba las del portafolio que normalmente haces
    //es decir Home, About, Contact, Projects, Services, etc
}
