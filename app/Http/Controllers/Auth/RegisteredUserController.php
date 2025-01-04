<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
   public function create()
   {
       return view('admin.register');
   }

   public function store(Request $request)
   {
       $request->validate([
           'email' => 'required|email|unique:users',
           'password' => 'required|min:6'
       ]);

       $user = User::create([
           'email' => $request->email,
           'password' => Hash::make($request->password),
           'name' => explode('@', $request->email)[0] // Using email prefix as name
       ]);

       return redirect()->route('admin.login.form')
           ->with('success', 'Registration successful! Please login.');
   }
}