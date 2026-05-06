<!-- Cabecalho institucional: topo compartilhado pelas views da pasta radape. -->
<header class="radape-header">
    <div class="radape-shell radape-header__inner">
        <!-- Link da logo: imagem clicavel que leva o usuario para o cardapio. -->
        <a href="{{ route('cardapio.index') }}" class="radape-header__brand" aria-label="Ir para o cardapio">
            <img src="{{ asset('img/figma/radape/logo-mecdonin.png') }}" alt="MecDonin" class="radape-header__logo">
        </a>

    </div>
</header>
