<?php
 include 'conexao.php';

 //obtendo o ID passado na url
 //$id = $_GET['id_cliente'];
 $id = isset($_GET['id'])? (int)$_GET['id']: 0;
echo (int)$id;
 if($id > 0){ 
    //Buscar os dados da Linha com o ID específico
    $stmt = $conn-> prepare("SELECT * FROM cliente WHERE id_cliente = :id");
    $stmt -> execute(['id' => $id]);
    $linha = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$linha){
        echo "Registro não encontrado.";
        exit;
    }
 }else{
    echo "O Id do cliente a ser editado é inválido.";
    exit;
 }
?>

<!--FORMULÁRIO PARA EDIÇÃO DO REGISTRO PESQUISADO-->
<form action="atualiza_reg.php" method="POST">
    <input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $linha['id_cliente'];?>"><br><br>
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo($linha['nome']);?>" required><br><br>
    <label for="nome">Email:</label>
    <input type="text" id="email" name="email" value="<?php echo($linha['email']);?>" required><br><br>
    <label for="nome">CPF:</label>
    <input type="text" id="cpf" name="cpf" value="<?php echo($linha['cpf']);?>" required><br><br>
    <label for="nome">Data de Nascimento:</label>
    <input type="text" id="datanasc" name="datanasc" value="<?php echo($linha['datanasc']);?>" required><br><br>
    <input type="submit" value="Atualizar Registro">
   

</form>
