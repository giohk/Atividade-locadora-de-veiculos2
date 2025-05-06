<?php
// incluir autoload do composer para carregar autamaticamente as classes utilizadas ⬇️
require_once __DIR__ . '/../vendor/autoload.php';

// incluir o arquivo com as variaveis ⬇️
require_once __DIR__ . '/../config.php';

// iniciar a sessao ⬇️
session_start();

// inserir a classe de autenticação ⬇️
use Services\Auth;

// Inicializa a avariavel para mensagens de erro ⬇️
$mensagem = '';

// Instanciar a classe de autenticação ⬇️
$auth = new Auth();

// verifica se ja foi autenticado ⬇️
if(Auth::verificarLogin()){

    // encaminha para a pagina principal ⬇️
    header('Location:index.php');
    // esse exit e pra nao ficar preso na pagina ⬇️
    exit;
}

// Verifica se o forulario foi enviado ⬇️
if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $username = $_POST['username'] ?? '';

    $password = $_POST['password'] ?? '';

    // valida os dados ⬇️
    if($auth->login($username, $password)){
        // Se o login for correto direciona para pagina inicial
        header('Location: index.php');
        exit;
        // se estiver errado ⬇️
    } else {
        $mensagem = 'falha ao execultar o login! Verifique se o usuario e a senha estão corretos.';
    }
}
?>
<!-- completa a parte do html adicionando o backend  --> ⬆️

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Locadora de veículos</title>
    <!-- Link do bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Link dos ícones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS Interno -->
    <style>
        .login-container{
            max-width:400px;
            margin: 100px auto;
        }
        .password-toggle{
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-light">
    <div class="login-container">
        <div class="card">
            <!-- Título do card -->
            <div class="card-header">
                <h4 class="mb-1">Login</h4>
            </div>

            <!-- Corpo do card -->
            <div class="card-body">

            <?php if ($mensagem): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($mensagem) ?></div>
            <?php endif; ?>

                <form action="post" class="needs-validation" novalidate>
                    <input type="hidden">

                    <div class="mb-3">
                        <label for="user" class="form-label">
                            Usuário:
                        </label>
                        <input type="text" name="username" class="form-control" required autocomplete="off" placeholder="Digite o usuário">
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label">
                            Senha:
                        </label>
                        <input type="password" name="password" class="form-control" id="password" required>
                        <span class="password-toggle mt-3" onclick="togglePassword()">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>

                    <button type="submit" class="btn btn-warning w-100">Entrar</button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function togglePassword(){
            let passwordInput = document.getElementById('password');
            passwordInput.type = (passwordInput.type === 'password') ? 'text' : 'password';
        }
    </script>

</body>
</html>