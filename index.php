<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <title>Gabarita</title>
</head>

<body id = "body-landing-page">

    <header>
        <div class="navbar">
            <div class="logo">
                <img src="img/logo-text.png" alt="Logo Gabarita" id="logo-image">
            </div>
            <div class="nav-links">
                <a href="#title" class="active">Início</a>
                <a href="#resources">Recursos</a>
                <a href="#depoimentos">Depoimentos</a>
            </div>
            <div class="nav-actions">
                <a href="login.php" class="btn-entrar">Entrar</a>
                <a href="cadastro.php" class="btn-criar-conta">Criar Conta</a>
            </div>
        </div>
    </header>

    <main>

        <section class="title-section" id = "title">
            <div class="title-div">
                <h1 class="title">Sua Aprovação em Concursos Públicos Começa Aqui!</h1>
                <p class="title-text">Prepare-se com uma plataforma de estudos gamificada e dinâmica. Milhares de
                    questões comentadas, recompensas diárias e metas com incentivos.</p>
                <a href="cadastro.php" class="btn-primario">Começar agora</a>
            </div>
            <div class="title-card">
                <img src="img/title-card.png" id="title-img">
            </div>
        </section>

        <section class="resources-section" id = "resources">
            <div class="resources-div">
                <h1 class="resources-title">Por que estudar com o Gabarita?</h1>
                <p class="resources-text">Uma experiência de estudo projetada de ponta a ponta para maximizar suas
                    chances de aprovação.</p>
            </div>
            <div class="resources-content">
                <div class="resources-card">
                    <img src="img/resources-image1.png" class="resources-image" alt="Imagem 1">
                    <h3 class="card-title">Filtros Inteligentes</h3>
                    <p class="card-text">Encontre exatamente o que precisa estudar buscando por matéria, assunto, banca,
                        ano ou nível de dificuldade.</p>
                </div>
                <div class="resources-card">
                    <img src="img/resources-image2.png" class="resources-image" alt="Imagem 2">
                    <h3 class="card-title">Banco de Questões</h3>
                    <p class="card-text">Milhares de questões atualizadas de concursos reais com comentários minuciosos
                        de professores especialistas.</p>
                </div>
                <div class="resources-card">
                    <img src="img/resources-image3.png" class="resources-image" alt="Imagem 3">
                    <h3 class="card-title">Motivação Extrínsica</h3>
                    <p class="card-text">Evolua diariamente com cada questão e suba de nível, ganhando prêmios e novos
                        incentivos.</p>
                </div>
            </div>
        </section>
        <section class="depoimentos-section" id = "depoimentos">
            <div class="depoimentos-div">
                <h1 class="depoimentos-title">Aprovados pelo Gabarita</h1>
                <div class="depoimentos-cards">
                    <div class="depoimentos-card">
                        <p class="depoimentos-text">"Os filtros por assunto facilitaram muito meu estudo e meu esforço
                            foi o
                            diferencial para alcançar meus objetivos."</p>
                        <div class="depoimentos-info">
                            <img src="img/depoimentos-image1.jpg" alt="Imagem 4" class="depoimentos-image">
                            <div class="depoimentos-details">
                                <p class="depoimentos-name">Hadryan Gabriel</p>
                                <p class="depoimentos-approval">Aprovado no Instituto Federal de São Paulo</p>
                            </div>
                        </div>
                    </div>
                    <div class="depoimentos-card">
                        <p class="depoimentos-text">"As estatísticas me ajudaram a ver onde eu estava errando mais.
                            Foquei meus esforços de forma direcionada e tive bons resultados."</p>
                        <div class="depoimentos-info">
                            <img src="img/depoimentos-image2.jpg" alt="Imagem 5" class="depoimentos-image">
                            <div class="depoimentos-details">
                                <p class="depoimentos-name">Henry Seorlin</p>
                                <p class="depoimentos-approval">Aprovado na Prefeitura de Hortolândia</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <div class="footer-image-div">
            <img src="img/footer-image.png" class="footer-image">
        </div>
        <div class="footer-div">
            <div class="footer-line">
                <div class="footer-left">
                    <h3 class="footer-title">IFSP - Trabalho Acadêmico</h3>
                    <p>Todos os direitos reservados</p>
                </div>
                <div class="footer-right">
                    <h3 class="footer-title">Equipe</h3>
                    <p>Miguel Angelo de Andrade</p>
                    <p>Henry Jose de Lira Seorlin</p>
                    <p>Hadryan Gabriel de Souza Lopo</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2026 Gabarita. Todos os direitos reservados.</p>
            </div>
        </div>

    </footer>
    <script src = "script.js"></script>
</body>

</html>