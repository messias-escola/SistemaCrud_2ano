<?php 
    function get_endereco($cep){
        //formatar o cep removendo caracteres não numéricos
        $cep = preg_replace("/[^0-9]/","",$cep);
        $url = "http://viacep.com.br/ws/$cep/xml/";

        $xml = simplexml_load_file($url);
        return $xml;


    }

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserindo CEP</title>
</head>
<body>

        <?php  $cep = isset($_POST['cep'])? $_POST['cep']: "";
        if($cep){?>
        <br><form action="" method="post">
            CEP: <input type="text" name="cep">
            <button type="submit">Pesquisar Endereço</button>  </br></br>
            <?php $endereco = get_endereco($cep);?>
            CEP: <input type="text" name="cep1" name="cep1"  value='<?php echo $endereco->cep; ?>'><br>
            Logradouro: <input type="text" name="logradouro" name="logradouro"  value='<?php echo $endereco->logradouro; ?>'><br>
            Bairro: <input type="text" name="bairro" name="bairro"  value='<?php echo $endereco->bairro; ?>'></input><br>
            Cidade: <input type="text" name="cidade" name="cidade"  value='<?php echo $endereco->localidade; ?>'></input><br>
            Estado: <input type="text" name="uf" name="uf"  value='<?php echo $endereco->uf; ?>'></input><br>
            
            <button type="submit" name="enviar">ENVIAR</button>
            
        </form>
        <?php } ?>

        

</body>
</html>