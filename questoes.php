<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gabarita - Plataforma de Questões</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="g-body-wrapper">

        <header class="g-navbar">
            <div class="g-logo-area">
                <span class="g-logo-icon">🎓</span> Gabarita
            </div>
            <div class="g-search-bar">
                <input type="text" id="searchInput" placeholder="Pesquisar questões por palavra-chave... (pressione Enter)">
            </div>
            <div class="g-user-profile">
                <div class="g-level-badge">🔵 Nível 8</div>
                <div class="g-xp-container">
                    <span class="g-xp-text">2.450 / 3.000 XP</span>
                </div>
                <div class="g-user-info">
                    <div class="g-avatar"></div>
                    <span>Miguel A.</span>
                </div>
            </div>
        </header>

        <main class="g-main-layout">
            <aside class="g-sidebar">
                <div class="g-sidebar-header">
                    <h3>Filtros de Questões</h3>
                    <a href="#" class="g-clear-filters">Limpar tudo</a>
                </div>
                
                <div class="g-filter-group">
                    <label>Matéria</label>
                    <select>
                        <option>Todos(as)</option>
                        <option selected>Direito Constitucional</option>
                    </select>
                </div>

                <div class="g-filter-group">
                    <label>Assunto</label>
                    <select>
                        <option selected>Todos(as)</option>
                    </select>
                </div>

                <div class="g-filter-group">
                    <label>Banca</label>
                    <select>
                        <option>Todos(as)</option>
                        <option selected>FGV</option>
                    </select>
                </div>

                <div class="g-filter-group">
                    <label>Ano</label>
                    <select>
                        <option>Todos(as)</option>
                        <option selected>2025</option>
                    </select>
                </div>

                <div class="g-filter-group">
                    <label>Dificuldade</label>
                    <select>
                        <option>Todos(as)</option>
                        <option selected>Média</option>
                    </select>
                </div>

                <button class="g-btn-filter" id="btnFiltrar">Filtrar Questões</button>
            </aside>

            <section class="g-content-area">
                
                <!-- Estado Inicial de Vazio -->
                <div class="g-empty-state" id="emptyState">
                    <div class="g-empty-state-icon">🔍</div>
                    <h2>Nenhuma pesquisa realizada</h2>
                    <p>Use a barra de pesquisa superior ou clique em "Filtrar Questões" para exibir os resultados.</p>
                </div>

                <!-- Bloco de Questões oculto inicialmente -->
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
                            A respeito dos direitos e garantias fundamentais previstos na Constituição Federal de 1988, assinale a alternativa correta sobre a possibilidade de interceptação telefônica de comunicações telefônicas:
                        </p>

                        <div class="g-alternatives-list">
                            <div class="g-alternative-item">
                                <div class="g-alternative-letter">A</div>
                                <div>Exige sempre autorização judicial, em qualquer hipótese e finalidade.</div>
                            </div>
                            
                            <div class="g-alternative-item g-selected">
                                <div class="g-alternative-letter">B</div>
                                <div>Poderá ser determinada pelo juiz, sob segredo de justiça, para fins de investigação criminal ou instrução processual penal.</div>
                            </div>

                            <div class="g-alternative-item">
                                <div class="g-alternative-letter">C</div>
                                <div>Admite-se para fins cíveis comuns, visando a cobrança amigável de obrigações de natureza alimentar.</div>
                            </div>

                            <div class="g-alternative-item">
                                <div class="g-alternative-letter">D</div>
                                <div>Independe de lei regulamentadora específica por ser direito fundamental autoaplicável.</div>
                            </div>

                            <div class="g-alternative-item">
                                <div class="g-alternative-letter">E</div>
                                <div>Pode ser decretada diretamente por comissão parlamentar de inquérito estadual ou municipal.</div>
                            </div>
                        </div>

                        <div class="g-card-footer">
                            <div class="g-footer-left">
                                <button class="g-btn-secondary">Ver Comentário do Professor</button>
                                <button class="g-btn-action-primary">Responder Questão</button>
                            </div>
                            <button class="g-btn-xp">⭐ +150 XP</button>
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

    <script>
        const btnFiltrar = document.getElementById('btnFiltrar');
        const searchInput = document.getElementById('searchInput');
        const emptyState = document.getElementById('emptyState');
        const questionsContainer = document.getElementById('questionsContainer');

        function dispararBusca() {
            emptyState.classList.add('g-hidden');
            questionsContainer.classList.remove('g-hidden');
        }

        btnFiltrar.addEventListener('click', dispararBusca);
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                dispararBusca();
            }
        });

        // Alternância exclusiva usando a nova classe protegida .g-selected
        const items = document.querySelectorAll('.g-alternative-item');
        items.forEach(item => {
            item.addEventListener('click', () => {
                items.forEach(i => i.classList.remove('g-selected'));
                item.add('g-selected');
            });
        });
    </script>
</body>
</html>