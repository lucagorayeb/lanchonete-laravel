<?php
namespace App\Modules\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Cliente\UserService;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function __construct(private UserService $service){
        $this->service = $service;
    }

    public function salvarUser(Request $request) {
        //dd($request->all());
        $cliente = $this->service->adcionarUser(
            $request->nome, 
            $request->email, 
            $request->cpf, 
            $request->numero, 
            $request->senha
            );
        return redirect()->route('autorizacao.login');
    }

    public function login(Request $request) {
        //dd($request->all());
        $cliente = User::where('email', $request->email)->first();

        if (!$cliente || !password_verify($request->senha, $cliente->senha)) {
            if ($request->wantsJson()) {
                return response()->json(['mensagem' => 'E-mail ou senha inválidos.'], 401);
            }

            return back()
                ->withInput($request->only('email'))
                ->with('mensagem', 'E-mail ou senha inválidos.');
        }

        $request->session()->regenerate();
        session([
            'cliente_id' => $cliente->id,
            'nome_cliente' => $cliente->nome,
            'sobrenome_cliente' => $request->sobrenome
        ]);

        return redirect()->route('cardapio.index');
    }

    public function solicitarRecuperacaoSenha(Request $request) {
        $cliente = User::where('nome', $request->nome)
            ->where('email', $request->email)
            ->first();

        if (!$cliente) {
            if ($request->wantsJson()) {
                return response()->json(['mensagem' => 'Conta não encontrada.'], 404);
            }

            return back()
                ->withInput($request->only('nome', 'email'))
                ->with('mensagem', 'Não encontramos uma conta com esses dados.');
        }

        session(['password_reset_cliente_id' => $cliente->id]);

        if ($request->wantsJson()) {
            return response()->json(['mensagem' => 'Conta localizada.']);
        }

        return redirect()
            ->route('password.reset')
            ->with('mensagem', 'Conta localizada. Defina a nova senha.');
    }

    public function redefinirSenha(Request $request) {
        if ($request->senha !== $request->senha_confirmation) {
            if ($request->wantsJson()) {
                return response()->json(['mensagem' => 'As senhas não conferem.'], 422);
            }

            return back()->with('mensagem', 'As senhas não conferem.');
        }

        $clienteId = session('password_reset_cliente_id');
        $cliente = User::find($clienteId);

        if (!$cliente) {
            if ($request->wantsJson()) {
                return response()->json(['mensagem' => 'Solicitação de redefinição inválida.'], 404);
            }

            return redirect()
                ->route('password.request')
                ->with('mensagem', 'Solicitação de redefinição inválida. Tente novamente.');
        }

        $cliente->update([
            'senha' => password_hash($request->senha, PASSWORD_DEFAULT),
        ]);

        session()->forget('password_reset_cliente_id');

        if ($request->wantsJson()) {
            return response()->json(['mensagem' => 'Senha redefinida com sucesso.']);
        }

        return redirect()
            ->route('autorizacao.login')
            ->with('mensagem', 'Senha redefinida com sucesso. Faça login novamente.');
    }

    public function deletarUser(User $cliente) {
        $this->service->deletarUser($cliente);
        return response()->json(['Mensagem' => 'User Removido']);
    }

    public function alterarUser(Request $request, User $cliente) {
        $cliente = $this->service->alterarUser($request->only(['nome', 'email', 'cpf', 'numero']), $cliente);

        if (!$cliente) {
            return response()->json(['Mensagem' => 'User Não Encontrado'], 404);
        }

        return response()->json($cliente);
    }

    public function atualizarPerfilWeb(Request $request) {
        $clienteId = session('cliente_id');
        if (!$clienteId) {
            return redirect()->route('cliente.index');
        }

        $cliente = \App\Models\User::find($clienteId);
        if ($cliente) {
            $cliente = $this->service->alterarUser($request->only(['nome']), $cliente);
            session([
                'nome_cliente' => $cliente->nome,
                'sobrenome_cliente' => $request->sobrenome,
            ]);
            return redirect()->route('perfil.index')->with('mensagem', 'Perfil atualizado com sucesso!');
        }
        return redirect()->route('perfil.index')->with('mensagem', 'Erro ao atualizar perfil.');
    }

    public function sair(Request $request) {
        $request->session()->flush();
        return redirect()->route('cliente.index');
    }
}