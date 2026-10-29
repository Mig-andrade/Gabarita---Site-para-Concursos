<?php
    session_start();
    require_once 'conexao.php';
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: login.php");
        exit;
    }
    $busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
    $materia = filter_input(INPUT_GET, 'materia', FILTER_SANITIZE_SPECIAL_CHARS) ?? 'Todos(as) ';
    $banca = filter_input(INPUT_GET, 'banca', FILTER_SANITIZE_SPECIAL_CHARS) ?? 'Todos(as)';
    $ano = filter_input(INPUT_GET, 'ano', FILTER_SANITIZE_SPECIAL_CHARS) ?? 'Todos(as)';
    $dif = filter_input(INPUT_GET, 'dificuldade', FILTER_SANITIZE_SPECIAL_CHARS) ?? 'Todos(as)';
    $pesquisa_realizada = isset($_GET['Filtrar']) || !empty($busca);
    $questoes = [];

    if ($pesquisa_realizada) {
        $sql = 'SELECT * FROM tb_questoes WHERE 1=1';
        $params = [];
        if ($materia !== 'Todos(as)') {
            $sql .= " AND materia = :materia";
            $params[':materia'] = $materia;
        }
        if ($banca !== 'Todos(as)') {
            $sql .= " AND banca = :banca";
            $params[':banca'] = $banca;
        }
        if ($ano !== 'Todos(as)') {
            $sql .= " AND ano = :ano";
            $params[':ano'] = $ano;
        }
        if ($dif !== 'Todos(as)') {
            $sql .= " AND dif = :dif";
            $params[':dif'] = $dif;
        }
        if (!empty($busca)) {
            $sql .= "AND enunciado LIKE :busca";
            $params[':busca'] = "%" . $busca . "%";
        }
        $stmt = $pdo->prepare($sql);
        $stmt ->execute($params);
        $questoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


?>

<!DOCTYPE html>
<html lang="pt-BR">

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

<body>

    <div class="g-body-wrapper">

        <header class="g-navbar">
            <div class="g-logo-area">
                <img class="g-logo-image" src="img/logo-text.png">
            </div>
            <div class="g-search-bar">
                <input type="text" id="searchInput" name = "searchInput"
                    placeholder="Pesquisar questões por palavra-chave... (pressione Enter)">
            </div>
            <div class="g-user-profile">
                <div class="g-level-badge">🔵 Nível 8</div>
                <div class="g-xp-container">
                    <span class="g-xp-text">2.450 / 3.000 XP</span>
                </div>
                <div class="g-user-info">
                    <img src = "img/account-icon.png" id = "g-account-icon">
                    <span class = "g-user-email"><?php echo htmlspecialchars($_SESSION['usuario_email']); ?></span>
                    <a href = "logout.php"><span class = "g-logout-icon">Sair</span></a>
                </div>
            </div>
        </header>

        <main class="g-main-layout">
            <aside class="g-sidebar">
                <form method = "GET" action = "questoes.php">
                <div class="g-sidebar-header">
                    <h3>Filtros de Questões</h3>
                    <a href="#" class="g-clear-filters">Limpar tudo</a>
                </div>

                <div class="g-filter-group">
                    <label>Matéria</label>
                    <select name = "materia">
                        <option>Todos(as)</option>
                        <option value = "Direito Constitucional" selected>Direito Constitucional</option>
                    </select>
                </div>
                <div class="g-filter-group">
                    <label>Banca</label>
                    <select name = "banca">
                        <option>Todos(as)</option>
                        <option value = "FGV" selected>FGV</option>
                    </select>
                </div>

                <div class="g-filter-group">
                    <label>Ano</label>
                    <select name = "ano">
                        <option>Todos(as)</option>
                        <option value = "2025" selected>2025</option>
                    </select>
                </div>

                <div class="g-filter-group">
                    <label>Dificuldade</label>
                    <select name = "dificuldade">
                        <option>Todos(as)</option>
                        <option value = "Média" selected>Média</option>
                    </select>
                </div>

                <button type = "submit" name = "Filtrar" value = "1" class="g-btn-filter" id="btnFiltrar">Filtrar Questões</button>
                </form>
            </aside>

            <section class="g-content-area">

                <div class="g-empty-state" id="emptyState">
                    <div class="g-empty-state-icon">🔍</div>
                    <h2>Nenhuma pesquisa realizada</h2>
                    <p>Use a barra de pesquisa superior ou clique em "Filtrar Questões" para exibir os resultados.</p>
                </div>
                <div id="questionsContainer" class="g-hidden">
                    <div class="g-results-header">
                        <h2>Exibindo 2.348 questões de Direito Constitucional</h2>
                        <div class="g-sort-dropdown">
                            Ordenar por: <strong>Mais Recentes ▾</strong>
                        </div>
                    </div>

                    <article class="g-question-card">
                        <div class="g-tags-container">
                            <span class="g-tag g-tag-blue">Matéria: Direito Constitucional</span>
                            <span class="g-tag g-tag-lightblue">Banca: FGV</span>
                            <span class="g-tag g-tag-purple">Ano: 2025</span>
                            <span class="g-tag g-tag-orange">Dificuldade: Média</span>
                        </div>

                        <p class="g-question-text">
                            A respeito dos direitos e garantias fundamentais previstos na Constituição Federal de 1988,
                            assinale a alternativa correta sobre a possibilidade de interceptação telefônica de
                            comunicações telefônicas:
                        </p>

                        <div class="g-alternatives-list">
                            <div class="g-alternative-item">
                                <div class="g-alternative-letter">A</div>
                                <div>Exige sempre autorização judicial, em qualquer hipótese e finalidade.</div>
                            </div>

                            <div class="g-alternative-item g-selected">
                                <div class="g-alternative-letter">B</div>
                                <div>Poderá ser determinada pelo juiz, sob segredo de justiça, para fins de investigação
                                    criminal ou instrução processual penal.</div>
                            </div>

                            <div class="g-alternative-item">
                                <div class="g-alternative-letter">C</div>
                                <div>Admite-se para fins cíveis comuns, visando a cobrança amigável de obrigações de
                                    natureza alimentar.</div>
                            </div>

                            <div class="g-alternative-item">
                                <div class="g-alternative-letter">D</div>
                                <div>Independe de lei regulamentadora específica por ser direito fundamental
                                    autoaplicável.</div>
                            </div>

                            <div class="g-alternative-item">
                                <div class="g-alternative-letter">E</div>
                                <div>Pode ser decretada diretamente por comissão parlamentar de inquérito estadual ou
                                    municipal.</div>
                            </div>
                        </div>

                        <div class="g-card-footer">
                            <div class="g-footer-left">
                                <button class="g-btn-secondary">Ver Comentário do Professor</button>
                                <button class="g-btn-action-primary">Responder Questão</button>
                            </div>
                            <button class="g-btn-xp">⭐+ 150 XP</button>
                        </div>
                    </article>

                    <nav class="g-pagination">
                        <span class="g-page-item">‹</span>
                        <span class="g-page-item g-page-active">1</span>
                        <span class="g-page-item">2</span>
                        <span class="g-page-item">3</span>
                        <span class="g-page-dots">...</span>
                        <span class="g-page-item">120</span>
                        <span class="g-page-item">›</span>
                    </nav>
                </div>

            </section>
            
        </main>
    </div>

    <script src = "script.js"></script>
</body>

</html>