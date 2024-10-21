

<?php
//Página para Atualizar os Dados (terceira página)
//Essa é a página onde os dados são enviados para o banco de dados e atualizados, chamada atualizar.php:
// atualizar.php

// Conexão com o banco de dados usando PDO
include "conexao.php";

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $id = (int) $_POST['id'];
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);

    // Verificar se os dados foram preenchidos
    if (!empty($nome) && !empty($email)) {
        // Atualizar os dados no banco de dados
        $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Usuário atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar usuário.";
        }
    } else {
        echo "Todos os campos são obrigatórios!";
    }
} else {
    die("Método inválido.");
}
?>