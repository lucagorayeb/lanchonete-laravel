@extends('radape.layout')

@section('titulo', 'Ajuda e Suporte')

@section('radape-conteudo')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4 p-md-5">
                    <h1 class="mb-4 text-center fw-bold ajuda-title" style="color: #03081f; font-family: 'Gabarito', sans-serif;">Central de Ajuda</h1>
                    <p class="lead text-muted text-center mb-5">Como podemos ajudar você hoje?</p>

                    <div class="accordion accordion-flush" id="accordionAjuda">
                        <!-- Pergunta 1 -->
                        <div class="accordion-item mb-3 border rounded shadow-sm">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed fw-bold bg-white text-dark rounded" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Como faço para rastrear meu pedido?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionAjuda">
                                <div class="accordion-body text-muted">
                                    Você pode rastrear o seu pedido diretamente na área "Meus Pedidos" no seu perfil, ou clicar no link enviado para o seu e-mail de cadastro assim que o entregador sair do restaurante.
                                </div>
                            </div>
                        </div>

                        <!-- Pergunta 2 -->
                        <div class="accordion-item mb-3 border rounded shadow-sm">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed fw-bold bg-white text-dark rounded" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Quais são as formas de pagamento aceitas?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionAjuda">
                                <div class="accordion-body text-muted">
                                    Aceitamos pagamentos via PIX, cartões de crédito e débito das principais bandeiras, além de pagamento em dinheiro (com opção de troco) no momento da entrega.
                                </div>
                            </div>
                        </div>

                        <!-- Pergunta 3 -->
                        <div class="accordion-item mb-3 border rounded shadow-sm">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed fw-bold bg-white text-dark rounded" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Como cancelar um pedido?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionAjuda">
                                <div class="accordion-body text-muted">
                                    Cancelamentos só podem ser realizados antes do restaurante iniciar o preparo. Acesse "Meus Pedidos" rapidamente e clique em "Cancelar". Caso o preparo já tenha iniciado, entre em contato com nosso suporte.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 text-center p-4 bg-light rounded-4">
                        <h4 class="fw-bold mb-3">Ainda precisa de ajuda?</h4>
                        <p class="text-muted mb-4">Nossa equipe de suporte está disponível para atender você.</p>
                        <a href="mailto:suporte@mecdonin.com.br" class="btn btn-lg fw-bold px-5 rounded-pill shadow-sm" style="background-color: #ffda09; border: none; color: #03081f;">Falar com o Suporte</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
