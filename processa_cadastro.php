<?php
session_start();

// Informações de conexão ao banco de dados
$host = "localhost";
$usuario = "root";
$senha = "123456";
$bancoDeDados = "UAHCIP";

// Conexão com o banco de dados
$conexao = new mysqli($host, $usuario, $senha, $bancoDeDados);

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe e limpa os dados do formulário
    $nome = $conexao->real_escape_string($_POST['nome']);
    $sobrenome = $conexao->real_escape_string($_POST['sobrenome']);
    $email = $conexao->real_escape_string($_POST['email']);
    $usuario = $conexao->real_escape_string($_POST['usuario']);
    $senha = $conexao->real_escape_string($_POST['senha']);
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Verifica se o e-mail já existe na tabela de autenticação
    $consulta = $conexao->prepare("SELECT id FROM user_auth WHERE username = ?");
    $consulta->bind_param("s", $usuario);
    $consulta->execute();
    $resultado = $consulta->get_result();
    
    if ($resultado->num_rows > 0) {
        $_SESSION['erro_cadastro'] = "Usuário já cadastrado.";
        header("Location: cadastro.php");
        exit;
    }

    // Inicia a transação
    $conexao->begin_transaction();

    try {
        // Insere na tabela de informações do usuário
        $insercaoUserInfo = $conexao->prepare("INSERT INTO user_info (nome, sobrenome, email) VALUES (?, ?, ?)");
        $insercaoUserInfo->bind_param("sss", $nome, $sobrenome, $email);
        $insercaoUserInfo->execute();
        $insercaoUserInfo->close();

        // Obtém o ID do usuário inserido
        $userId = $conexao->insert_id;

        // Insere na tabela de autenticação
        $insercaoUserAuth = $conexao->prepare("INSERT INTO user_auth (username, password_hash, user_info_id) VALUES (?, ?, ?)");
        $insercaoUserAuth->bind_param("ssi", $usuario, $senhaHash, $userId);
        $insercaoUserAuth->execute();
        $insercaoUserAuth->close();

        // Se tudo estiver ok, commita a transação
        $conexao->commit();

        // Redireciona para a página de login
        header("Location: login.php");
        exit;

    } catch (Exception $e) {
        // Se algo der errado, faz rollback
        $conexao->rollback();
        $_SESSION['erro_cadastro'] = "Erro ao cadastrar usuário.";
        header("Location: cadastro.php");
        exit;
    }
}

$conexao->close();
?>