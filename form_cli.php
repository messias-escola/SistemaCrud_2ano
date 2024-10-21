<?php
include_once "conexao.php";
//$nome = $_POST['nome'];
$nome = isset($_POST['nome']) ? $_POST['nome'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : ""  ;
$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : "";
$senha = isset($_POST[  'senha' ]) ? $_POST['senha'] :"";
$hashed_senha = password_hash($senha, PASSWORD_DEFAULT);

 
//confirmando senhas
if($_POST){
    if($senha == ""){
        $mensagem = "<span class='aviso' <b>Aviso: Senha não foi alterada!</b></span>";
    }elseif($senha == $_POST['confirmarSenha']){
    $mensagem = "<span class='sucesso' <b>Sucesso: As senhas são iguais!".$senha."</b></span>";
    }else{
        $mensagem = "<span class='erro' <b>Erro: As senhas não conferem!</b></span>";
    }
    //echo "<p id='mensagem'>".$mensagem."</p></p>";
    echo "<script type='text/javascript'>alert(<?php $mensagem?>)</script>";
}

if($cpf){
    if (!preg_match("/^[0-9]{3}[0-9]{3}[0-9]{3}[0-9]{2}$/", $cpf)) {
        echo "CPF inválido.";
        exit;
    }
}



$stmt = $conn->prepare("SELECT * FROM cliente WHERE cpf = :cpf");
$stmt->bindParam(':cpf', $cpf);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    echo "<script>alert('CPF já cadastrado.')</script>";
    exit;
}


if($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email inválido.";
        exit;
    }
}
// inserindo dados     
   if(!empty($nome || $email || $senha )){
        try {
            $stmt = $conn->prepare("INSERT INTO cliente  (nome, email, cpf, datanasc, senha, senha_sem_hash) VALUES(:nome, :email, :cpf, :dn,  :senha, :senha_sem_hash)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':dn', $dn);
            $stmt->bindParam(':senha', $hashed_senha);
            $stmt->bindParam(':senha_sem_hash', $senha);
            $stmt->execute();
            echo "<script>alert('Dados inseridos com sucesso.')</script>";
            $nome = "";
            $email= "";
            $cpf= "";
            $senha= "";
            $hashed_senha = "";
        } catch (PDOException $e) {
            erroInserir($e);
        }
    }else{
        echo "";
    }

    function erroInserir($e){
        echo "Erro ao inserir dados: ". $e->getMessage();
        echo "Não houve cadastro porque todos os campos são obrigatórios.";
    }
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="estilo.css">
    <title>Formulario de Dados</title>

    <style>
  
    </style>


</head>
<body>
    <div  id="container">
<div>
<h2>Formulário de Dados</h2><br>
    <div class="form_cli">
        <form method="post" action="">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required  lenght="70" ><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" required onblur = situacao()><br><br>
	        <label for="cn">Data Nascimento:</label>
            <input type="date" id="dn" name="dn" required><br><br>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required><br><br>
            <label for="confirmarSenha">Confirmar Senha:</label>
            <input type="password" id="confirmarSenha" name="confirmarSenha" required onblur = validaSenha()><br><br>
            <input type="submit" value="Enviar">
            <input type="reset" value="Limpar">
        </form>
    </div>
    </div>
    </div>
</body>

<script>
    function situacao(){
        let lercpf = document.getElementById('cpf').value;
    
        let status = valida(lercpf);
        if(status == false){
            alert('CPF inválido!');
        }
    }
    
    function valida(strCPF) {

        var Soma;
        var Resto;
        Soma = 0;
    if (strCPF == "00000000000") return false;

    for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11))  Resto = 0;
        if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

    Soma = 0;
        for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11))  Resto = 0;
        if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
        return true;

    }

    function validaSenha(){
        var senha = document.getElementById('senha').value;
        var confirmarSenha = document.getElementById('confirmarSenha').value;

        if(senha!= confirmarSenha){
            alert('As senhas não conferem!');
            document.getElementById('confirmarSenha').value ="";
            document.getElementById('senha').value = "";
            document.getElementById('senha').focus();
        }
        
    }

    // Mascara de CPF e CNPJ
var CpfCnpjMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length <= 11 ? '000.000.000-009' : '00.000.000/0000-00';
        },
    cpfCnpjpOptions = {
        onKeyPress: function(val, e, field, options) {
        field.mask(CpfCnpjMaskBehavior.apply({}, arguments), options);
      }
    };

$(function() {
    $(':input[name=cpf]').mask(CpfCnpjMaskBehavior, cpfCnpjpOptions);
})
    </script>
</html>
