<?php
// Informações do banco de dados
$localhost = "localhost";
$username = "root";
$password = "123456";
$database = "UAHCIP";

// Conectar ao banco de dados
$conn = new mysqli($localhost, $username, $password, $database);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Obter dados do formulário
$firstName = $_POST['first-name'];
$lastName = $_POST['last-name'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$observations = $_POST['observations'];

// Preparar a consulta SQL para inserir os dados na tabela
$sql = "INSERT INTO orcamentos (NOME, SOBRENOME, CPF, EMAIL, OBSERVACOES) VALUES ('$firstName', '$lastName', '$cpf', '$email', '$observations')";

// Executar a consulta
if ($conn->query($sql) === TRUE) {
    // Se a inserção foi bem-sucedida, redirecionar para a página de index e informar ao usuário
    echo '<script>
            alert("Orçamento enviado com sucesso!");
            window.location.href = "index.html";
          </script>';
} else {
    // Se houver um erro na consulta, exiba uma mensagem de erro
    echo "Erro ao inserir dados: " . $conn->error;
}

// Fechar a conexão
$conn->close();
?>
