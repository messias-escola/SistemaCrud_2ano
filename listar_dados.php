<?php 
    include_once 'conexao.php';

    $stmt = $conn->query("SELECT * FROM cliente");
    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //codigo para deletar o registro escolhido;
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    echo $id;
        //Buscar os dados da Linha com o ID específico e deletar
        $stmt = $conn->prepare("DELETE FROM cliente WHERE id_cliente = :id");
        $stmt->execute(['id' => $id]);
        $linha = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$linha) {
            echo "Registro não encontrado.";
            exit;
        }
    //fim do código para deletar   */
?>
<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Listar Dados</title>
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body{
            font-family:Verdana, Geneva, Tahoma, sans-serif;
            margin: 10px;

        }
        table{
            background-color: white;
            width: 70vw;
            border: solid 1px black;
            margin: 10px auto;
        }
        tr{
            background-color: #dddddd;
            border: solid 1px black;
            padding: 3px;
        }
        th{
            background-color: #999999;
            border: solid 1px black;
            padding: 3px;
            color: white;
        }
        td{
            border: solid 1px #999999;
            padding-left: 10px;
            font-size: 0.8em;
        }
        #busca{
            margin: 10px auto;
            padding: 5px;
        }
        #tituloPagina{
            margin: 10px;
            text-align: center;
        }
        .icone{
            width:20px;
           text-align: center;
        }
        .icone:hover{
            width:25px;
        }
    

    </style>
    <SCRIPT>
        //pega todos os botoes
        const botoes = document.querySelectorAll('#edit');
      

        for (let i = 0; i < botoes.length; i++) {
            //escuta o evento de click em cada botao
            botoes[i].addEventListener('click', function (e) {
                //pega o numero do botao clicado
                alert(botoes[i]);
                const numeroAcao = this.dataset.numero;

                //redireciona para emprestimos.php passando o numero do botao
                window.location.href = 'edit_registro.php?numeroAcao=${numeroSacola}';
            });
        }
    </SCRIP>
</head>
<body>
    <h2>Clientes Registrados</h2>
    <table border="5">
        <thead>
            <tr><th>ID</th><th>NOME</th><th>EMAIL</th><th>CPF</th><th>DATA_NASC</th><th colspan='2'>Editar</th></tr>
        </thead>
        <tbody>
    <?php
    foreach($dados as $linha): 
    ?> 
    <tr><td><?php echo $linha['id_cliente'];?></td>
    <td><?php echo htmlspecialchars($linha['nome']);?></td>
    <td><?php echo htmlspecialchars($linha['email']);?></td>
    <td><?php echo htmlspecialchars($linha['cpf']);?></td>
    <td><?php echo htmlspecialchars($linha['datanasc']);?></td>
    <td><a href="editar_reg.php?id=<?php echo $linha['id_cliente']; ?>">Editar</a></td>
    <td><a href="listar_dados.php?id=<?php echo $linha['id_cliente']; ?>">DEL</a></td></tr>
    <?php endforeach;?>
    </tbody>
    </table>

</body>
</html>