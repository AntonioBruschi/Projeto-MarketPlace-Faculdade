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

    // Inicializa um array para armazenar mensagens de erro ou sucesso
    $response = [];

    // Verifica se a ação é uma atualização
    if ($_POST['action'] === 'update') {
        // Remove o campo de ação do FormData
        unset($_POST['action']);

        // Atualiza os campos editados no banco de dados
        foreach ($_POST as $field => $value) {
            $field = $conn->real_escape_string($field);
            $value = $conn->real_escape_string($value);

            $query = "UPDATE user_info SET $field = '$value' WHERE usuario = '$nomeUsuario'";
            $result = $conn->query($query);

            if (!$result) {
                $response['error'][] = 'Erro ao atualizar o campo ' . $field . ': ' . $conn->error;
            }
        }

        // Verifica se houve algum erro durante a atualização
        if (isset($response['error'])) {
            echo json_encode(['error' => implode(', ', $response['error'])]); // Combina os erros em uma string
        } else {
            echo json_encode(['success' => 'Alterações salvas com sucesso!']);
        }
    } else {
        echo json_encode(['error' => 'Ação desconhecida']);
    }

    $conn->close();
} else {
    echo json_encode(['error' => 'Nome do usuário não encontrado na sessão']);
}
?>
