@extends('site.layout')

@section('titulo', 'Cardápio')

@php
    $imageSets = [
        'Burgers' => ['hero-food.png', 'promo-food.png', 'product-02.png', 'product-03.png', 'product-04.png', 'product-05.png', 'product-06.png'],
        'Fries' => ['product-07.png', 'product-08.png', 'product-09.png', 'product-10.png', 'product-11.png'],
        'Cold Drinks' => ['product-01.png', 'product-12.png', 'product-13.png', 'product-14.png', 'product-15.png', 'product-16.png', 'product-17.png'],
    ];

    $categoryId = [
        'Burgers' => 'burgers',
        'Fries' => 'fries',
        'Cold Drinks' => 'cold-drinks',
    ];

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

    $categoryFromName = function ($nome) {
        $nome = strtolower((string) $nome);

        if (str_contains($nome, 'batata') || str_contains($nome, 'frita') || str_contains($nome, 'fries')) {
            return 'Fries';
        }

        if (
            str_contains($nome, 'coca') ||
            str_contains($nome, 'suco') ||
            str_contains($nome, 'agua') ||
            str_contains($nome, 'bebida') ||
            str_contains($nome, 'refri') ||
            str_contains($nome, 'drink')
        ) {
            return 'Cold Drinks';
        }

        return 'Burgers';
    };

    $produtosCollection = collect($produtos ?? [])->values();

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

    $sections = collect(['Burgers', 'Fries', 'Cold Drinks'])
        ->map(function ($categoria) use ($menuProdutos, $categoryId) {
            return [
                'id' => $categoryId[$categoria],
                'title' => $categoria,
                'items' => $menuProdutos->where('categoria', $categoria)->values(),
            ];
        })
        ->filter(fn ($section) => $section['items']->isNotEmpty())
        ->values();

    $mapsUrl = 'https://www.google.com/maps/search/Complexo+Rio+Madeira+-+Av.+Farquar,+2986+-+Pedrinhas,+Porto+Velho+-+RO/@-8.7531744,-63.9143679,5197m/data=!3m2!1e3!4b1?entry=ttu&g_ep=EgoyMDI2MDQyNi4wIKXMDSoASAFQAw%3D%3D';

    $clienteLogado = session()->has('cliente_id');
    $carrinho = collect(session('carrinho', []));
    $cartCount = (int) session('carrinhoCount', $carrinho->sum('quantidade'));
    $cartTotal = (float) session('carrinhoTotal', $carrinho->sum(fn ($item) => ($item['preco'] ?? 0) * ($item['quantidade'] ?? 0)));
    $perfilOuLoginRoute = $clienteLogado ? route('perfil.index') : route('autorizacao.login');
    $fallbackProdutoRoute = route('cardapio.index') . '#cardapio';
@endphp

@section('estilos')
    @vite(['resources/css/cardapio.css', 'resources/css/radape.css'])
@endsection

@section('header')
<!-- Cabeçalho Principal da Página -->
<header class="figma-site-header">
    <div class="container-xl figma-shell figma-promo-strip d-flex flex-column flex-lg-row align-items-center justify-content-between gap-2">
        <p class="mb-0">
            <span class="figma-spark" aria-hidden="true"></span>
            Ganhe 5% de desconto no seu primeiro pedido, Cupom: <strong>MecDonin5</strong>
        </p>

        <div class="figma-promo-meta d-flex flex-wrap align-items-center justify-content-center justify-content-lg-end gap-3">
            <span class="figma-location-preview">
                <span class="figma-pin" aria-hidden="true"></span>
                <span data-location-status>
                    {{ $clienteLogado ? 'Cadastre sua localização manualmente' : 'Nome da rua, Cidade' }}
                </span>
            </span>

            <a
                href="{{ $perfilOuLoginRoute }}"
                class="figma-location-action"
                @unless($clienteLogado) data-guest-location @endunless
            >
                {{ $clienteLogado ? 'Cadastrar localização' : 'Pegar Minha Localização' }}
            </a>

            <a href="{{ route('pedido.ver') }}" class="figma-cart-bar" aria-label="Abrir carrinho">
                <span class="figma-cart-visual" aria-hidden="true">
                    <span class="figma-cart-check"></span>
                </span>

                <span>{{ str_pad($cartCount, 2, '0', STR_PAD_LEFT) }} Items</span>
                <span>R$ {{ $cartTotal > 0 ? number_format($cartTotal, 2, ',', '.') : '00,00' }}</span>
                <span class="figma-cart-arrow" aria-hidden="true">↓</span>
            </a>
        </div>
    </div>

    @push('scripts')
        @vite('resources/js/cookieslocalizacao.js')
    @endpush

    <div class="container-xl figma-shell figma-topbar d-flex flex-column flex-lg-row align-items-center justify-content-between gap-3">
        <a href="{{ route('bemvindo.index') }}" class="figma-brand" aria-label="MecDonin">
            <img src="{{ asset('img/figma/radape/logo-mecdonin.png') }}" alt="MecDonin">
        </a>

        <nav class="figma-actions d-flex flex-wrap align-items-center justify-content-center justify-content-lg-end gap-2" aria-label="Ações do cardápio">
            <a href="{{ $perfilOuLoginRoute }}" class="figma-pill-link is-dark">
                <span class="figma-login-dot" aria-hidden="true"></span>
                Entrar/Cadastrar-se
            </a>
        </nav>
    </div>
</header>
@endsection

@section('conteudo')
    <section class="container-xl figma-shell figma-hero" aria-label="Destaque MecDonin">
        <div class="row align-items-center g-4">
            <div class="col-12 col-lg-6 figma-hero-copy">
                <p class="figma-hero-kicker">Eu amo comer</p>
                <h1 class="figma-hero-title">Mecdonin</h1>

                <div class="figma-hero-meta" aria-label="Informacoes rapidas">
                    <span class="figma-meta-chip">
                        <span class="figma-clock-dot" aria-hidden="true"></span>
                        Preparo em 20-25 minutos
                    </span>
                </div>
            </div>

            <div class="col-12 col-lg-6 figma-hero-media">
                <img class="figma-hero-food" src="{{ asset('img/figma/hero-food.png') }}" alt="Combo de hamburger com batata e bebida">

                <div class="figma-rating-card" aria-label="Avaliacao 3.4 de 5">
                    <div>
                        <strong>3.4</strong>
                        <div class="figma-stars">★★★★★</div>
                        <small>1,360 reviews</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="figma-delivery-tab">
            <span aria-hidden="true">🛵</span>
            Entrega em 20-25 minutos
        </div>
    </section>

    <section class="figma-offers-head py-4" aria-label="Busca no cardápio">
        <div class="container-xl figma-shell">
            <div class="row align-items-center g-3">
                <h2 class="col-12 col-lg mb-0">Todas as ofertas do MecDonin</h2>

                <label class="col-12 col-lg-auto figma-search-field">
                    <span>⌕</span>
                    <input type="search" placeholder="Pesquisar no menu..." data-menu-search>
                </label>
            </div>
        </div>
    </section>

    <nav class="figma-category-bar" aria-label="Categorias do cardápio">
        <div class="container-xl figma-shell figma-category-list d-flex align-items-center gap-2">
            @foreach($categoryTabs as $tab)
                <a href="#{{ $tab['id'] }}" class="figma-category-link {{ $loop->first ? 'active' : '' }}">
                    {{ $tab['title'] }}
                </a>
            @endforeach
        </div>
    </nav>

    <main id="cardapio" class="container-xl figma-shell figma-main">
        @foreach($sections as $section)
            <section id="{{ $section['id'] }}" class="figma-section" data-menu-section>
                <h2 class="figma-section-title {{ $loop->first ? '' : 'is-orange' }}">
                    {{ $section['title'] }}
                </h2>

                <div class="row g-4 figma-grid">
                    @foreach($section['items'] as $item)
                        @php
                            $produtoId = $item['id'] ?? null;
                            $href = $produtoId ? route('produto.show.id', ['id' => $produtoId]) : $fallbackProdutoRoute;
                        @endphp

                        <div class="col-12 col-md-6 col-lg-4">
                            <a
                                href="{{ $href }}"
                                class="figma-menu-card h-100"
                                data-menu-card
                                data-search="{{ strtolower($item['nome'] . ' ' . $item['descricao'] . ' ' . $section['title']) }}"
                            >
                                <div class="figma-card-copy">
                                    <h3 class="figma-card-title">{{ $item['nome'] }}</h3>
                                    <p class="figma-card-desc">{{ $item['descricao'] }}</p>
                                    <strong class="figma-card-price">
                                        R$ {{ number_format($item['preco'], 2, ',', '.') }}
                                    </strong>
                                </div>

                                <div class="figma-card-media">
                                    <img src="{{ asset('img/figma/' . $item['image']) }}" alt="{{ $item['nome'] }}">
                                    <span class="figma-plus" aria-hidden="true"></span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach

        @if($menuProdutos->isEmpty())
            <div class="figma-empty is-visible">
                Nenhum produto cadastrado no banco de dados. Cadastre produtos para eles aparecerem aqui no cardápio.
            </div>
        @endif

        <div class="figma-empty" data-menu-empty>
            Nenhum item encontrado para essa busca.
        </div>

        <section class="figma-map" aria-label="Localização MecDonin">
            <a
                class="figma-map-link"
                href="{{ $mapsUrl }}"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Abrir localizacao da MecDonin no Google Maps"
            >
                <img src="{{ asset('img/figma/map.png') }}" alt="Mapa da localização MecDonin em Porto Velho">
            </a>

            <div class="figma-map-card">
                <h3>MecDonin</h3>
                <p>Complexo Rio Madeira - Av. Farquar, 2986 - Pedrinhas, Porto Velho - RO</p>

                <p>
                    <strong>Numero de Telefone</strong><br>
                    <span class="is-orange">(69) 9 9268-4476</span>
                </p>

                <p>
                    <strong>Website</strong><br>
                    <span class="is-orange">https://shre.ink/MecDonin</span>
                </p>
            </div>
        </section>
    </main>

    <section id="avaliacoes" class="figma-reviews">
        <div class="container-xl figma-shell">
            <div class="figma-review-head d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <h2>Avaliações de Clientes</h2>

                <div class="figma-review-actions d-flex gap-2" aria-hidden="true">
                    <span class="figma-circle-btn">‹</span>
                    <span class="figma-circle-btn">›</span>
                </div>
            </div>

            <div class="row g-3 figma-review-grid">
                <article class="col-12 col-md-6 col-lg-4">
                    <div class="figma-review-card h-100">
                        <div class="figma-review-top">
                            <div class="figma-review-person">
                                <span class="figma-avatar">S</span>

                                <div>
                                    <p class="figma-review-name">St Glx</p>
                                    <p class="figma-review-city">South London</p>
                                </div>
                            </div>

                            <span class="figma-review-date">24th September, 2023</span>
                            <span class="figma-stars">★★★★★</span>
                        </div>

                        <p>
                            The positive aspect was undoubtedly the efficiency of the service.
                            The queue moved quickly, the staff was friendly, and the food was up
                            to the usual McDonald's standard - hot and satisfying.
                        </p>
                    </div>
                </article>

                <article class="col-12 col-md-6 col-lg-4">
                    <div class="figma-review-card h-100">
                        <div class="figma-review-top">
                            <div class="figma-review-person">
                                <span class="figma-avatar">S</span>

                                <div>
                                    <p class="figma-review-name">St Glx</p>
                                    <p class="figma-review-city">South London</p>
                                </div>
                            </div>

                            <span class="figma-review-date">24th September, 2023</span>
                            <span class="figma-stars">★★★★★</span>
                        </div>

                        <p>
                            The positive aspect was undoubtedly the efficiency of the service.
                            The queue moved quickly, the staff was friendly, and the food was up
                            to the usual McDonald's standard - hot and satisfying.
                        </p>
                    </div>
                </article>

                <article class="col-12 col-md-6 col-lg-4">
                    <div class="figma-review-card h-100">
                        <div class="figma-review-top">
                            <div class="figma-review-person">
                                <span class="figma-avatar">S</span>

                                <div>
                                    <p class="figma-review-name">St Glx</p>
                                    <p class="figma-review-city">South London</p>
                                </div>
                            </div>

                            <span class="figma-review-date">24th September, 2023</span>
                            <span class="figma-stars">★★★★★</span>
                        </div>

                        <p>
                            The positive aspect was undoubtedly the efficiency of the service.
                            The queue moved quickly, the staff was friendly, and the food was up
                            to the usual McDonald's standard - hot and satisfying.
                        </p>
                    </div>
                </article>
            </div>

        <!--     <div class="figma-rating-summary" aria-label="Avaliação média 3.4 de 5">
                <strong>3.4</strong>
                <span class="figma-stars">★★★☆☆</span>
                <small>1.360 reviews</small>
            </div> _    -->
        </div>
    </section>
@endsection


@section('footer')
    @include('radape.layout')
@endsection