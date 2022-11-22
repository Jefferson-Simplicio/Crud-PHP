<?php
include('conexao.php');
$id =intval($_GET['id']);
    function limpar_texto($str){ 
        return preg_replace("/[^0-9]/", "", $str);
    }

$erro = false;
if (count($_POST) > 0) {

    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $data_nasc = $_POST['data_nasc'];

    if(empty($nome)){
        $erro = "Preencha o nome";
    }

    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $erro = "Preencha o e-mail ou informe um e-mail válido";
    }

    if(!empty($data_nasc)){
        $pedacos = explode('/',$data_nasc);
        if(count($pedacos) == 3){
            $data_nasc = implode('-', array_reverse($pedacos));
        }else{
            $erro = "A data deve seguir o padrão dd/mm/aaaa.";
        }
    }

    if(!empty($telefone)){
        $telefone = limpar_texto($telefone);
        if(strlen($telefone) != 11){
            $erro = "O telefone deve ser preenchido no padrão (11) 98888-8888";
        }
    }

    if($erro){
        echo "<p><b>ERRO: $erro</b></p>";
    }else{
        $sql_code = "UPDATE clientes
        SET nome = '$nome',
        telefone =  '$telefone', 
        email = '$email', 
        data_nasc = '$data_nasc' 
        WHERE id = '$id'";
        $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
        if($deu_certo){
            echo "<p><b>Cliente atualizado com sucesso!!!</b></p>";
            unset($_POST);
        }
    }
}

$sql_con_cliente = "SELECT * FROM clientes WHERE id = '$id'";
$query_cliente = $mysqli->query($sql_con_cliente) or die($mysqli->error);
$cliente = $query_cliente->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <a href= "clientes.php">Voltar pra lista</a>
    <form method="POST" action="">
    <h1>CADASTRAR</h1>
        <p>
            <label>Nome: </label>
            <input value="<?php echo $cliente['nome']; ?>" type=text name=nome>
        </p>
        <p>
            <label>Telefone: </label>
            <input value="<?php if(!empty($cliente['telefone']))  echo formatar_telefone($cliente['telefone']); ?>" type="text" name=telefone placeholder="(11) 98888-8888">
        </p>
        <p>
            <label>E-mail: </label>
            <input value="<?php echo $cliente['email']; ?>" type=text name=email>
        </p>
        <p>
            <label>Data de Nascimento</label>
            <input value="<?php if(!empty($cliente['data_nasc'])) echo formatar_data($cliente['data_nasc']); ?>" type=text name=data_nasc placeholder="dd/mm/aaaa">
        </p>
        <p>
            <button type="submit">Cadastrar</button>
        </p>
    </form>
</body>
</html>