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

<body id="body-login">
    <main class="container">
        <div class="card-cadastro">
            <div class="logo-header">
                <div class="cadastro-icon">
                    <img src="img/logo-text.png" id="cadastro-icon-image">
                </div>
            </div>

            <h2>Acesse sua conta de estudos</h2>
            <form action = "questoes.php">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" placeholder="Digite seu email" required>
                </div>

                <div class="form-group">
                    <label for="senha">Senha</label>
                    <div class="input-password-wrapper">
                        <input type="password" id="senha" placeholder="Digite sua senha" required>
                        <button type="button" class="toggle-password">
                            <i data-lucide="eye" class="icon-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Entrar na plataforma</button>
            </form>
            <p class="footer-text">Não tem uma conta? <a href="cadastro.php">Cadastre-se grátis</a></p>
        </div>
    </main>
</body>

</html>

<script src="script.js"></script>
</body>

</html>