@extends('autorizacao.layout')

@section('titulo', 'Login')

@section('conteudo')
<div class="auth-page">
    <section class="auth-shell auth-shell-form auth-shell-login">
        <div class="auth-panel auth-panel-form">
            <div class="auth-block">
                <h1 class="auth-form-title">SEJA BEM-VINDO DE VOLTA</h1>

                @if(session('mensagem'))
                    <div class="auth-alert">
                        {{ session('mensagem') }}
                    </div>
                @endif

                {{--
                ============================================
                BOTÕES DE LOGIN SOCIAL (Google & Facebook)
                Temporariamente pausados
                ============================================
                <div class="auth-social">
                    <a href="{{ route('auth.social.redirect', 'google') }}"
                       class="auth-btn-social auth-btn-google"
                       id="btn-login-google">
                        <span class="auth-social-badge google-badge">G</span>
                        Entrar com Google
                    </a>

                    <a href="{{ route('auth.social.redirect', 'facebook') }}"
                       class="auth-btn-social auth-btn-facebook"
                       id="btn-login-facebook">
                        <span class="auth-social-badge facebook-badge">f</span>
                        Entrar com Facebook
                    </a>
                </div>

                <div class="auth-divider">
                    <span class="auth-divider-line"></span>
                    <span class="auth-divider-text">ou entre com e-mail</span>
                    <span class="auth-divider-line"></span>
                </div>
                --}}

                {{-- ============================================
                     FORMULÁRIO TRADICIONAL (E-MAIL + SENHA)
                     ============================================ --}}
                <form action="{{ route('cliente.login') }}" method="POST" class="auth-form">
                    @csrf

                    <div class="auth-field">
                        <label for="email" class="auth-label">E-MAIL</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control auth-input"
                            placeholder="Insira o seu e-mail"
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
                            placeholder="Insira a sua senha"
                            required
                        >
                    </div>

                    <a href="{{ route('password.request') }}" class="auth-link-small">
                        ESQUECI A SENHA
                    </a>

                    <div class="auth-form-actions">
                        <button type="submit" class="btn auth-btn-yellow auth-btn-submit" id="btn-login-submit">
                            ENTRAR
                        </button>
                    </div>
                </form>

                {{-- Link para cadastro --}}
                <p class="auth-footer-text">
                    Não tem uma conta?
                    <a href="{{ route('register') }}" class="auth-link-small">Cadastre-se</a>
                </p>
            </div>
        </div>

        @include('autorizacao.showcase')
    </section>
</div>
@endsection
