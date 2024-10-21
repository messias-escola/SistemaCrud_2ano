<?php
include 'conexao.php';

//obtendo o ID passado na url
//$id = $_GET['id_cliente'];
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
    //Buscar os dados da Linha com o ID específico
    $stmt = $conn->prepare("SELECT * FROM cliente WHERE id_cliente = :id");
    $stmt->execute(['id' => $id]);
    $linha = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$linha) {
        echo "Registro não encontrado.";
        exit;
    }
} else {
    echo "O Id do cliente a ser editado é inválido.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Edição de Dados</title>
    <style>

    </style>

</head>

<body>
    <div id="container">
        <div>
            <h2>Edição de Dados</h2><br>
            <div class="form_cli">
                <!--FORMULÁRIO PARA EDIÇÃO DO REGISTRO PESQUISADO-->

                <form action="atualiza_reg.php" method="POST">
                    <input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $linha['id_cliente']; ?>"><br><br>
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?php echo ($linha['nome']); ?>" required><br><br>
                    <label for="nome">Email:</label>
                    <input type="text" id="email" name="email" value="<?php echo ($linha['email']); ?>" required><br><br>
                    <label for="nome">CPF:</label>
                    <input type="text" id="cpf" name="cpf" value="<?php echo ($linha['cpf']); ?>" required><br><br>
                    <label for="nome">Data de Nascimento:</label>
                    <input type="text" id="datanasc" name="datanasc" value="<?php echo ($linha['datanasc']); ?>" required><br><br>
                    <input type="submit" value="Atualizar Registro">
                </form>

            </div>
        </div>
</body>

</html>