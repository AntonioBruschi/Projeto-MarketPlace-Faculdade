<?php session_start(); $host = "localhost";
$usuario = "root";
$senha = "123456";
$bancoDeDados = "UAHCIP";

// Conexão com o banco de dados
$conexao = new mysqli($host, $usuario, $senha, $bancoDeDados);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="finalizarcompra.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <span>UAHCIP</span>
    </header>
    <main>
        <div class="page-title">Seu Carrinho</div>
        <div class="content">
            <section>
                <table>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                        </tr>
                    </thead>
                    <tbody id="carrinho-body">
                        <?php if (!empty($_SESSION['carrinho'])): ?>
                            <?php foreach ($_SESSION['carrinho'] as $item): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item['nome']); ?></td>
                                    <td><?php echo htmlspecialchars($item['descricao']); ?></td>
                                    <td><?php echo 'R$ ' . number_format($item['preco'], 2, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">Seu carrinho está vazio</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
            <aside>
                <div class="box">
                    <header>Resumo da compra</header>
                    <div class="info">
                        <!-- Adicionar lógica para calcular subtotal, etc. -->
                        <div><span>Sub-total</span><span></span></div>
                        <div><span>Frete</span><span>Gratuito</span></div>
                        <div>
                            <button>
                                Adicionar cupom de desconto
                                <i class="bx bx-right-arrow-alt"></i>
                            </button>
                        </div>
                    </div>
                    <footer>
                        <span>Total</span>
                        <span></span>
                    </footer>
                </div>
                <button>Finalizar Compra</button>
            </aside>
        </div>
    </main>
</body>
</html>
