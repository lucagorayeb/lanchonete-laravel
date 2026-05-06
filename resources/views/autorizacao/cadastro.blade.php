@extends('autorizacao.layout')

@section('titulo', 'Cadastro')

@section('conteudo')
<div class="auth-page">
    <section class="auth-shell auth-shell-form auth-shell-register">
        <div class="auth-panel auth-panel-form">
            <div class="auth-block">
                <h1 class="auth-form-title auth-form-title-center">CADASTRE-SE</h1>

                {{--
                ============================================
                CADASTRO RÁPIDO COM REDES SOCIAIS
                Temporariamente pausado
                ============================================
                <div class="auth-social">
                    <a href="{{ route('auth.social.redirect', 'google') }}"
                       class="auth-btn-social auth-btn-google"
                       id="btn-cadastro-google">
                        <span class="auth-social-badge google-badge">G</span>
                        Cadastrar com Google
                    </a>

                    <a href="{{ route('auth.social.redirect', 'facebook') }}"
                       class="auth-btn-social auth-btn-facebook"
                       id="btn-cadastro-facebook">
                        <span class="auth-social-badge facebook-badge">f</span>
                        Cadastrar com Facebook
                    </a>
                </div>

                <div class="auth-divider">
                    <span class="auth-divider-line"></span>
                    <span class="auth-divider-text">ou preencha o formulário</span>
                    <span class="auth-divider-line"></span>
                </div>
                --}}

                {{-- ============================================
                     FORMULÁRIO TRADICIONAL
                     ============================================ --}}
                <form action="{{ route('cliente.salvar') }}" method="POST" class="auth-form">
                    @csrf

                    <div class="auth-field">
                        <label for="nome" class="auth-label">NOME</label>
                        <input
                            type="text"
                            id="nome"
                            name="nome"
                            class="form-control auth-input"
                            placeholder="Digite o seu nome completo"
                            value="{{ old('nome') }}"
                            required
                        >
                    </div>

                    <div class="auth-field">
                        <label for="cpf" class="auth-label">CPF</label>
                        <input
                            type="text"
                            id="cpf"
                            name="cpf"
                            class="form-control auth-input"
                            placeholder="Digite o seu CPF"
                            value="{{ old('cpf') }}"
                            required
                        >
                    </div>

                    <div class="auth-field">
                        <label for="numero" class="auth-label">TELEFONE</label>
                        <input
                            type="text"
                            id="numero"
                            name="numero"
                            class="form-control auth-input"
                            placeholder="Digite o seu número de telefone"
                            value="{{ old('numero') }}"
                            required
                        >
                    </div>

                    <div class="auth-field">
                        <label for="email" class="auth-label">E-MAIL</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control auth-input"
                            placeholder="Digite o seu e-mail"
                            value="{{ old('email') }}"
                            required
                        >
                    </div>

                    <div class="auth-field">
                        <label for="senha" class="auth-label">SENHA</label>
                        <input
                            type="password"
                            id="senha"
                            name="senha"
                            class="form-control auth-input"
                            placeholder="Crie uma senha"
                            required
                        >
                    </div>

                    <div class="auth-form-actions">
                        <button type="submit" class="btn auth-btn-yellow auth-btn-submit" id="btn-cadastro-submit">
                            CADASTRAR
                        </button>
                    </div>
                </form>

                {{-- Link para login --}}
                <p class="auth-footer-text">
                    Já tem uma conta?
                    <a href="{{ route('autorizacao.login') }}" class="auth-link-small">Entrar</a>
                </p>
            </div>
        </div>

        @include('autorizacao.showcase')
    </section>
</div>
@endsection
