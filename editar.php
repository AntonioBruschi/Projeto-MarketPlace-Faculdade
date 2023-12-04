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

    // Query para obter os dados do usuário usando o nome do usuário da sessão
    $query = "SELECT nome, sobrenome, cpf, telefone, email FROM user_info WHERE usuario = '$nomeUsuario'";
    $result = $conn->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            // Adiciona um identificador único para facilitar o acesso no JavaScript
            $row = $result->fetch_assoc();
            $row['identifier'] = uniqid();
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'Nenhum dado encontrado para o usuário']);
        }
    } else {
        echo json_encode(['error' => 'Erro na execução da consulta: ' . $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(['error' => 'Nome do usuário não encontrado na sessão']);
}
?>
