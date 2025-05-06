<?php
// Incluir o autoload ⬇️
require_once __DIR__ . '/../vendor/autoload.php';

// incluir o arquivo com as variaveis ⬇️
require_once __DIR__ . 'config/config.php';

session_start();

// importar as classes Locadora e Auth ⬇️
use Services\{Locadora,Auth};

// Importar as classes Carro e moto ⬇️
use Models\{Carro, Moto};

// Verificar se o usuario esta logado ⬇️
if(!Auth::verificarlogin()){
    header('Location: login.php');
    exit;
}

// opçao de sair do login ⬇️
// condiçao para logout ⬇️
// isset = parametro que foi setado ⬇️
if(isset($_GET['logout'])){
    (new Auth())->logout();
    header('Location: login.php');
    exit;
}

// chama a classe locadora para usar oq tem disponivel la ⬇️
// Cria uma instancia da classe locadora ⬇️
$locadora = new Locadora();

// mensagem de erro ⬇️
$mensagem = '';

// autenticaçao?
$usuario = Auth::getUsuarios();

// Verifica os dados do formulario via POST
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    // verifica se esta no login usuario ou no adm
    // verificar se requer permissao de administrador
    if(isset($_POST['adicionar']) ||  isset($_POST['deletar']) || isset($_POST['alugar']) ||isset($_POST['devolver'])){
        if(!Auth::isAdmin()){
            $mensagem = 'Você não tem permissâo para realizar essa açâo.';
            goto renderizar;
        }
    }
    if(isset($_POST['adicionar'])){
        $modelo = $POST['modelo'];
        $placa = $POST['placa'];
        $tipo = $POST['tipo'];

        $veiculo = ($tipo == 'Carro') ? new Carro($modelo, $placa) : new Moto($Modelo, $placa);

        $locadora->adicionarVeiculo($veiculo);

        $mensagem = "Veiculo adicionado com sucesso!";
    }
    elseif(isset($_POST['alugar'])){

        $dias = isset($_POST['dias']) ? (int)$_POST['dias'] :1;
        $mensagem = $locadora->alugarVeiculo($_POST['modelo'], $dias);
    }
    elseif(isset($_POST['devolver'])){
        $mensagem = $ocadora->devolverVeiculo($_POST['modelo']);
    }
    elseif(isset($_POST['deletar'])){
        $mensagem = $locadora->removerVeiculo($_POST['modelo'], $_POST['placa']);
    }
    elseif(isset($_POST['calcular'])){
        $dias = (int)$_POST['dias_calculo'];
        $tipo = $POST['tipo_calculo'];
        $valor = $locadora->calcularPrevisaoAluguel($dias, $tipo);

        $mensagem = "Previsão de valor para {$dias} dias: R$ " . number_format($valor, 2, ',', '.');
    }
}

renderizar :
require_once __DIR__ . '/../views/template,php';