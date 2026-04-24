<?php

use App\Modules\Produto\ProdutoController;
use App\Modules\Cliente\ClienteController;
use App\Modules\Pedido\PedidoController;
use Illuminate\Support\Facades\Route;

// VIEWS PRINCIPAIS

Route::get('/', function () {
    return view('cardapio', ['produtos' => \App\Models\Produto::all()]);
})->name('cardapio.index');

Route::get('/produto/{id}', function ($id) {
    return view('produto', ['produto' => \App\Models\Produto::find($id)]);
})->name('produto.show');

Route::get('/pedido', function () {
    return view('pedido', ['total' => session('carrinhoTotal', 0)]);
})->name('pedido.ver');

Route::get('/perfil', function () {
    return view('perfil');
})->name('perfil.index');

Route::post('/perfil/atualizar', [ClienteController::class, 'atualizarPerfilWeb'])->name('perfil.atualizar');


// ROTAS DE AUTENTICAÇÃO 

Route::get('/cliente', function () {
    return view('autorizacao.bem-vindo');
})->name('cliente.index');

Route::get('/login', function () {
    return view('autorizacao.login');
})->name('login');

Route::post('pagina-inicial/login', [ClienteController::class, 'salvarCliente'], 
    function(){
        return view('cardapio', ['produtos' => \App\Models\Produto::all()]);
    });

Route::get('/cadastro', function () {
    return view('autorizacao.cadastro');
})->name('register');

Route::get('/recuperar-senha', function () {
    return view('autorizacao.esqueci-senha');
})->name('password.request');

Route::get('/nova-senha', function () {
    if (!session()->has('password_reset_cliente_id')) {
        return redirect()->route('password.request')->with('mensagem', 'Primeiro localize a conta para redefinir a senha.');
    }

    return view('autorizacao.nova-senha');
})->name('password.reset');


// ROTAS PEDIDOS

Route::post('/pedidos', [PedidoController::class, 'salvarPedido'])->name('pedido.salvar');
Route::delete('/pedidos/{pedido}', [PedidoController::class, 'deletarPedido'])->name('pedido.deletar');
Route::put('/pedidos/{pedido}', [PedidoController::class, 'alterarPedido'])->name('pedido.alterar');
Route::get('/pedidos/{id}/total', [PedidoController::class, 'calcularTotal'])->name('pedido.total');
Route::post('/pedidos/adicionar', [PedidoController::class, 'salvarItemPedido'])->name('pedido.adicionar');
Route::post('/pedido/remover-unidade/{id}', [PedidoController::class, 'removerUnidade']);
Route::post('/pedido/adicionar-unidade/{id}', [PedidoController::class, 'adicionarUnidade']);
Route::post('/pedido/remover-tudo/{id}', [PedidoController::class, 'removerTudo']);
Route::post('/pedidos/finalizar', [PedidoController::class, 'salvarPedido'])->name('pedido.finalizar');


// ROTAS PRODUTOS

Route::get('/produtos/novo', function () {
    return view('produto_novo');
})->name('produto.novo');

Route::post('/produtos', [ProdutoController::class, 'salvarProduto'])->name('produto.salvar');
Route::delete('/produtos/{produto}', [ProdutoController::class, 'deletarProduto'])->name('produto.deletar');
Route::put('/produtos/{produto}', [ProdutoController::class, 'alterarProduto'])->name('produto.alterar');


// ROTAS CLIENTE 

// logout
Route::get('/logout', [ClienteController::class, 'sair'])->name('cliente.sair');

// cadastro
Route::post('/clientes', [ClienteController::class, 'salvarCliente'])->name('cliente.salvar');

// login real
Route::post('/login', [ClienteController::class, 'login'])->name('cliente.login');
Route::post('/recuperar-senha', [ClienteController::class, 'solicitarRecuperacaoSenha'])->name('password.email');
Route::post('/nova-senha', [ClienteController::class, 'redefinirSenha'])->name('password.update');


Route::delete('/clientes/{cliente}', [ClienteController::class, 'deletarCliente'])->name('cliente.deletar');
Route::put('/clientes/{cliente}', [ClienteController::class, 'alterarCliente'])->name('cliente.alterar');


// ROTAS DE TESTE
