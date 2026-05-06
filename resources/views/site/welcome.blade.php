@extends('autorizacao.layout')

@section('titulo', 'Bem-vindo')

@section('conteudo')
<div class="auth-page">
    <section class="auth-shell auth-shell-home">
        <div class="auth-panel">
            <div class="auth-block auth-block-home">
                <h1 class="auth-home-title">
                    SUA FOME TEM LUGAR CERTO <br>
                    FAÇA LOGIN E SABOREIE
                </h1>

                <div class="auth-home-actions">
                    <a href="{{ route('login') }}" class="btn auth-btn-yellow">ENTRAR</a>
                    <a href="{{ route('register') }}" class="btn auth-btn-white">CADASTRE-SE</a>
                    <a href="{{ route('cardapio.index') }}" class="auth-link-pink">VISITA SEM LOGIN</a>
                </div>
            </div>
        </div>

        @include('autorizacao.showcase')
    </section>
</div>
@endsection
