<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // Show Register/Create Form
    public function create() {
        return view('users.register');
    }

    // Create New User
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6',
            'usertype' => 'required'
        ]);
        // dd($formFields);
        $usertype = $formFields['usertype'];
        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);
        // dd($formFields);
        // Create User
        $user = User::create($formFields);
        // dd($user);
        if($usertype == 1){
            // Admin 
            $admin = Role::where('name','=','Admin')->first();
            $user->assignRole($admin);
        }
        else if($usertype == 2){
            // Editor 
            $admin = Role::where('name','=','Editor')->first();
            $user->assignRole($admin);
        }
        else if($usertype == 3){
            // Contributor
            $admin = Role::where('name','=','Contributor')->first();
            $user->assignRole($admin);
        }
        else if($usertype == 4){
            // Subscriber
            $admin = Role::where('name','=','Subscriber')->first();
            $user->assignRole($admin);
        }
        // Login
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }

    // Logout User
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');

    }

    // Show Login Form
    public function login() {
        return view('users.login');
    }

    // Authenticate User
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
