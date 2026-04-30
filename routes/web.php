<?php

use App\Modules\Produto\ProdutoController;
use App\Modules\Cliente\ClienteController;
use App\Modules\Pedido\PedidoController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureTokenIsValid;

// ROTAS RELACIONADAS AO CLIENTE

Route::get('/', function () {
    return view('/site/bem-vindo');
})->name('bemvindo.index');

Route::get('/cardapio', function () {
    return view('/site/cardapio', ['produtos' => \App\Models\Produto::all()]);
})->name('cardapio.index');

Route::get('/pedido', function () {
    return view('site/pedido', ['total' => session('carrinhoTotal', 0)]);
})->name('pedido.ver');

Route::post('/pagamento', [PedidoController::class, 'calcularTotal'])->name('pagamento.index');

// ROTAS DAS VIEWS DO FIGMA CRIADAS NA PASTA RADAPE
Route::view('/figma-cardapio', 'radape.cardapio-completo')->name('radape.cardapio');
Route::view('/nossa-historia', 'radape.nossa-historia')->name('radape.nossa-historia');
Route::view('/cookies', 'radape.cookies')->name('radape.cookies');
Route::view('/termos-e-condicoes', 'radape.termos-e-condicoes')->name('radape.termos');
Route::view('/politica-de-email', 'radape.politica-email')->name('radape.politica-email');
Route::view('/privacidade', 'radape.politica-email')->name('radape.privacidade');
Route::view('/ajuda', 'radape.ajuda')->name('radape.ajuda');
Route::view('/trabalhe-conosco', 'radape.trabalhe-conosco')->name('radape.trabalhe-conosco');

/* Route::get('/cliente', function () {
    return view('site/cardapio',  ['produtos' => \App\Models\Produto::all()]);
})->name('cliente.index'); */ 



Route::get('/perfil', function () {
    return view('site/perfil');
})->name('perfil.index');

Route::post('/perfil/atualizar', [ClienteController::class, 'atualizarPerfilWeb'])->name('perfil.atualizar');

Route::get('/pagamento/', function(){
    return view('site/pagamento');
})->name('pagamento.index');

// ROTAS DE AUTENTICAÇÃO 

Route::get('autorizacao/login', function () {
    return view('autorizacao.login');
})->name('autorizacao.login');

Route::post('autorizacao/login', [ClienteController::class, 'login'])->name('cliente.login');

Route::get('/cadastro', function () {
    return view('autorizacao.cadastro');
})->name('register');

/* Route::post('/cadastro', [ClienteController::class, 'adicionarCliente'], function () {
    return view('autorizacao.cadastro');
})->name('register'); */

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
Route::get('/pedidos', function() {
    return view('site/pedido');
})->name('pedido.index');

Route::post('/pedidos', [PedidoController::class, 'salvarPedido'])->name('pedido.salvar');

Route::delete('/pedidos/{id}', [PedidoController::class, 'deletarPedido'])->name('pedido.deletar');

Route::put('/pedidos/{pedido}', [PedidoController::class, 'alterarPedido'])->name('pedido.alterar');

Route::get('/pedidos/{id}/total', [PedidoController::class, 'calcularTotal'])->name('pedido.total');

Route::post('/pedido/adicionar', [PedidoController::class, 'salvarItemPedido'])->name('pedido.adicionar');

Route::post('/pedido/remover-unidade/{id}', [PedidoController::class, 'alteraItemDoPedido'])->name('remover.unidade.item.pedido');

Route::post('/pedido/adicionar-unidade/{id}', [PedidoController::class, 'alteraItemDoPedido'])->name('adicionar.unidade.item.pedido');

Route::post('/pedido/remover-tudo/{id}', [PedidoController::class, 'alteraItemDoPedido'])->name('remover.item.pedido');

Route::post('/pedidos/finalizar', [PedidoController::class, 'salvarPedido'])->name('pedido.finalizar');


// ROTAS PRODUTOS

Route::get('/produto/novo', function () {
    return view('produto_novo', ['produtos' => \App\Models\Produto::all()]);
})->middleware(EnsureTokenIsValid::class)->name('produto.index');

Route::post('/produto/novo',  [ProdutoController::class, 'salvarProduto'])->name('produto.salvar');

Route::delete('/produto/{id}', [ProdutoController::class, 'deletarProduto'])->name('produto.deletar');

Route::put('/produto/{produto}', [ProdutoController::class, 'alterarProduto'])->name('produto.alterar');

Route::get('/produto', function () {
    return view('site/cardapio', [ProdutoController::class, 'listarProduto']);
})->name('produto.show');

Route::get('/produto/{id}', [ProdutoController::class, 'listarProdutoById'])->name('produto.show.id');


// ROTAS CLIENTE 

// logout
Route::get('/logout', [ClienteController::class, 'sair'])->name('cliente.sair');

// cadastro
Route::post('/clientes', [ClienteController::class, 'salvarCliente'])->name('cliente.salvar');

// login real
//Route::post('/login', [ClienteController::class, 'login'])->name('cliente.login');
Route::post('/recuperar-senha', [ClienteController::class, 'solicitarRecuperacaoSenha'])->name('password.email');
Route::post('/nova-senha', [ClienteController::class, 'redefinirSenha'])->name('password.update');


Route::delete('/clientes/{cliente}', [ClienteController::class, 'deletarCliente'])->name('cliente.deletar');
Route::put('/clientes/{cliente}', [ClienteController::class, 'alterarCliente'])->name('cliente.alterar');
