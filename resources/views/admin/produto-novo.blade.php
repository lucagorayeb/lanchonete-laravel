@extends('site.layout')

{{-- Define o título da página no navegador --}}
@section('titulo', 'Painel Admin - Novo Produto')

{{-- Importa o arquivo CSS exclusivo do painel administrativo via Vite --}}
@section('estilos')
    @vite('resources/css/admin.css')
@endsection

{{-- Cabeçalho fixo informando que a página é de Administração --}}
@section('header')
<div class="page-header sticky-header text-center">
    <h2 class="mb-sm">
        <span class="admin-badge">ADMIN</span><br>
        Adicionar Produto
    </h2>
</div>
@endsection

@section('conteudo')
<div class="form-container large-form">
    @if(session('mensagem'))
        <div style="background: #e6f4ea; color: #1e8e3e; padding: 10px; border-radius: 4px; margin-bottom: 15px; text-align: center;">
            {{ session('mensagem') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="background: #fce8e6; color: #d93025; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.produto.salvar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="form-label" for="nome">Nome do Produto</label>
            <input type="text" id="nome" name="nome" class="form-control" required placeholder="Ex: Hamburguer duplo">
        </div>
        
        <div class="form-group">
            <label class="form-label" for="descricao">Descrição Simples e Direta</label>
            <textarea id="descricao" name="descricao" class="form-control" rows="2" placeholder="Ex: Delicioso hambúrguer artesanal com blend de 180g e queijo derretido."></textarea>
        </div>
        
        <div class="form-group">
            <label class="form-label" for="imagem">Imagem do Produto (MinIO/S3)</label>
            <input type="file" id="imagem" name="imagem" class="form-control" accept="image/png, image/jpeg, image/webp">
            <small style="color: #666; font-size: 13px;">Proporção obrigatória: 1:1 (quadrada). Máximo 2MB e 2000x2000 px.</small>
        </div>
        
        <div class="form-group">
            <label class="form-label" for="tipo">Tipo / Categoria de Item</label>
            <select id="tipo" name="tipo" class="form-control" required>
                <option value="">Selecione um tipo...</option>
                <option value="Burgers">Burgers</option>
                <option value="Fries">Fries</option>
                <option value="Snacks">Snacks</option>
                <option value="Salads">Salads</option>
                <option value="Cold Drinks">Cold Drinks</option>
                <option value="Happy Meal">Happy Meal</option>
                <option value="Desserts">Desserts</option>
                <option value="Hot Drinks">Hot Drinks</option>
                <option value="Sauces">Sauces</option>
                <option value="Orbit">Orbit</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label" for="preco">Preço (R$)</label>
            <input type="text" inputmode="decimal" id="preco" name="preco" class="form-control" required placeholder="Ex: 25,50">
        </div>

        <div class="form-group">
            <label class="form-label" for="adicionais">Quais adicionais o cliente pode escolher?</label>
            <textarea id="adicionais" name="adicionais" class="form-control" rows="3" placeholder="Ex: Bacon, Cheddar extra, Cebola Caramelizada (separe por vírgula)"></textarea>
            <small style="color: #666; font-size: 13px;">Opcional. Deixe em branco se não houver.</small>
        </div>

        <button type="submit" class="btn-primary">Salvar Produto</button>
    </form>
    
    <div style="text-align: center; margin-top: 20px;">
        <a href="{{ route('cardapio.index') }}" style="color: var(--color-text-muted); text-decoration: underline;">Voltar ao Cardápio Público</a>
    </div>
</div>
@endsection
