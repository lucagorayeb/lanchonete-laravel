@extends('site.layout')

@section('titulo', 'Login Administrativo')

@section('estilos')
    @vite('resources/css/admin.css')
@endsection

@section('conteudo')
<div class="page-header">
    <h2 style="color: #333;">Acesso Administrativo</h2>
    <p>Área restrita a funcionários do MecDonin.</p>
</div>

<div class="form-container">
    @if ($errors->any())
        <div style="background: #fce8e6; color: #d93025; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.login.post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label" for="email">E-mail Corporativo</label>
            <input type="email" id="email" name="email" class="form-control" required placeholder="admin@mecdonin.com" value="{{ old('email') }}">
        </div>
        
        <div class="form-group">
            <label class="form-label" for="password">Senha</label>
            <input type="password" id="password" name="password" class="form-control" required placeholder="Sua senha">
        </div>

        <button type="submit" class="btn-primary">Entrar no Painel</button>
    </form>
    
    <div style="text-align: center; margin-top: 20px;">
        <a href="{{ route('bemvindo.index') }}" style="color: var(--color-text-muted); text-decoration: underline;">Voltar para o site principal</a>
    </div>
</div>
@endsection
