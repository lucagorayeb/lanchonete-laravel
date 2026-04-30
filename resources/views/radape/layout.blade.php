@extends('site.layout')

@section('estilos')
    @php
        $radapeManifestPath = public_path('build/manifest.json');
        $radapeManifest = file_exists($radapeManifestPath) ? file_get_contents($radapeManifestPath) : '';
        $radapeViteReady = str_contains($radapeManifest, '"resources/css/radape.css"');
    @endphp

    @if($radapeViteReady)
        @vite('resources/css/radape.css')
    @else
        <link rel="stylesheet" href="{{ asset('css/radape.css') }}">
    @endif
@endsection

@section('header')
    @include('cabeçalho.institucional')
@endsection

@section('conteudo')
    <!-- Conteudo principal das paginas criadas a partir do Figma. Cada pagina filha preenche esta area. -->
    <div class="radape-page">
        @yield('radape-conteudo')
    </div>
@endsection

@section('footer')
    @include('radape.rodape')
@endsection
