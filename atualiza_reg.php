<?php 
    include 'conexao.php';

    //Verifica se os dados do formulário foram enviados

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = (int) $_POST['id_cliente'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $datanasc = $_POST['datanasc'];

        if($id > 0 && !empty($nome) && filter_var($email, FILTER_VALIDATE_EMAIL)){
            //preparar a consulta SQL para atualizar

            $stmt = $conn->prepare("UPDATE cliente SET nome = :nome, email = :email, cpf=:cpf, datanasc = :datanasc WHERE id_cliente = :id");
            $stmt->execute([
                'nome' => $nome,
                'email' => $email,
                'cpf' => $cpf,
                'datanasc' => $datanasc,
                'id'=> $id

            ]);

            echo "Dados atualizados com sucesso!";
            //Vamos redirecionar para a pagina de listagem
            header('Location: listar_dados.php');
        }else{
            echo "Erro: Verifique os dados enviados";
        }
    }
?>