<?php
// Informações do banco de dados
$localhost = "localhost";
$username = "root";
$password = "123456";
$database = "UAHCIP";

// Inicia a sessão
session_start();

// Conectar ao banco de dados
$conn = new mysqli($localhost, $username, $password, $database);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Obter dados do formulário
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

// Consulta SQL para buscar o usuário na tabela 'user_auth'
$sql = "SELECT * FROM user_auth WHERE username='$usuario'";
$result = $conn->query($sql);

// Verificar se há correspondências
if ($result->num_rows > 0) {
    // Obtém o hash da senha do banco de dados
    $row = $result->fetch_assoc();
    $hash = $row['password_hash'];

    // Verifica se a senha fornecida corresponde ao hash
    if (password_verify($senha, $hash)) {
        // Autenticação bem-sucedida
        $_SESSION['usuario'] = $usuario; // Armazena o nome do usuário na sessão
        header("Location: grafico.html");
    } else {
        // Senha incorreta
        $_SESSION['erro'] = "Usuário ou senha incorretos";
        header("Location: login.php");
    }
} else {
    // Nome de usuário não encontrado
    $_SESSION['erro'] = "Usuário ou senha incorretos";
    header("Location: login.php");
}

// Fechar a conexão
$conn->close();
?>
