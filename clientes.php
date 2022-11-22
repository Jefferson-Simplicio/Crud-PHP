<?php
    include('conexao.php');

    $sql_clientes = "SELECT * FROM clientes";
    $query_clientes = $mysqli->query($sql_clientes) or die($mysqli->error);
    $num_cli = $query_clientes->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="stylesheet.css" media="screen" />
    <title>Clientes</title>
</head>
<body>
    <h1>Clientes Salvos</h1>
    <p>Estes são os clientes cadastrados: </p>
        <table border="1" cellpadding="10">
            <thead>
                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Data de Nascimento</th>
                <th>Data de Cadastro</th>
                <th>Ações</th>
            </thead>
            <tbody>
                <?php if($num_cli == 0 ){ ?>
                <tr>
                    <td colspan="7">NENHUM CLIENTE FOI ENCONTRADO</td>
                </tr>
                <?php } 
                else{ 
                    while($clientes = $query_clientes->fetch_assoc()){
                        
                        $telefone ="Não informado";
                        if(!empty($clientes['telefone'])){
                            $telefone = formatar_telefone($clientes['telefone']);
                        } 
                        $data = "Não informado";
                        if(!empty($clientes['data_nasc'])){
                            $data = formatar_data($clientes['data_nasc']);
                        }   

                        $data_cadastro = date("d/m/Y H:i",strtotime($clientes['data_cad']));
                    ?>
                    <tr>
                        <td><?php echo $clientes['id']; ?></td>
                        <td><?php echo $clientes['nome']; ?></td>
                        <td><?php echo $telefone?></td>
                        <td><?php echo $clientes['email']; ?></td>
                        <td><?php echo $data?></td>
                        <td><?php echo $data_cadastro?></td>
                        <td><a href="editar_cliente.php?id=<?php echo $clientes['id']; ?>">Editar</a>
                            <a href="excluir.cliente.php?id=<?php echo $clientes['id']; ?>">Excluir</a></td>
                    </tr>
                <?php }
            } ?>    
            </tbody>
        </table>
        <p><a href="cadastrar_cli.php">Cadastrar novos Clientes</a></p>
</body>
</html>