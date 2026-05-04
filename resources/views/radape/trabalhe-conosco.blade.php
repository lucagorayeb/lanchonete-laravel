@extends('radape.layout')

@section('titulo', 'Trabalhe Conosco')

@section('radape-conteudo')
<div class="container my-5">
    <div class="row align-items-center mb-5 py-4">
        <div class="col-lg-6 mb-4 mb-lg-0 pe-lg-5">
            <span class="badge text-dark mb-3 px-3 py-2 rounded-pill" style="background-color: #ffda09;">Vagas Abertas</span>
            <h1 class="trabalhe-title fw-bold mb-4" style="color: #03081f; font-family: 'Gabarito', sans-serif;">Faça parte da nossa equipe!</h1>
            <p class="lead text-muted mb-4">Estamos sempre em busca de talentos apaixonados por comida, atendimento excepcional e inovação. Venha crescer com o MecDonin!</p>
            <a href="#vagas" class="btn btn-dark btn-lg fw-bold px-4 rounded-pill">Ver Vagas</a>
        </div>
        <div class="col-lg-6">
            <img src="{{ asset('img/fundo.jpg') }}" class="img-fluid rounded-4 shadow-lg" alt="Equipe MecDonin" style="max-height: 450px; width: 100%; object-fit: cover;">
        </div>
    </div>

    <div class="row mb-5 text-center">
        <div class="col-12 mb-4">
            <h2 class="fw-bold" style="color: #03081f; font-family: 'Gabarito', sans-serif;">Por que trabalhar aqui?</h2>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 p-4 transition-hover">
                <div class="card-body">
                    <div class="emoji-icon mb-3">🍔</div>
                    <h4 class="fw-bold mb-3">Ambiente Incrível</h4>
                    <p class="text-muted mb-0">Trabalhe em um lugar onde a criatividade e a paixão pela comida são celebradas diariamente.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 p-4 transition-hover">
                <div class="card-body">
                    <div class="emoji-icon mb-3">🚀</div>
                    <h4 class="fw-bold mb-3">Crescimento</h4>
                    <p class="text-muted mb-0">Oferecemos planos de carreira e oportunidades contínuas de desenvolvimento profissional.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 p-4 transition-hover">
                <div class="card-body">
                    <div class="emoji-icon mb-3">💛</div>
                    <h4 class="fw-bold mb-3">Benefícios</h4>
                    <p class="text-muted mb-0">Salário competitivo, plano de saúde, vale alimentação e, claro, descontos em nossos produtos.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center" id="vagas">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header border-0 text-center py-4" style="background-color: #ffda09;">
                    <h3 class="fw-bold mb-0" style="color: #03081f; font-family: 'Gabarito', sans-serif;">Envie seu currículo</h3>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form action="#" method="POST">
                        <div class="mb-4">
                            <label for="nome" class="form-label fw-bold text-dark">Nome Completo</label>
                            <input type="text" class="form-control form-control-lg bg-light border-0" id="nome" placeholder="Digite seu nome completo">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="email" class="form-label fw-bold text-dark">E-mail</label>
                                <input type="email" class="form-control form-control-lg bg-light border-0" id="email" placeholder="seuemail@exemplo.com">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="telefone" class="form-label fw-bold text-dark">Telefone</label>
                                <input type="text" class="form-control form-control-lg bg-light border-0" id="telefone" placeholder="(00) 00000-0000">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="area" class="form-label fw-bold text-dark">Área de Interesse</label>
                            <select class="form-select form-select-lg bg-light border-0" id="area">
                                <option selected>Selecione uma área...</option>
                                <option value="1">Atendimento ao Cliente</option>
                                <option value="2">Cozinha / Produção</option>
                                <option value="3">Entregador</option>
                                <option value="4">Administrativo</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="curriculo" class="form-label fw-bold text-dark">Anexar Currículo (PDF)</label>
                            <input class="form-control form-control-lg bg-light border-0" type="file" id="curriculo">
                        </div>
                        <div class="d-grid">
                            <button type="button" class="btn btn-dark btn-lg fw-bold rounded-pill py-3">Enviar Candidatura</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
