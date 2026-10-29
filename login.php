<?php
require_once 'conexao.php';
session_start();

$mensagem = "";

if (isset($_GET['sucesso'])) {
    $mensagem = "<p style='color: #2ecc71; font-weight: bold; text-align: center; margin-bottom: 15px;'>Conta criada com sucesso! Faça seu login.</p>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = $_POST['senha'];

    if ($email && !empty($senha)) {
        $sql = "SELECT id, email, senha FROM tb_usuarios WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_email'] = $usuario['email'];
            
            header("Location: questoes.php");
            exit;
        } else {
            $mensagem = "<p style='color: #ff4d4d; font-weight: bold; text-align: center; margin-bottom: 15px;'>E-mail ou senha incorretos.</p>";
        }
    } else {
        $mensagem = "<p style='color: #ff4d4d; font-weight: bold; text-align: center; margin-bottom: 15px;'>Preencha todos os campos.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://googleapis.com">
    <link rel="preconnect" href="https://gstatic.com" crossorigin>
    <link href="https://googleapis.com/css2?family=Inter:ital,opsz,wght=0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>Gabarita - Login</title>
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
            
            <?php echo $mensagem; ?>

            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Digite seu email" required>
                </div>

                <div class="form-group">
                    <label for="senha">Senha</label>
                    <div class="input-password-wrapper">
                        <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
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
    <script src="script.js"></script>
</body>
</html>
