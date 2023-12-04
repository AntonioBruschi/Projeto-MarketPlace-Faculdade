<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - UAHCIP</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-card">
        <div class="logo-container">
            <img src="images/logotipoUAHCIP.png" alt="Logo UAHCIP" class="logo">
        </div>
        <div id="error-message" style="color: red;"></div>
        <form class="form-login" method="post" action="processa_cadastro.php">
            <input type="text" placeholder="Nome" id="nome" name="nome" required />
            <input type="text" placeholder="Sobrenome" id="sobrenome" name="sobrenome" required />
            <input type="email" placeholder="Email" id="email" name="email" required />
            <input type="text" placeholder="Usuário" id="usuario" name="usuario" required />
            <input type="password" placeholder="Senha" id="senha" name="senha" required />
            <input type="password" placeholder="Confirmar Senha" id="confirmarSenha" name="confirmarSenha" required />
            <button type="submit">CADASTRAR</button>
        </form>

        <script>
            var form = document.querySelector(".form-login");
            var errorMessage = document.getElementById("error-message");

            form.addEventListener("submit", function(event) {
                errorMessage.textContent = "";
                var nomeInput = document.getElementById("nome");
                var sobrenomeInput = document.getElementById("sobrenome");
                var emailInput = document.getElementById("email");
                var usuarioInput = document.getElementById("usuario");
                var senhaInput = document.getElementById("senha");
                var confirmarSenhaInput = document.getElementById("confirmarSenha");

                if (nomeInput.value === "" || sobrenomeInput.value === "" || emailInput.value === "" || usuarioInput.value === "" || senhaInput.value === "" || confirmarSenhaInput.value === "") {
                    errorMessage.textContent = "Por favor, preencha todos os campos.";
                    event.preventDefault();
                } else if (senhaInput.value !== confirmarSenhaInput.value) {
                    errorMessage.textContent = "As senhas não coincidem.";
                    event.preventDefault();
                }
            });
        </script>
    </div>
</body>
</html>
