@extends('site.layout')

@section('titulo', 'Meu Perfil')

@section('estilos')
<style>
    .page-header {
        background-color: var(--color-background);
        position: sticky;
        top: 0;
        z-index: 100;
        padding: var(--spacing-sm) var(--spacing-md) var(--spacing-sm) var(--spacing-md);
        border-bottom: 1px solid var(--color-border);
    }
    .profile-container {
        padding: var(--spacing-lg) var(--spacing-md);
        max-width: 600px;
        margin: 0 auto;
    }
    .alert-success {
        background-color: rgba(40, 167, 69, 0.1);
        color: var(--color-success);
        padding: var(--spacing-md);
        border-radius: var(--border-radius-md);
        margin-bottom: var(--spacing-md);
        font-weight: 500;
        text-align: center;
    }
</style>
@endsection

@section('header')
<div class="page-header">
    <h2 class="mb-sm text-center">Meu Perfil</h2>
</div>
@endsection

@section('conteudo')
<div class="profile-container">
    @if(session('mensagem'))
        <div class="alert-success">
            {{ session('mensagem') }}
        </div>
    @endif

    <form action="{{ url('/perfil/atualizar') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label" for="nome">Nome</label>
            <input type="text" id="nome" name="nome" class="form-control" value="{{ session('nome_cliente') }}" required>
        </div>
        
        <div class="form-group">
            <label class="form-label" for="sobrenome">Sobrenome</label>
            <input type="text" id="sobrenome" name="sobrenome" class="form-control" value="{{ session('sobrenome_cliente') }}">
        </div>

        <button type="submit" class="btn btn-primary mt-sm">Salvar Alterações</button>
    </form>

    <div class="mt-xl text-center">
        <!-- Assuming they have an explicit logout route, fallback to url -->
        <p class="small"><a href="{{ route('cliente.sair') }}" style="color: var(--color-text-muted); text-decoration: underline;">Sair do aplicativo</a></p>
    </div>
</div>
@endsection

@section('footer')
<div class="sticky-footer">
    <div class="sticky-footer-inner">
        <a href="{{ route('cardapio.index') }}" class="nav-item">
            <svg viewBox="0 0 24 24"><path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H8V4h12v12z"/></svg>
            Cardápio
        </a>
        
        <a href="{{ route('pedido.ver') }}" class="nav-item">
            @if(session('carrinhoCount', 0) > 0)
                <span class="cart-badge" data-count="{{ session('carrinhoCount') }}">
                    {{ session('carrinhoCount') > 99 ? '99+' : session('carrinhoCount') }}
                </span>
            @endif
            <svg viewBox="0 0 24 24"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zm-9.83-3.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.86-7.01L19.42 4h-.01l-1.1 2-2.76 5H8.53l-.13-.27L6.16 6l-.95-2-.94-2H1v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.13 0-.25-.11-.25-.25z"/></svg>
            Carrinho
        </a>

        <a href="{{ url('/perfil') }}" class="nav-item active">
            <svg viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
            Perfil
        </a>
    </div>
</div>
@endsection
