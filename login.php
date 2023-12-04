<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UAHCIP</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-card">
        <div class="logo-container">
            <img src="images/logotipoUAHCIP.png" alt="Logo UAHCIP" class="logo">
        </div>
        <div id="error-message" style="color: red;">
            <?php
            session_start();
            if (isset($_SESSION['erro'])) {
                echo $_SESSION['erro'];
                unset($_SESSION['erro']);
            }
            ?>
        </div>
        <form class="form-login" method="post" action="processa_login.php">
            <input type="text" placeholder="Usuário" id="usuario" name="usuario" required />
            <input type="password" placeholder="Senha" id="senha" name="senha" required />
            <button type="submit">LOGIN</button>
            <button id="btnCadastro">CADASTRO</button>
        </form>

        <script>
            var form = document.querySelector(".form-login");
            var errorMessage = document.getElementById("error-message");

            form.addEventListener("submit", function(event) {
                errorMessage.textContent = "";
                var usuarioInput = document.getElementById("usuario");
                var senhaInput = document.getElementById("senha");

                if (usuarioInput.value === "" || senhaInput.value === "") {
                    errorMessage.textContent = "Por favor, preencha todos os campos.";
                    event.preventDefault();
                }
            });

            var btnCadastro = document.getElementById("btnCadastro");
            btnCadastro.addEventListener("click", function() {
                window.location.href = "cadastro.php"; // Substitua por sua URL de cadastro
            });
        </script>
    </div>
</body>
</html>
