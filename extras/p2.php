<?php
include 'conexao.php';

// Verificar se o ID foi enviado via GET
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Buscar os dados do usuário pelo ID
    $stmt = $conn->prepare("SELECT id, nome, email FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        die("Usuário não encontrado!");
    }
} else {
    die("ID não fornecido.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
</head>
<body>

    <h2>Editar Usuário</h2>

    <!-- Formulário para editar os dados do usuário -->
    <form action="p3.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required><br><br>

        <input type="submit" value="Atualizar">
    </form>

</body>
</html>
