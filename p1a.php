<?php 
    include_once 'conexao.php';

    $stmt = $conn->query("SELECT * FROM cliente");
    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    </SCRIPT>
</head>
<body>
    <table border="5">
        <thead>
            <tr><th>ID</th><th>NOME</th><th>EMAIL</th><th>CPF</th><th>DATA_NASC</th><th>Editar</th></tr>
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
    <td><a href="p2a.php?id=<?php echo $linha['id_cliente']; ?>">Editar</a></td></tr>
    <?php endforeach;?>
    </tbody>
    </table>

</body>
</html>