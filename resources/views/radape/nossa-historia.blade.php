@extends('radape.layout')

@section('titulo', 'Nossa Historia')

@section('radape-conteudo')
    <!-- Imagem principal: reproduz o grande banner fotografico do node "Nossa Historia" no Figma. -->
    <section class="radape-story-hero">
        <div class="radape-shell">
            <img src="{{ asset('img/figma/radape/nossa-historia.png') }}" alt="Fachada ilustrada do MecDonin" class="radape-story-hero__image">
        </div>
    </section>

    <!-- Artigo textual: bloco de leitura com titulo e paragrafos da historia da marca. -->
    <article class="radape-shell radape-article">
        <h1>Origem do MecDonin</h1>

        <p>Era uma vez, no coracao de um reino moldado pelo silicio e pelo vapor, um automato lendario chamado Mecdonin. Ele era uma criatura de engrenagens precisas, construido para ser o guardiao da logica em um mundo que muitas vezes sucumbia ao caos.</p>

        <p>Certo dia, Mecdonin cruzou as fronteiras de seu territorio e encontrou o Reino da Grelha de Fogo, governado pelos soberanos conhecidos como os Burger Kings. Diferente do mundo de Mecdonin, onde tudo era binario e exato, este novo reino era movido pelo aroma de carne grelhada e pelo som de coroas de papel sendo ajustadas.</p>

        <p>A lenda conta que houve um impasse inicial. Os Burger Kings viviam pelo lema de que "cada um tem o seu jeito", enquanto Mecdonin buscava a padronizacao perfeita. No entanto, o conflito logo se transformou em uma alianca epica. Mecdonin percebeu que, para manter sua estrutura metalica funcionando, ele precisava de um tipo de combustivel que apenas as chamas dos Reis poderiam fornecer.</p>

        <p>Dessa uniao, surgiu uma nova era. Mecdonin usou sua inteligencia processual para otimizar as linhas de montagem dos banquetes reais, enquanto os Burger Kings coroaram o automato como o "Protetor do Menu". Dizem que, ate hoje, Mecdonin viaja entre as torres de metal e as pracas de alimentacao, garantindo que a ordem da tecnologia e o prazer do banquete coexistam em perfeito equilibrio, sempre ostentando uma coroa dourada sobre seu chassi de aco.</p>
    </article>
@endsection
