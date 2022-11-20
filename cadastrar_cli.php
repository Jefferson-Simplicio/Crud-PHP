<?php

    function limpar_texto($str){ 
        return preg_replace("/[^0-9]/", "", $str);
    }

$erro = false;
if (count($_POST) > 0) {

    include('conexao.php');

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
        $sql_code = "INSERT INTO clientes (nome, telefone, email, data_nasc, data_cad) 
        VALUES('$nome', '$telefone', '$email', '$data_nasc', NOW())";
        $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
        if($deu_certo){
            echo "<p><b>CLiente cadastrado com sucesso!!!</b></p>";
            unset($_POST);
        }
    }
}

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
    <form method="POST" action="">
    <h1>CADASTRAR</h1>
        <p>
            <label>Nome: </label>
            <input value="<?php if (isset($_POST['nome'])) echo $_POST['nome']; ?>" type=text name=nome>
        </p>
        <p>
            <label>Telefone: </label>
            <input value="<?php if (isset($_POST['telefone'])) echo $_POST['telefone']; ?>" type="text" name=telefone placeholder="(11) 98888-8888">
        </p>
        <p>
            <label>E-mail: </label>
            <input value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" type=text name=email>
        </p>
        <p>
            <label>Data de Nascimento</label>
            <input value="<?php if (isset($_POST['data_nasc'])) echo $_POST['data_nasc']; ?>" type=text name=data_nasc placeholder="dd/mm/aaaa">
        </p>
        <p>
            <button type="submit">Cadastrar</button>
        </p>
    </form>
</body>
</html>