<?php
session_start();

// Informações do banco de dados
$localhost = "localhost";
$username = "root";
$password = "123456";
$database = "UAHCIP";

// Verifica se o nome do usuário está na sessão
if (isset($_SESSION['usuario'])) {
    $nomeUsuario = $_SESSION['usuario'];

    // Conexão com o banco de dados
    $conn = new mysqli($localhost, $username, $password, $database);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Função para excluir a conta do usuário
    function deleteAccount($conn, $nomeUsuario) {
        $deleteUserInfoQuery = "DELETE FROM user_info WHERE usuario = '$nomeUsuario'";
        $deleteUserQuery = "DELETE FROM user WHERE usuario = '$nomeUsuario'";

        $conn->query($deleteUserInfoQuery);
        $conn->query($deleteUserQuery);
    }

    // Verifica se a solicitação para excluir a conta foi recebida
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
        deleteAccount($conn, $nomeUsuario);
        echo json_encode(['success' => 'Conta excluída com sucesso!']);
        exit;
    }

    $conn->close();
}
?>