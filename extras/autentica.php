<?php
include_once "conexao.php";

$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : "";
$senha = isset($_POST[  'senha' ]) ? $_POST['senha'] :"";



if($cpf){
    if (!preg_match("/^[0-9]{3}[0-9]{3}[0-9]{3}[0-9]{2}$/", $cpf)) {
        echo "CPF inválido.";
        exit;
    }
}
//validando CPF já existe
try{
$stmt = $conn->prepare("SELECT senha FROM cliente WHERE cpf = :cpf");
$stmt->bindParam(':cpf', $cpf);
$stmt->execute();
//$result = $stmt->fetch(PDO::FETCH_ASSOC);
$result = $stmt->fetchAll();

if($result){
    //echo "Teve Resultado<br>";
    $senhaNoBanco = $result[0]["senha"];
    //echo "Senha registrado no banco de dados: ". $senhaNoBanco;
    //var_dump($result);
    if(password_verify($senha, $senhaNoBanco)){
      echo "Uau! Você logou!";
    }else{
      echo "<br>Ihhhh! Você NÃO logou!";
    }
  }else{
    echo("Sem resultado");
  }
}catch(PDOException $e){
  echo "Erro na inserção de dados: ".$e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Dados</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0px;

        }
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            padding-top:10px;
            
        }
        #container{
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ccc;
            width:100%;
            height: 96vh;
        }

        h2{
            color: blueviolet;
            text-align: center;
        }
     
        #container > div {
            width: 30%;
            background-color: #035E2CFF;
            padding: 5px;
            border: 1px solid black;
            border-radius: 5px;
            color: white;

         }

      #form_cli{
            display: grid; /*dispoe os elementos em duas dimensões*/
            gap: 0.5em; /*especifica um espaço de 0.5em entre os elementos*/
            grid-template-areas:

            "cpf.cpr"
            "senha.senha"
            "submit.reset";
            grid-template-columns: 1fr 0.5em 1fr ;
            margin: 1em auto;
            width: 50%;
        }
        label{
            grid-column: 1; /*coloca tosos os elementos label em  grid coluna 1 */
            text-align: left;
        }

        input{
            grid: 1;
        }
        button{
            grid-area:auto;
        }
*/
    </style>


</head>
<body>
    <div  id="container">
<div>
<h2>Formulário de Dados</h2><br>
    <div id="form_autentica">
        <form method="post" action="">

            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" ><br><br>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required><br><br>
            <input type="submit" value="Enviar">
            <input type="reset" value="Limpar">
        </form>
    </div>
    </div>
    </div>
</body>


</html>
