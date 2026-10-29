
<?php
require_once 'conexao.php';

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    if ($email && !empty($senha)) {
        if ($senha !== $confirmar_senha) {
            $mensagem = "<p style='color: #ff4d4d; font-weight: bold; text-align: center; margin-bottom: 15px;'>As senhas não coincidem!</p>";
        } else {
            $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

            try {
        
                $sql = "INSERT INTO tb_usuarios (email, senha) VALUES (:email, :senha)";
                $stmt = $pdo->prepare($sql);
                
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':senha', $senhaCriptografada);
                
                $stmt->execute();
                
                header("Location: login.php?sucesso=1");
                exit;
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    $mensagem = "<p style='color: #ff4d4d; font-weight: bold; text-align: center; margin-bottom: 15px;'>Este e-mail já está cadastrado.</p>";
                } else {
                    $mensagem = "<p style='color: #ff4d4d; font-weight: bold; text-align: center; margin-bottom: 15px;'>Erro ao cadastrar no banco.</p>";
                }
            }
        }
    } else {
        $mensagem = "<p style='color: #ff4d4d; font-weight: bold; text-align: center; margin-bottom: 15px;'>Por favor, insira um e-mail válido.</p>";
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
    <title>Gabarita - Cadastro</title>
</head>
<body id="body-cadastro">
    <main class="container">
        <div class="card-cadastro">
            <div class="logo-header">
                <div class="cadastro-icon">
                    <img src="img/logo-text.png" id="cadastro-icon-image">
                </div>
            </div>

            <h2>Crie sua conta de estudos gratuita</h2>
            
            <?php echo $mensagem; ?>

            <form action="cadastro.php" method="POST">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="exemplo@email.com" required>
                </div>

                <div class="form-group">
                    <label for="senha">Senha</label>
                    <div class="input-password-wrapper">
                        <input type="password" id="senha" name="senha" placeholder="Crie uma senha forte" required>
                        <button type="button" class="toggle-password">
                            <i data-lucide="eye" class="icon-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirmar-senha">Confirmar Senha</label>
                    <div class="input-password-wrapper">
                        <input type="password" id="confirmar-senha" name="confirmar_senha" placeholder="Confirme sua senha" required>
                        <button type="button" class="toggle-password"></button>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Começar a Estudar</button>
            </form>
            <p class="footer-text">Já tem uma conta? <a href="login.php">Faça login</a></p>
        </div>
    </main>
    <script src="script.js"></script>
</body>
</html>