<!-- Início do Rodapé (Footer). No design do Figma, o rodapé serve para navegação secundária, links de suporte e redes sociais -->
<footer class="figma-footer">
    <div class="container-xl figma-shell">
        <!-- Grid principal do rodapé contendo 4 colunas em telas grandes -->
        <div class="row g-4 figma-footer-grid">
            
            <!-- Coluna 1: Logotipo e informações da empresa -->
            <div class="col-12 col-lg-3">
                <!-- Imagem (<img>) do logotipo da marca -->
                <img src="{{ asset('img/figma/radape/logo-mecdonin.png') }}" alt="MecDonin" class="figma-footer-logo">
                <!-- Parágrafo (<p>) com texto normal -->
                <p>Compan # 490039-445, Registered with<br>House of companies.</p>
            </div>

            <!-- Coluna 2: Inscrição em Newsletter (Caixa de e-mail) -->
            <div class="col-12 col-lg-5">
                <!-- Título nível 3 (<h3>) -->
                <h3>Receba Ofertas Exclusivas na sua Caixa de Entrada</h3>
                
                <!-- Formulário (<form>) para envio de email. Contém um campo de texto e um botão -->
                <form class="figma-newsletter" action="#cardapio">
                    <!-- Campo de entrada (input) para o usuário digitar o e-mail. É onde o usuário interage digitando texto. -->
                    <input type="email" placeholder="seuemail@gmail.com" aria-label="Email para ofertas">
                    <!-- Botão de ação (button) para confirmar a inscrição. Quando clicado, submete o formulário. -->
                    <button type="submit">Inscrever-se</button>
                </form>
                <p>Nós não enviaremos spam, leia nossa política de e-mail</p>
                
                <!-- Links para Redes Sociais. Estes são ícones clicáveis (links <a> encapsulando imagens) -->
                <div class="figma-social-row" aria-label="Redes sociais">
                    <a href="#" aria-label="Facebook">
                        <img src="{{ asset('img/figma/radape/social-facebook.png') }}" alt="Facebook">
                    </a>
                    <a href="#" aria-label="Instagram">
                        <img src="{{ asset('img/figma/radape/social-instagram.png') }}" alt="Instagram">
                    </a>
                    <a href="#" aria-label="TikTok">
                        <img src="{{ asset('img/figma/radape/social-tiktok.png') }}" alt="TikTok">
                    </a>
                    <a href="#" aria-label="Snapchat">
                        <img src="{{ asset('img/figma/radape/social-snapchat.png') }}" alt="Snapchat">
                    </a>
                </div>
            </div>

            <!-- Coluna 3: Links Institucionais (Quem Somos) -->
            <div class="col-6 col-lg-2">
                <h3>Quem Somos</h3>
                <p>
                    <!-- Links (âncoras <a>) para outras páginas ou seções. Funcionam como botões de navegação em formato de texto. -->
                    <a href="{{ route('radape.privacidade') }}">Privacidade</a><br>
                    <a href="{{ route('radape.cookies') }}">Cookies</a><br>
                    <a href="{{ route('radape.nossa-historia') }}">Nossa História</a><br>
                    <a href="{{ route('radape.termos') }}">Termos e Condições</a><br>
                </p>
            </div>

            <!-- Coluna 4: Links Importantes (Ações e Ajuda) -->
            <div class="col-6 col-lg-2">
                <h3>Links Importantes</h3>
                <p>
                    <a href="{{ route('radape.ajuda') }}">Ajuda</a><br>
                    <a href="{{ route('radape.trabalhe-conosco') }}">Trabalhe Conosco</a><br>
                    <a href="{{ route('bemvindo.index') }}">Entra Para Pedir</a><br>
                </p>
            </div>
        </div>
    </div>

    <!-- Barra inferior do rodapé (Copyright e links finais) -->
    <div class="figma-footer-bottom">
        <div class="container-xl figma-shell text-center">MecDonin.br Copyright 2024, Todos os Direitos Reservados.</div>
    </div>
</footer>
