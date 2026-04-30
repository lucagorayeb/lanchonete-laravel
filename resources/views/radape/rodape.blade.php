<!-- Rodape do Figma: area final com logo, newsletter, redes sociais e links institucionais. -->
<footer class="radape-footer">
    <div class="radape-shell radape-footer__grid">
        <!-- Coluna da marca: mostra a identidade visual e dados da empresa. -->
        <section class="radape-footer__brand" aria-label="Informacoes da empresa">
            <img src="{{ asset('img/figma/radape/logo-mecdonin.png') }}" alt="MecDonin" class="radape-footer__logo">
            <p>Company # 490039-445, Registered with<br>House of companies.</p>
        </section>

        <!-- Formulario de newsletter: input recebe o email e botao envia a inscricao. -->
        <section class="radape-footer__newsletter" aria-label="Newsletter">
            <h2>Receba Ofertas Exclusivas na sua Caixa de Entrada</h2>

            <form class="radape-newsletter-form" action="{{ route('radape.politica-email') }}" method="GET">
                <!-- Campo de texto: input do tipo email para o usuario digitar o contato. -->
                <input type="email" name="email" placeholder="seuemail@gmail.com" aria-label="Email para receber ofertas">

                <!-- Botao de acao: confirma a tentativa de inscricao na newsletter. -->
                <button type="submit">inscrever-se</button>
            </form>

            <p class="radape-footer__small">
                Nos nao enviaremos spam, leia
                <a href="{{ route('radape.politica-email') }}">nossa politica de e-mail</a>
            </p>

            <!-- Links sociais: cada ancora envolve um icone clicavel. -->
            <div class="radape-socials" aria-label="Redes sociais">
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
        </section>

        <!-- Lista de links "Quem Somos": atalhos para conteudos legais e institucionais. -->
        <nav class="radape-footer__links" aria-label="Quem Somos">
            <h2>Quem Somos</h2>
            <a href="{{ route('radape.privacidade') }}">Privacidade</a>
            <a href="{{ route('radape.cookies') }}">Cookies</a>
            <a href="{{ route('radape.nossa-historia') }}">Nossa Historia</a>
            <a href="{{ route('radape.termos') }}">Termos e Condições</a>
        </nav>

        <nav class="radape-footer__links" aria-label="Links Importantes">
            <h2>Links Importantes</h2>
            <a href="{{ route('radape.ajuda') }}">Ajuda</a>
            <a href="{{ route('radape.trabalhe-conosco') }}">Trabalhe Conosco</a>
            <a href="{{ route('bemvindo.index') }}">Fazer Entra Para Pedir</a>
            <a href="{{ route('register') }}">Criar uma Conta Administrativa</a>
        </nav>
    </div>
</footer>
