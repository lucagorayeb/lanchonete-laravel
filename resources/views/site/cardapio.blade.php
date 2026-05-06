@extends('site.layout')

@section('titulo', 'Cardápio')

@section('estilos')
    @vite('resources/css/cardapio.css')
    @vite('resources/css/radape.css')
@endsection

@section('header')
<!-- Cabeçalho Principal da Página -->
<header class="figma-site-header">
    <!-- Faixa superior com cupom (condicional), localização e carrinho -->
    <div class="container-xl figma-shell figma-promo-strip d-flex flex-column flex-lg-row align-items-center justify-content-between gap-2">
        <!-- Texto do cupom: só aparece se o cliente nunca fez um pedido na loja -->
        @if($isFirstOrder)
        <p class="mb-0"><span class="figma-spark" aria-hidden="true"></span> Ganhe 5% de desconto no seu primeiro pedido, Cupom: <strong>MecDonin5</strong></p>
        @endif
        <div class="figma-promo-meta d-flex flex-wrap align-items-center justify-content-center justify-content-lg-end gap-3 ms-auto">
            <!-- Localização via GPS (salva em cookie) -->
            <span class="figma-location-preview">
                <span class="figma-pin" aria-hidden="true"></span>
                <span data-location-status>Nome da rua, Cidade</span>
            </span>
            <!-- Botão para capturar localização via GPS do navegador (salva em cookie) -->
            <a
                href="#"
                class="figma-location-action"
                data-guest-location
            >
                Pegar Minha Localização
            </a>
            <!-- Container do Carrinho e Sidebar -->
            <div class="figma-cart-container position-relative">
                <div class="figma-cart-bar">
                    <!-- Link do Carrinho (ícone) que leva para a página de pedidos -->
                    <a href="{{ route('pedido.ver') }}" class="figma-cart-visual" aria-label="Abrir carrinho">
                        <span class="figma-cart-check"></span>
                    </a>
                    <span>{{ str_pad($cartCount, 2, '0', STR_PAD_LEFT) }} Items</span>
                    <span>R$ {{ $cartTotal > 0 ? number_format($cartTotal, 2, ',', '.') : '00,00' }}</span>
                    <button type="button" class="figma-cart-arrow btn p-0" aria-label="Mostrar carrinho" onclick="document.getElementById('cartSidebar').classList.toggle('is-open')"></button>
                </div>

                <!-- Sidebar do Carrinho -->
                <div id="cartSidebar" class="cart-sidebar shadow-lg">
                    <div class="cart-sidebar-items">
                        @forelse($carrinho as $id => $item)
                            <div class="cart-item">
                                <img src="{{ asset('img/figma/' . ($item['image'] ?? 'hero-food.png')) }}" alt="{{ $item['nome'] ?? 'Produto' }}" class="cart-item-img rounded">
                                <div class="cart-item-info">
                                    <h4 class="cart-item-title">{{ $item['nome'] ?? 'Produto' }}</h4>
                                    <div class="cart-item-controls d-flex align-items-center gap-1">
                                        <form action="{{ route('remover.unidade.item.pedido', ['id' => $id]) }}" method="POST" class="d-inline m-0 p-0" onsubmit="submitCartAjax(event, this)">
                                            @csrf
                                            <button type="submit" class="btn btn-sm cart-btn-minus" aria-label="Diminuir quantidade"></button>
                                        </form>
                                        <span class="cart-item-qty badge bg-secondary">{{ $item['quantidade'] ?? 1 }}</span>
                                        <form action="{{ route('adicionar.unidade.item.pedido', ['id' => $id]) }}" method="POST" class="d-inline m-0 p-0" onsubmit="submitCartAjax(event, this)">
                                            @csrf
                                            <button type="submit" class="btn btn-sm cart-btn-plus" aria-label="Aumentar quantidade"></button>
                                        </form>
                                        <form action="{{ route('remover.item.pedido', ['id' => $id]) }}" method="POST" class="d-inline m-0 p-0 ms-2" onsubmit="submitCartAjax(event, this)">
                                            @csrf
                                            <button type="submit" class="btn btn-sm cart-btn-trash" aria-label="Remover produto">🗑</button>
                                        </form>
                                    </div>
                                    <strong class="cart-item-price">R$ {{ number_format(($item['preco'] ?? 0) * ($item['quantidade'] ?? 1), 2, ',', '.') }}</strong>
                                </div>
                            </div>
                        @empty
                            <div class="cart-empty-msg text-center text-muted p-3">Seu carrinho está vazio.</div>
                        @endforelse
                    </div>
                    <div class="cart-sidebar-footer">
                        <div class="d-flex justify-content-between w-100">
                            <span>Valor:</span>
                            <span>R$ {{ $cartTotal > 0 ? number_format($cartTotal, 2, ',', '.') : '00,00' }}</span>
                        </div>
                        <a href="{{ route('pedido.ver') }}" class="btn btn-warning w-100 fw-bold btn-checkout-sidebar">Finalizar Pedido</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Barra do Logo + Botão de Login -->
    <div class="container-xl figma-shell figma-topbar d-flex flex-column flex-lg-row align-items-center justify-content-between gap-3">
        <a href="{{ route('bemvindo.index') }}" class="figma-brand" aria-label="MecDonin">
            <img src="{{ asset('img/figma/radape/logo-mecdonin.png') }}" alt="MecDonin">
        </a>

        <nav class="figma-actions d-flex flex-wrap align-items-center justify-content-center justify-content-lg-end gap-2" aria-label="Ações do cardápio">
            <a href="{{ $perfilOuLoginRoute }}" class="btn btn-dark btn-sm rounded-pill figma-pill-link is-dark">
                <span class="figma-login-dot" aria-hidden="true"></span> Entrar/Cadastrar-se
            </a>
        </nav>
    </div>
</header>
@endsection

@section('conteudo')
    <!-- Seção Principal de Destaque (Hero Section) -->
    <section class="container-xl figma-shell figma-hero" aria-label="Destaque MecDonin">
        <div class="row align-items-center g-4">
            <!-- Área de texto do Hero -->
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

            <!-- Imagem do Hero -->
            <div class="col-12 col-lg-6 figma-hero-media">
                <img class="figma-hero-food img-fluid" src="{{ asset('img/figma/hero-food.png') }}" alt="Combo de hamburger com batata e bebida">
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

    <!-- Seção de Busca -->
    <section class="figma-offers-head py-4" aria-label="Busca no cardápio">
        <div class="container-xl figma-shell">
            <div class="row align-items-center g-3">
                <h2 class="col-12 col-lg mb-0">Todas as ofertas do MecDonin</h2>
                <!-- Campo de Busca -->
                <label class="col-12 col-lg-auto figma-search-field">
                    <span>⌕</span>
                    <input type="search" placeholder="Pesquisar no menu..." data-menu-search>
                </label>
            </div>
        </div>
    </section>

    <!-- Barra de Navegação de Categorias (Pills) -->
    <nav class="figma-category-bar" aria-label="Categorias do cardápio">
        <div class="container-xl figma-shell figma-category-list d-flex align-items-center gap-2 overflow-auto">
            @foreach($categoryTabs as $tab)
                <a href="#{{ $tab['id'] }}" class="figma-category-link {{ $loop->first ? 'active' : '' }}">
                    {{ $tab['title'] }}
                </a>
            @endforeach
        </div>
    </nav>

    <!-- Conteúdo Principal do Cardápio -->
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

                        <!-- Cartão do Produto -->
                        <div class="col-12 col-md-6 col-lg-4">
                            <a href="{{ $href }}" class="figma-menu-card h-100 text-decoration-none" data-menu-card data-search="{{ strtolower($item['nome'] . ' ' . $item['descricao'] . ' ' . $section['title']) }}">
                                <div class="figma-card-copy">
                                    <h3 class="figma-card-title">{{ $item['nome'] }}</h3>
                                    <p class="figma-card-desc">{{ $item['descricao'] }}</p>
                                    <strong class="figma-card-price">
                                        R$ {{ number_format($item['preco'], 2, ',', '.') }}
                                    </strong>
                                </div>

                                <div class="figma-card-media">
                                    <img src="{{ asset('img/figma/' . $item['image']) }}" alt="{{ $item['nome'] }}" class="rounded">
                                    <span class="figma-plus" aria-hidden="true"></span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach

        @if($menuProdutos->isEmpty())
            <div class="alert alert-warning text-center figma-empty is-visible" role="alert">
                Nenhum produto cadastrado no banco de dados. Cadastre produtos para eles aparecerem aqui no cardápio.
            </div>
        @endif

        <div class="figma-empty" data-menu-empty>Nenhum item encontrado para essa busca.</div>

        <!-- Informações do Restaurante -->
        <section id="informacoes" class="row g-0 figma-info-grid">
            <article class="col-12 col-lg-4 figma-info-card">
                <h2 class="figma-info-title"><span class="figma-small-icon">✹</span> Informações de Entregar</h2>
                <p><strong>Segunda-Feira:</strong> 08:00 AM-15:00 PM</p>
                <p><strong>Terça-Feira:</strong> 8:00 AM-15:00 PM</p>
                <p><strong>Quarta-Feira:</strong> 8:00 AM-15:00 PM</p>
                <p><strong>Quinta-Feira:</strong> 8:00 AM-15:00 PM</p>
                <p><strong>Sexta-Feira:</strong> 8:00 AM-15:00 PM</p>
                <p><strong>Sábado-Feira:</strong> 10:00 AM-15:00 PM</p>
                <p><strong>Domingo-Feira/Feriados :</strong> 12:00 AM-14:00 PM</p>
                <p><strong>Tempo Exterminador:</strong> 20 min</p>
            </article>

            <article class="col-12 col-lg-4 figma-info-card">
                <h2 class="figma-info-title"><span class="figma-small-icon">♙</span> Informações de Contatos</h2>
                <p>Se você possui alergias ou qualquer tipo de restrição alimentar, entre em contato conosco.</p>
                <p>Teremos o prazer de fornecer informações detalhadas sobre os pratos, mediante solicitação.</p>
                <p><strong>Numero de Telefone</strong></p>
                <p>(69) 9 9268-4475</p>
                <p><strong>Website</strong></p>
                <p>https://shre.ink/MecDonin</p>
            </article>

            <article class="col-12 col-lg-4 figma-info-card is-dark">
                <h2 class="figma-info-title"><span class="figma-small-icon">◔</span> Horário Operacional</h2>
                <p><strong>Segunda-Feira:</strong> 08:00 AM-15:00 PM</p>
                <p><strong>Terça-Feira:</strong> 8:00 AM-15:00 PM</p>
                <p><strong>Quarta-Feira:</strong> 8:00 AM-15:00 PM</p>
                <p><strong>Quinta-Feira:</strong> 8:00 AM-15:00 PM</p>
                <p><strong>Sexta-Feira:</strong> 8:00 AM-15:00 PM</p>
                <p><strong>Sábado-Feira:</strong> 10:00 AM-15:00 PM</p>
                <p><strong>Domingo-Feira/Feriados :</strong> 12:00 AM-14:00 PM</p>
            </article>
        </section>

        <!-- Mapa -->
        <section class="figma-map" aria-label="Localização MecDonin">
            <a class="figma-map-link" href="{{ $mapsUrl }}" target="_blank" rel="noopener noreferrer" aria-label="Abrir localizacao da MecDonin no Google Maps">
                <img src="{{ asset('img/figma/map.png') }}" alt="Mapa da localização MecDonin em Porto Velho" class="img-fluid w-100">
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

    <!-- Seção de Avaliações (Reviews) -->
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
                @for($i = 0; $i < 3; $i++)
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
                @endfor
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
    @include('radape.rodape')
@endsection