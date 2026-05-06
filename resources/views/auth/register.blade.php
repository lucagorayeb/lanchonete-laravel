@extends('autorizacao.layout')

@section('titulo', 'Cadastro')

@section('conteudo')
<div class="auth-page">
    <section class="auth-shell auth-shell-form auth-shell-register">
        <div class="auth-panel auth-panel-form">
            <div class="auth-block">
                <h1 class="auth-form-title auth-form-title-center">CADASTRE-SE</h1>

                <form method="POST" action="{{ route('register') }}" class="auth-form">
                    @csrf

                    {{-- Nome --}}
                    <div class="auth-field">
                        <label for="name" class="auth-label">NOME</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control auth-input"
                            placeholder="Digite o seu nome completo"
                            value="{{ old('name') }}"
                            required
                        >
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- CPF --}}
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
                        @error('cpf')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Numero --}}
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
                        @error('numero')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
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
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Senha --}}
                    <div class="auth-field">
                        <label for="password" class="auth-label">SENHA</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control auth-input"
                            placeholder="Crie uma senha"
                            required
                        >
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Confirmar Senha --}}
                    <div class="auth-field">
                        <label for="password_confirmation" class="auth-label">CONFIRMAR SENHA</label>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control auth-input"
                            placeholder="Confirme a senha"
                            required
                        >
                    </div>

                    <div class="auth-form-actions">
                        <button type="submit" class="btn auth-btn-yellow auth-btn-submit">
                            CADASTRAR
                        </button>
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}">
                            Já tem conta? Faça login
                        </a>
                    </div>

                </form>
            </div>
        </div>

        @include('autorizacao.showcase')
    </section>
</div>
@endsection