<?php

namespace App\Modules\Produto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Produto\ProdutoService;
use App\Models\Produto;
use App\Models\Pedido;

class ProdutoController extends Controller{
    
    public function __construct(private ProdutoService $service){
        $this->service = $service;
    }

    /**
     * Salva um novo produto no banco de dados e envia a imagem para o MinIO.
     * Somente administradores podem acessar esta função (protegido por middleware auth:admin).
     */
    public function salvarProduto(Request $request){
        // Valida os dados enviados pelo formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:500',
            'preco' => 'required',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:max_width=2000,max_height=2000,ratio=1/1',
        ], [
            'imagem.dimensions' => 'A imagem precisa ter proporção 1:1 (quadrada) e no máximo 2000x2000 pixels.',
            'imagem.max' => 'A imagem não pode ter mais que 2MB.',
        ]);

        $imagePath = null;
        // Verifica se uma imagem foi enviada
        if ($request->hasFile('imagem')) {
            // Salva a imagem no disco 's3' (MinIO local) e pega o caminho gerado
            $imagePath = $request->file('imagem')->store('produtos', 's3');
        }

        // Converte o preço de "25,50" para formato float "25.50"
        $preco = str_replace(',', '.', $request->preco);
        
        // Passa os dados estruturados para a camada de serviço que salva no banco
        $produto = $this->service->adicionarProduto(
            $request->nome, 
            (float) $preco,
            $request->descricao,
            $request->tipo,
            $request->adicionais,
            $imagePath
        );
        
        // Redireciona o admin de volta para o painel com mensagem de sucesso
        if (!$request->wantsJson()) {
            return redirect()->route('admin.produto.index')->with('mensagem', 'Produto adicionado com sucesso!');
        }
        return response()->json($produto);
    }

    public function deletarProduto(Produto $produto){
        $this->service->deletarProduto($produto);
        return response()->json(['Mensagem' => 'Produto Removido']);
    }

    public function alterarProduto(Produto $produto, Request $request){
        $produto = $this->service->alterarProduto($produto, $request->only(['nome', 'preco']));
        if ($produto === null) {
            return response()->json(['Mensagem' => 'Cliente Não Encontrado'], 404);
        }
        return response()->json($produto);
    }

    public function listarProdutos(){
        return $this->service->listarProduto();
    }

    public function listarProdutoById(int $id){
        $produto = Produto::findOrFail($id);
        return view('site/produto', compact('produto'));
    }

    /**
     * Retorna a view principal do cardápio.
     * Esta função prepara todas as coleções de produtos, formata preços, atribui imagens demonstrativas 
     * e calcula os totais do carrinho atualmente armazenados na sessão do usuário.
     */
    public function index() {
        $produtos = Produto::all();

        // Relaciona categorias com um conjunto estático de imagens do Figma para demonstração visual
        $imageSets = [
            'Burgers' => ['hero-food.png', 'promo-food.png', 'product-02.png', 'product-03.png', 'product-04.png', 'product-05.png', 'product-06.png'],
            'Fries' => ['product-07.png', 'product-08.png', 'product-09.png', 'product-10.png', 'product-11.png'],
            'Cold Drinks' => ['product-01.png', 'product-12.png', 'product-13.png', 'product-14.png', 'product-15.png', 'product-16.png', 'product-17.png'],
        ];

        // Mapeia o nome descritivo das categorias para o ID da âncora usado no HTML (scrollspy)
        $categoryId = [
            'Burgers' => 'burgers',
            'Fries' => 'fries',
            'Cold Drinks' => 'cold-drinks',
        ];

        // Tabs visíveis no menu de navegação de categorias
        $categoryTabs = [
            ['id' => 'cardapio', 'title' => 'Offers'],
            ['id' => 'burgers', 'title' => 'Burgers'],
            ['id' => 'fries', 'title' => 'Fries'],
            ['id' => 'snacks', 'title' => 'Snacks'],
            ['id' => 'salads', 'title' => 'Salads'],
            ['id' => 'cold-drinks', 'title' => 'Cold drinks'],
            ['id' => 'happy-meal', 'title' => 'Happy Meal'],
            ['id' => 'desserts', 'title' => 'Desserts'],
            ['id' => 'hot-drinks', 'title' => 'Hot drinks'],
            ['id' => 'sauces', 'title' => 'Sauces'],
            ['id' => 'orbit', 'title' => 'Orbit'],
        ];

        // Closure responsável por deduzir a categoria do produto com base em palavras-chave no nome
        $categoryFromName = function ($nome) {
            $nome = strtolower((string) $nome);
            if (str_contains($nome, 'batata') || str_contains($nome, 'frita') || str_contains($nome, 'fries')) return 'Fries';
            if (str_contains($nome, 'coca') || str_contains($nome, 'suco') || str_contains($nome, 'agua') || str_contains($nome, 'bebida') || str_contains($nome, 'refri') || str_contains($nome, 'drink')) return 'Cold Drinks';
            return 'Burgers';
        };

        $produtosCollection = collect($produtos ?? [])->values();

        // Formata os produtos atribuindo a eles uma categoria calculada e uma imagem fixa do Figma
        $menuProdutos = $produtosCollection->map(function ($produto, $index) use ($categoryFromName, $imageSets) {
            $nome = data_get($produto, 'nome', 'Produto');
            $categoria = $categoryFromName($nome);
            $images = $imageSets[$categoria];

            return [
                'id' => data_get($produto, 'id'),
                'nome' => $nome,
                'preco' => (float) data_get($produto, 'preco', 0),
                'descricao' => 'Produto cadastrado no banco de dados da MecDonin.',
                'categoria' => $categoria,
                'image' => $images[$index % count($images)],
            ];
        });

        // Agrupa os produtos por seção para serem renderizados em listas no cardápio
        $sections = collect(['Burgers', 'Fries', 'Cold Drinks'])
            ->map(function ($categoria) use ($menuProdutos, $categoryId) {
                return [
                    'id' => $categoryId[$categoria],
                    'title' => $categoria,
                    'items' => $menuProdutos->where('categoria', $categoria)->values(),
                ];
            })
            ->filter(fn ($section) => $section['items']->isNotEmpty()) // Ignora categorias sem itens
            ->values();

        // Recupera o carrinho da sessão atual para exibir totais na Header (Sidebar de pedidos)
        $mapsUrl = 'https://www.google.com/maps/search/Complexo+Rio+Madeira+-+Av.+Farquar,+2986+-+Pedrinhas,+Porto+Velho+-+RO/@-8.7531744,-63.9143679,5197m/data=!3m2!1e3!4b1?entry=ttu&g_ep=EgoyMDI2MDQyNi4wIKXMDSoASAFQAw%3D%3D';
        $clienteLogado = session()->has('cliente_id');
        $carrinho = collect(session('carrinho', []));
        $cartCount = (int) session('carrinhoCount', $carrinho->sum('quantidade'));
        $cartTotal = (float) session('carrinhoTotal', $carrinho->sum(fn ($item) => ($item['preco'] ?? 0) * ($item['quantidade'] ?? 0)));
        
        // Define rotas de fallback de acordo com o estado de autenticação
        $perfilOuLoginRoute = $clienteLogado ? route('perfil.index') : route('autorizacao.login');
        $fallbackProdutoRoute = route('cardapio.index') . '#cardapio';

        // Verifica se o cliente nunca fez um pedido na loja (para exibir cupom de primeiro pedido)
        $clienteId = session('cliente_id');
        $isFirstOrder = !$clienteId || Pedido::where('cliente_id', $clienteId)->doesntExist();

        return view('site.cardapio', compact(
            'produtos', 'categoryTabs', 'menuProdutos', 'sections', 
            'mapsUrl', 'clienteLogado', 'carrinho', 'cartCount', 
            'cartTotal', 'perfilOuLoginRoute', 'fallbackProdutoRoute',
            'isFirstOrder'
        ));
    }
}
