<?php

    if(isset($_POST['confirmar'])){

        include('conexao.php');
        $id = intval($_GET['id']);
        $sql_code = "DELETE FROM clientes where id = '$id'";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

        if ($sql_query){ ?>

            <h1>Cliente deletado com sucesso!</h1>
            <p><a href="clientes.php">Clique aqui</a> para voltar para a tela de clientes.</p>

        <?php die();}

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Cliente</title>
</head>
<body>
    <h1>Você tem certeza que deseja excluir este cliente?</h1>
    <form method="POST">
        <a href="clientes.php">NÃO</a>
        <button name="confirmar" value="1" type="submit">SIM</button>
    </form>
</body>
</html>