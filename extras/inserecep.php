<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <form>
        <label for "cep">CEP</label>
        <input id="cep" type="text" required><br><br>
        <label for "logradouro">Logradouro</label>
        <input id="logradouro" type="text" required><br><br>
        <label for "numero">Numero</label>
        <input id="numero" type="text" required><br><br>
        <label for "complemento">Complemento</label>
        <input id="complemento" type="text" required><br><br>
        <label for "bairro">Bairro</label>
        <input id="bairro" type="text" required><br><br>
       
        <label for "uf">Estado</label>
        <Select id="uf" 
        <option value="AC">Acre</option>
			<option value="AL">Alagoas</option>
			<option value="AP">Amapá</option>
			<option value="AM">Amazonas</option>
			<option value="BA">Bahia</option>
			<option value="CE">Ceará</option>
			<option value="DF">Distrito Federal</option>
			<option value="ES">Espírito Santo</option>
			<option value="GO">Goiás</option>
			<option value="MA">Maranhão</option>
			<option value="MT">Mato Grosso</option>
			<option value="MS">Mato Grosso do Sul</option>
			<option value="MG">Minas Gerais</option>
			<option value="PA">Pará</option>
			<option value="PB">Paraíba</option>
			<option value="PR">Paraná</option>
			<option value="PE">Pernambuco</option>
			<option value="PI">Piauí</option>
			<option value="RJ">Rio de Janeiro</option>
			<option value="RN">Rio Grande do Norte</option>
			<option value="RS">Rio Grande do Sul</option>
			<option value="RO">Rondônia</option>
			<option value="RR">Roraima</option>
			<option value="SC">Santa Catarina</option>
			<option value="SP">São Paulo</option>
			<option value="SE">Sergipe</option>
			<option value="TO">Tocantins</option>
        </select><br><br>
    </form>


<script type="text/javascript">
    $("#cep").focusout(function(){
       // alert("saiu do foco");
        //inicio do comando AJAX
        $.ajax({
            //O campo URL diz o caminho de onde virão os dados
            //É importante concatenar o valor digitado no CEP
            url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
            //Aqui você deve preencher o tipo de dados que será lido,
            //no caso, estamos lendo JSON.
            dataType: 'json',
            //SUCESS é referente à função queserá execuada caso
            //ele consiga ler a fonte de dados com sucesso.
            //O parametro dentro da função se refere ao nome da variável
            //que você vai dar par aler esse objeto.
            sucess:function(resposta){
                //Agora basta definir os valores que você deseja preencher
                //automaticamente nos campos acima
                $("#logradouro").val(resposta.logradouro);
                $("#complemento").val(resposta.complemento);
                $("#bairro").val(resposta.bairro);
                $("#cidade").val(resposta.cidade);
                $("#uf").val(resposta.uf);
                //Vamos incluir para que o Numero seja focado automaticamente
                //melhorando a experiência do usuário
                $("#numero").focus();
            }
        });
    });
</script>
</body>
</html>