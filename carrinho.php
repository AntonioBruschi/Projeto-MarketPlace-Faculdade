<?php
session_start(); // Iniciar ou retomar a sessão

$localhost = "localhost";
$username = "root";
$password = "123456";
$database = "UAHCIP";

$conn = new mysqli($localhost, $username, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $stmt = $conn->prepare("SELECT nome, descricao, preco FROM produtos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($produto = $result->fetch_assoc()) {
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = array();
        }
        $_SESSION['carrinho'][] = $produto;
        echo "Produto adicionado ao carrinho!";
    } else {
        echo "Produto não encontrado!";
    }

    $stmt->close();
} else {
    echo "Nenhum produto foi selecionado!";
}

$conn->close();
?>
