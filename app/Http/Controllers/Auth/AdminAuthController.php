<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    /**
     * Mostra o formulário de login para o admin.
     */
    public function showLoginForm()
    {
        // Se já estiver logado, redireciona para a criação de produto ou painel principal
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.produto.index');
        }

        return view('admin.login');
    }

    /**
     * Processa a autenticação do administrador.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tenta autenticar usando o guard 'admin'
        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.produto.index'))
                             ->with('mensagem', 'Bem-vindo ao painel administrativo!');
        }

        return back()->withErrors([
            'email' => 'As credenciais informadas estão incorretas ou você não tem acesso.',
        ])->onlyInput('email');
    }

    /**
     * Realiza o logout do administrador.
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
