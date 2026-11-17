<?php
session_start();
require_once 'conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$resposta_id = null;
$alt_selecionada = null;
$resultado = null;
$gabarito = null; // Adicione esta linha

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resposta_id = $_POST['questao_id'] ?? null;
    $alt_selecionada = $_POST['alternativa'] ?? null;
}

if ($resposta_id !== null && in_array($alt_selecionada, ['A', 'B', 'C', 'D'])) {
    $stmt = $pdo->prepare(
        "SELECT alt_correta FROM tb_questoes WHERE id = :id"
    );
    $stmt->execute([':id' => $resposta_id]);
    $questao_resp = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($questao_resp) {
        $gabarito = strtoupper(trim($questao_resp['alt_correta']));
        $resultado = ($alt_selecionada === $gabarito);
    }
}

// Recebe os filtros
$busca = trim($_GET['busca'] ?? '');
$materia = $_GET['materia'] ?? 'Todos(as)';
$banca = $_GET['banca'] ?? 'Todos(as)';
$ano = $_GET['ano'] ?? 'Todos(as)';
$dificuldade = $_GET['dificuldade'] ?? 'Todos(as)';


// Verifica se alguma pesquisa foi realizada
$pesquisa_realizada = isset($_GET['Filtrar']) || !empty($busca);

$questoes = [];

if ($pesquisa_realizada) {

    $sql = "SELECT * FROM tb_questoes WHERE 1=1";
    $params = [];

    // Filtro por matéria
    if ($materia !== 'Todos(as)') {
        $sql .= " AND materia = :materia";
        $params[':materia'] = $materia;
    }

    // Filtro por banca
    if ($banca !== 'Todos(as)') {
        $sql .= " AND banca = :banca";
        $params[':banca'] = $banca;
    }

    // Filtro por ano
    if ($ano !== 'Todos(as)') {
        $sql .= " AND ano = :ano";
        $params[':ano'] = $ano;
    }

    // Filtro por dificuldade
    if ($dificuldade !== 'Todos(as)') {
        $sql .= " AND dificuldade = :dificuldade";
        $params[':dificuldade'] = $dificuldade;
    }

    // Pesquisa por palavra-chave no enunciado
    if (!empty($busca)) {
        $sql .= " AND (enunciado LIKE :busca
                  OR alt_a LIKE :busca
                  OR alt_b LIKE :busca
                  OR alt_c LIKE :busca
                  OR alt_d LIKE :busca)";

        $params[':busca'] = "%" . $busca . "%";
    }

    // Ordena pelas questões mais recentes
    $sql .= " ORDER BY ano DESC, id DESC";

    // Executa a consulta
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

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

        <!-- NAVBAR -->
        <header class="g-navbar">

            <div class="g-logo-area">
                <img class="g-logo-image" src="img/logo-text.png">
            </div>

            <!-- BARRA DE PESQUISA -->
            <form method="GET" action="questoes.php">

                <div class="g-search-bar">

                    <input type="text" id="searchInput" name="busca"
                        placeholder="Pesquisar questões por palavra-chave... (pressione Enter)"
                        value="<?= htmlspecialchars($busca, ENT_QUOTES, 'UTF-8') ?>">

                </div>

                <!-- Preserva os filtros selecionados -->
                <input type="hidden" name="materia" value="<?= htmlspecialchars($materia, ENT_QUOTES, 'UTF-8') ?>">
                <input type="hidden" name="banca" value="<?= htmlspecialchars($banca, ENT_QUOTES, 'UTF-8') ?>">
                <input type="hidden" name="ano" value="<?= htmlspecialchars($ano, ENT_QUOTES, 'UTF-8') ?>">
                <input type="hidden" name="dificuldade"
                    value="<?= htmlspecialchars($dificuldade, ENT_QUOTES, 'UTF-8') ?>">

            </form>

            <div class="g-user-profile">

                <div class="g-level-badge">🔵 Nível 8</div>

                <div class="g-xp-container">
                    <span class="g-xp-text">2.450 / 3.000 XP</span>
                </div>

                <div class="g-user-info">

                    <img src="img/account-icon.png" id="g-account-icon">

                    <span class="g-user-email">
                        <?= htmlspecialchars($_SESSION['usuario_email'], ENT_QUOTES, 'UTF-8') ?>
                    </span>

                    <a href="logout.php">
                        <span class="g-logout-icon">Sair</span>
                    </a>

                </div>

            </div>

        </header>


        <!-- LAYOUT PRINCIPAL -->
        <main class="g-main-layout">

            <!-- SIDEBAR / FILTROS -->
            <aside class="g-sidebar">

                <form method="GET" action="questoes.php">

                    <!-- Preserva a busca textual -->
                    <input type="hidden" name="busca" value="<?= htmlspecialchars($busca, ENT_QUOTES, 'UTF-8') ?>">

                    <div class="g-sidebar-header">

                        <h3>Filtros de Questões</h3>

                        <a href="questoes.php" class="g-clear-filters">
                            Limpar tudo
                        </a>

                    </div>


                    <!-- MATÉRIA -->
                    <div class="g-filter-group">

                        <label>Matéria</label>

                        <select name="materia">

                            <option value="Todos(as)" <?= $materia === 'Todos(as)' ? 'selected' : '' ?>>
                                Todos(as)
                            </option>

                            <option value="Direito Constitucional" <?= $materia === 'Direito Constitucional' ? 'selected' : '' ?>>
                                Direito Constitucional
                            </option>

                        </select>

                    </div>


                    <!-- BANCA -->
                    <div class="g-filter-group">

                        <label>Banca</label>

                        <select name="banca">

                            <option value="Todos(as)" <?= $banca === 'Todos(as)' ? 'selected' : '' ?>>
                                Todos(as)
                            </option>

                            <option value="FGV" <?= $banca === 'FGV' ? 'selected' : '' ?>>
                                FGV
                            </option>

                        </select>

                    </div>


                    <!-- ANO -->
                    <div class="g-filter-group">

                        <label>Ano</label>

                        <select name="ano">

                            <option value="Todos(as)" <?= $ano === 'Todos(as)' ? 'selected' : '' ?>>
                                Todos(as)
                            </option>

                            <option value="2025" <?= $ano == '2025' ? 'selected' : '' ?>>
                                2025
                            </option>

                        </select>

                    </div>


                    <!-- DIFICULDADE -->
                    <div class="g-filter-group">

                        <label>Dificuldade</label>

                        <select name="dificuldade">

                            <option value="Todos(as)" <?= $dificuldade === 'Todos(as)' ? 'selected' : '' ?>>
                                Todos(as)
                            </option>

                            <option value="Fácil" <?= $dificuldade === 'Fácil' ? 'selected' : '' ?>>
                                Fácil
                            </option>

                            <option value="Média" <?= $dificuldade === 'Média' ? 'selected' : '' ?>>
                                Média
                            </option>

                            <option value="Difícil" <?= $dificuldade === 'Difícil' ? 'selected' : '' ?>>
                                Difícil
                            </option>

                        </select>

                    </div>


                    <button type="submit" name="Filtrar" value="1" class="g-btn-filter" id="btnFiltrar">

                        Filtrar Questões

                    </button>

                </form>

            </aside>


            <!-- ÁREA DE CONTEÚDO -->
            <section class="g-content-area">


                <?php if (!$pesquisa_realizada): ?>

                    <!-- NENHUMA PESQUISA REALIZADA -->

                    <div class="g-empty-state" id="emptyState">

                        <div class="g-empty-state-icon">🔍</div>

                        <h2>Nenhuma pesquisa realizada</h2>

                        <p>
                            Use a barra de pesquisa superior ou clique em
                            "Filtrar Questões" para exibir os resultados.
                        </p>

                    </div>


                <?php elseif (empty($questoes)): ?>

                    <!-- NENHUMA QUESTÃO ENCONTRADA -->

                    <div class="g-empty-state">

                        <div class="g-empty-state-icon">🔍</div>

                        <h2>Nenhuma questão encontrada</h2>

                        <p>
                            Tente alterar os filtros ou pesquisar por outro termo.
                        </p>

                    </div>


                <?php else: ?>

                    <!-- RESULTADOS ENCONTRADOS -->

                    <div id="questionsContainer">

                        <div class="g-results-header">

                            <h2>
                                Exibindo <?= count($questoes) ?>
                                <?= count($questoes) === 1 ? 'questão' : 'questões' ?>
                            </h2>

                            <div class="g-sort-dropdown">
                                Ordenar por: <strong>Mais Recentes</strong>
                            </div>

                        </div>


                        <!-- LOOP DAS QUESTÕES -->
                        <?php foreach ($questoes as $questao): ?>

                            <article class="g-question-card" id="questao-<?= (int) $questao['id'] ?>">

                                <!-- TAGS -->
                                <div class="g-tags-container">
                                    <span class="g-tag g-tag-blue">Matéria:
                                        <?= htmlspecialchars($questao['materia'], ENT_QUOTES, 'UTF-8') ?></span>
                                    <span class="g-tag g-tag-lightblue">Banca:
                                        <?= htmlspecialchars($questao['banca'], ENT_QUOTES, 'UTF-8') ?></span>
                                    <span class="g-tag g-tag-purple">Ano:
                                        <?= htmlspecialchars($questao['ano'], ENT_QUOTES, 'UTF-8') ?></span>
                                    <span class="g-tag g-tag-orange">Dificuldade:
                                        <?= htmlspecialchars($questao['dificuldade'], ENT_QUOTES, 'UTF-8') ?></span>
                                </div>

                                <!-- ENUNCIADO -->
                                <p class="g-question-text">
                                    <?= nl2br(htmlspecialchars($questao['enunciado'], ENT_QUOTES, 'UTF-8')) ?>
                                </p>

                                <?php
                                // Verifica se ESTA questão específica foi a que o usuário acabou de responder
                                $foi_respondida = ((int) $resposta_id === (int) $questao['id'] && $resultado !== null);
                                ?>

                                <form method="POST" action="#questao-<?= (int) $questao['id'] ?>">
                                    <input type="hidden" name="questao_id" value="<?= (int) $questao['id'] ?>">

                                    <!-- ALTERNATIVAS -->
                                    <div class="g-alternatives-list">
                                        <?php
                                        $alternativas = [
                                            'A' => 'alt_a',
                                            'B' => 'alt_b',
                                            'C' => 'alt_c',
                                            'D' => 'alt_d',
                                            'E' => 'alt_e'
                                        ];
                                        ?>

                                        <?php foreach ($alternativas as $letra => $coluna): ?>
                                            <?php if (!empty($questao[$coluna])): ?>
                                                <?php
                                                // Define estilos inline simples para destacar certa/errada após responder
                                                $estilo_extra = '';
                                                $checked = '';

                                                if ($foi_respondida) {
                                                    if ($letra === $alt_selecionada) {
                                                        $checked = 'checked';
                                                    }
                                                    if ($letra === $gabarito) {
                                                        $estilo_extra = 'border: 2px solid #22c55e; background-color: #f0fdf4;'; // Verde (Certa)
                                                    } elseif ($letra === $alt_selecionada && !$resultado) {
                                                        $estilo_extra = 'border: 2px solid #ef4444; background-color: #fef2f2;'; // Vermelho (Errada)
                                                    }
                                                }
                                                ?>

                                                <label class="g-alternative-item" style="<?= $estilo_extra ?>">
                                                    <input type="radio" name="alternativa" value="<?= $letra ?>" <?= $checked ?>
                                                        required>
                                                    <div class="g-alternative-letter"><?= $letra ?></div>
                                                    <div><?= nl2br(htmlspecialchars($questao[$coluna], ENT_QUOTES, 'UTF-8')) ?></div>
                                                </label>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>

                                    <!-- MENSAGEM DE FEEDBACK (CORRETO / ERRADO) -->
                                    <?php if ($foi_respondida): ?>
                                        <?php if ($resultado): ?>
                                            <div
                                                style="margin-top: 15px; padding: 12px; border-radius: 8px; background-color: #dcfce7; color: #166534; font-weight: 600;">
                                                Parabéns! Você acertou! A resposta correta é a alternativa <?= $gabarito ?>.
                                            </div>
                                        <?php else: ?>
                                            <div
                                                style="margin-top: 15px; padding: 12px; border-radius: 8px; background-color: #fee2e2; color: #991b1b; font-weight: 600;">
                                                Resposta incorreta. Você marcou a alternativa <?= htmlspecialchars($alt_selecionada) ?>,
                                                mas a correta é a alternativa <?= $gabarito ?>.
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <!-- RODAPÉ DO CARD -->
                                    <div class="g-card-footer">
                                        <div class="g-footer-left">
                                            <button class="g-btn-secondary" type="button">
                                                Ver Comentário do Professor
                                            </button>

                                            <!-- ALTERADO DE type="button" PARA type="submit" -->
                                            <button class="g-btn-action-primary" type="submit">
                                                Responder Questão
                                            </button>
                                        </div>

                                        <button class="g-btn-xp" type="button">
                                            ⭐ +150 XP
                                        </button>
                                    </div>
                                </form>
                            </article>


                        <?php endforeach; ?>

                    </div>

                <?php endif; ?>


            </section>

        </main>

    </div>


    <script src="script.js"></script>

</body>

</html>
