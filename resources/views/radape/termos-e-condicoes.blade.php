@extends('radape.layout')

@section('titulo', 'Termos e Condicoes')

@section('radape-conteudo')
    <!-- Artigo legal: pagina extensa de termos, separada do CSS e estruturada com titulos/listas. -->
    <article class="radape-shell radape-article">
        <h1>TERMOS E CONDICOES DE USO</h1>

        <h2>Aceitacao dos Termos</h2>
        <p>Ao acessar, navegar, cadastrar-se ou realizar qualquer pedido por meio da plataforma MecDonin, seja via site, aplicativo ou qualquer outro canal digital ou fisico disponibilizado, o usuario declara que leu, compreendeu e concorda integralmente com todos os termos, condicoes e disposicoes aqui estabelecidas.</p>
        <p>Caso o usuario nao concorde, total ou parcialmente, com qualquer disposicao deste instrumento, devera abster-se imediatamente de utilizar os servicos da MecDonin.</p>

        <h2>Objeto e Natureza dos Servicos</h2>
        <p>A MecDonin e uma plataforma destinada a comercializacao de alimentos e bebidas, atuando por meio de atendimento presencial, retirada no local e/ou entrega, conforme disponibilidade.</p>
        <p>Os servicos oferecidos possuem natureza alimentar e perecivel, estando sujeitos a variacoes decorrentes de preparo, transporte, tempo, armazenamento, clima e demanda operacional.</p>
        <p>A MecDonin nao garante que produtos apresentados em imagens, descricoes ou anuncios correspondam exatamente ao produto final entregue, sendo tais representacoes meramente ilustrativas.</p>

        <h2>Cadastro e Responsabilidade do Usuario</h2>
        <p>Para utilizacao de determinadas funcionalidades, o usuario podera ser solicitado a fornecer dados pessoais, incluindo:</p>
        <ul>
            <li>Nome completo</li>
            <li>Numero de telefone</li>
            <li>Endereco de entrega</li>
        </ul>
        <p>O usuario declara que todas as informacoes fornecidas sao verdadeiras, atualizadas e completas, assumindo total responsabilidade por eventuais erros, omissoes ou inconsistencias.</p>

        <h2>Realizacao de Pedidos</h2>
        <p>Os pedidos realizados por meio da MecDonin sao considerados validos e vinculantes a partir do momento de sua confirmacao.</p>
        <p>A MecDonin reserva-se o direito de:</p>
        <ul>
            <li>Recusar pedidos sem necessidade de justificativa.</li>
            <li>Cancelar pedidos em caso de suspeita de fraude, erro ou indisponibilidade.</li>
            <li>Alterar ou substituir itens conforme disponibilidade.</li>
        </ul>

        <h2>Precos e Pagamentos</h2>
        <p>Os precos dos produtos poderao ser alterados a qualquer momento, sem aviso previo, sendo considerados validos aqueles apresentados no momento da confirmacao do pedido.</p>
        <p>A MecDonin podera aceitar diferentes formas de pagamento, incluindo dinheiro, cartao e PIX, podendo restringir ou alterar tais opcoes a qualquer momento.</p>
        <p>O nao pagamento integral do pedido implicara no cancelamento automatico da solicitacao.</p>

        <h2>Entrega e Logistica</h2>
        <p>Os prazos de entrega informados sao meramente estimativos e podem sofrer variacoes em razao de fatores externos, tais como:</p>
        <ul>
            <li>Condicoes climaticas.</li>
            <li>Transito.</li>
            <li>Alta demanda.</li>
            <li>Problemas operacionais.</li>
        </ul>
        <p>A MecDonin nao garante o cumprimento exato dos prazos informados e nao sera responsavel por atrasos.</p>

        <h2>Cancelamento e Reembolso</h2>
        <p>Cancelamentos poderao ser aceitos exclusivamente antes do inicio do preparo do pedido. Apos iniciado o preparo, nao sera possivel cancelar o pedido, em razao da natureza perecivel dos produtos.</p>
        <p>Reembolsos nao sao automaticos e serao analisados individualmente, a criterio exclusivo da MecDonin.</p>

        <h2>Trocas e Reclamacoes</h2>
        <p>O usuario devera verificar o pedido no ato do recebimento. Eventuais reclamacoes deverao ser realizadas imediatamente apos a entrega, sendo facultado a MecDonin analisar, aceitar ou recusar a solicitacao.</p>

        <h2>Limitacao de Responsabilidade</h2>
        <p>A MecDonin nao sera responsavel por quaisquer danos diretos, indiretos, incidentais ou consequenciais decorrentes do uso de seus servicos, incluindo:</p>
        <ul>
            <li>Insatisfacao do cliente.</li>
            <li>Divergencia de expectativa.</li>
            <li>Problemas decorrentes do consumo dos alimentos.</li>
            <li>Alergias ou restricoes alimentares nao informadas.</li>
        </ul>
        <p>Os servicos sao fornecidos "no estado em que se encontram", sem garantias expressas ou implicitas.</p>

        <h2>Alergias e Seguranca Alimentar</h2>
        <p>O usuario declara estar ciente de que os alimentos podem conter tracos de alergenicos devido a possibilidade de contaminacao cruzada. Cabe exclusivamente ao usuario informar previamente quaisquer restricoes alimentares.</p>

        <h2>Propriedade Intelectual</h2>
        <p>Todo o conteudo da MecDonin, incluindo marcas, logotipos, layout, textos e imagens, e protegido por legislacao de propriedade intelectual, sendo vedado seu uso sem autorizacao.</p>

        <h2>Privacidade e Dados</h2>
        <p>Os dados fornecidos pelo usuario poderao ser utilizados para fins operacionais, comerciais e de melhoria dos servicos. A MecDonin nao se responsabiliza por falhas externas de seguranca fora de seu controle.</p>

        <h2>Alteracoes dos Termos</h2>
        <p>A MecDonin reserva-se o direito de modificar estes Termos e Condicoes a qualquer momento, sem aviso previo. E responsabilidade do usuario revisar periodicamente este documento.</p>

        <h2>Rescisao</h2>
        <p>A MecDonin podera suspender ou encerrar o acesso do usuario a qualquer momento, sem aviso, em caso de descumprimento destes termos ou por decisao unilateral.</p>

        <h2>Disposicoes Gerais</h2>
        <p>Caso qualquer clausula seja considerada invalida ou inexequivel, as demais permanecerao em pleno vigor. Estes termos constituem o acordo integral entre as partes, substituindo quaisquer entendimentos anteriores.</p>

        <h2>Foro</h2>
        <p>Fica eleito o foro da comarca da sede da MecDonin para dirimir quaisquer conflitos oriundos deste contrato, com renuncia expressa a qualquer outro, por mais privilegiado que seja.</p>
    </article>
@endsection
