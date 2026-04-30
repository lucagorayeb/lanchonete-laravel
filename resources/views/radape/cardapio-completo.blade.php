@extends('radape.layout')

@section('titulo', 'Cardapio Figma')

@section('radape-conteudo')
    @php
        $categorias = [
            'Burgers' => [
                ['nome' => 'Royal Cheese Burger with extra Fries', 'descricao' => '1 McChicken, 1 Big Mac, 1 Royal Cheeseburger, 3 medium sized French Fries e 3 bebidas.', 'preco' => 'GBP 23.10', 'imagem' => 'product-02.png'],
                ['nome' => 'The classics for 3', 'descricao' => 'Combo classico com hamburgueres, batatas medias e bebidas geladas.', 'preco' => 'GBP 23.10', 'imagem' => 'product-03.png'],
                ['nome' => 'Burger family deal', 'descricao' => 'Pedido completo para dividir com hamburguer, fritas e bebida.', 'preco' => 'GBP 23.10', 'imagem' => 'product-04.png'],
            ],
            'Fries' => [
                ['nome' => 'Royal Cheese Burger with extra Fries', 'descricao' => 'Porcao reforcada de fritas com acompanhamento principal.', 'preco' => 'GBP 23.10', 'imagem' => 'product-07.png'],
                ['nome' => 'The classics for 3', 'descricao' => 'Fritas medias para acompanhar combos e bebidas.', 'preco' => 'GBP 23.10', 'imagem' => 'product-08.png'],
                ['nome' => 'Large fries combo', 'descricao' => 'Batatas douradas com porcao generosa para compartilhar.', 'preco' => 'GBP 23.10', 'imagem' => 'product-09.png'],
            ],
            'Cold Drinks' => [
                ['nome' => 'Royal Cheese Burger with extra Fries', 'descricao' => 'Bebida gelada para completar seu pedido MecDonin.', 'preco' => 'GBP 23.10', 'imagem' => 'product-01.png'],
                ['nome' => 'The classics for 3', 'descricao' => 'Refrigerante gelado em tamanho medio para combos.', 'preco' => 'GBP 23.10', 'imagem' => 'product-12.png'],
                ['nome' => 'Fresh drink', 'descricao' => 'Opcao refrescante para acompanhar burgers e fries.', 'preco' => 'GBP 23.10', 'imagem' => 'product-13.png'],
            ],
        ];
    @endphp

    <!-- Hero do cardapio: banner principal do node Desktop - 1 com texto, imagem e avaliacao. -->
    <section class="radape-menu-hero radape-shell">
        <div class="radape-menu-hero__copy">
            <p>Eu amo comer</p>
            <h1>Mecdonin</h1>

            <!-- Selo informativo: pequeno chip visual com tempo de entrega. -->
            <span class="radape-chip">Entrega em 20-25 minutos</span>
        </div>

        <div class="radape-menu-hero__media">
            <img src="{{ asset('img/figma/hero-food.png') }}" alt="Combo com hamburger, batata e bebida">

            <!-- Cartao de avaliacao: resumo visual da nota do restaurante. -->
            <div class="radape-rating-card">
                <strong>3.4</strong>
                <span>★★★★★</span>
                <small>1.360+ avaliacoes</small>
            </div>
        </div>
    </section>

    <!-- Barra de categorias: links em formato de abas para navegar pelo cardapio. -->
    <nav class="radape-category-nav" aria-label="Categorias do cardapio">
        <div class="radape-shell">
            <a href="#burgers" class="is-active">Burgers</a>
            <a href="#fries">Fries</a>
            <a href="#cold-drinks">Cold Drinks</a>
            <a href="#informacoes-cardapio">Informacoes</a>
        </div>
    </nav>

    <!-- Secoes de produtos: cada card e um link visual para um item do menu. -->
    <section class="radape-shell radape-menu-sections">
        @foreach($categorias as $categoria => $produtos)
            <section id="{{ \Illuminate\Support\Str::slug($categoria) }}" class="radape-menu-section">
                <h2 class="{{ $loop->first ? '' : 'is-orange' }}">{{ $categoria }}</h2>

                <div class="radape-product-grid">
                    @foreach($produtos as $produto)
                        <!-- Card de produto: bloco clicavel com texto, preco, imagem e botao circular de adicionar. -->
                        <a href="{{ route('cardapio.index') }}" class="radape-product-card">
                            <span class="radape-product-card__copy">
                                <strong>{{ $produto['nome'] }}</strong>
                                <span>{{ $produto['descricao'] }}</span>
                                <b>{{ $produto['preco'] }}</b>
                            </span>

                            <span class="radape-product-card__media">
                                <img src="{{ asset('img/figma/' . $produto['imagem']) }}" alt="{{ $produto['nome'] }}">
                                <!-- Botao circular: representa a acao de adicionar item ao pedido. -->
                                <span class="radape-add-button" aria-hidden="true">+</span>
                            </span>
                        </a>
                    @endforeach
                </div>
            </section>
        @endforeach
    </section>

    <!-- Informacoes do restaurante: horarios, contato e operacao em tres colunas como no Figma. -->
    <section id="informacoes-cardapio" class="radape-shell radape-info-grid">
        <article>
            <h2>Informacoes de Entregar</h2>
            <p><strong>Segunda-Feira:</strong> 08:00 AM-15:00 PM</p>
            <p><strong>Terca-Feira:</strong> 8:00 AM-15:00 PM</p>
            <p><strong>Quarta-Feira:</strong> 8:00 AM-15:00 PM</p>
            <p><strong>Quinta-Feira:</strong> 8:00 AM-15:00 PM</p>
            <p><strong>Sexta-Feira:</strong> 8:00 AM-15:00 PM</p>
            <p><strong>Tempo Exterminador:</strong> 20 min</p>
        </article>

        <article>
            <h2>Informacoes de Contatos</h2>
            <p>Se voce possui alergias ou qualquer tipo de restricao alimentar, entre em contato conosco.</p>
            <p><strong>Numero de Telefone</strong></p>
            <p>(69) 9 9268-4475</p>
            <p><strong>Website</strong></p>
            <p>https://shre.ink/MecDonin</p>
        </article>

        <article class="is-dark">
            <h2>Horario Operacional</h2>
            <p><strong>Segunda-Feira:</strong> 08:00 AM-15:00 PM</p>
            <p><strong>Terca-Feira:</strong> 8:00 AM-15:00 PM</p>
            <p><strong>Sabado-Feira:</strong> 10:00 AM-15:00 PM</p>
            <p><strong>Domingo/Feriados:</strong> 12:00 AM-14:00 PM</p>
        </article>
    </section>

    <!-- Avaliacoes: cards de depoimentos de clientes, seguindo a area inferior do Figma. -->
    <section class="radape-reviews">
        <div class="radape-shell">
            <div class="radape-reviews__head">
                <h2>Avaliacoes de Clientes</h2>
                <div class="radape-review-buttons" aria-hidden="true">
                    <span>‹</span>
                    <span>›</span>
                </div>
            </div>

            <div class="radape-review-grid">
                @for($i = 0; $i < 3; $i++)
                    <article class="radape-review-card">
                        <h3>St Glx <span>South London</span></h3>
                        <p>The positive aspect was undoubtedly the efficiency of the service. The queue moved quickly, the staff was friendly, and the food was hot and satisfying.</p>
                        <strong>★★★★★</strong>
                    </article>
                @endfor
            </div>
        </div>
    </section>
@endsection
