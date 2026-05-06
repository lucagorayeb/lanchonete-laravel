<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Auth;

    class AuthorController extends Controller
    {
        public function index()
        {
            return view('autorizacao.login');
        }
        public function loginAttempt(Request $request)
        {
            $validatedData = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
        
        if (Auth::attempt($validatedData)) {
            $request->session()->regenerate();
            return redirect()->intended('/perfil');
        }
        return back()->with('STATUS','Credenciais inválidas');

        }
}