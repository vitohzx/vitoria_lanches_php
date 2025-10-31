<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuarios</title>
    <link rel="stylesheet" href="../../styles/pedidos.css">
</head>
<body>
    <h1> Gerenciar Pedidos Pendentes</h1>
    <form action="../../index.php" method="post">

    <?php
    require_once(__DIR__ . "/../../model/funcoes.php");
    $pedidos = getPedidos();
    
    
    if(count($pedidos) != 0){
        $pdd = getPedidoFormat();

        echo "<table border='1' cellspacing='0'>
                <tr><th>ID DO PEDIDO</th><th>CLIENTE</th><th>PRODUTO</th><th>QUANTIDADE</th><th>DATA DO PEDIDO</th><th>FORMA DE PAGAMENTO</th></th><th></th><th>STATUS</th><th>CONCLUIDO</th></tr>
        ";

        foreach($pdd as $pedido){
            if($pedido["status"] != "pendente") continue;
            echo "
                    <tr>
                        <td>{$pedido["id"]}</td>
                        <td>{$pedido["cliente"]}</td>
                        <td>{$pedido["produto"]}</td>
                        <td>{$pedido["quantidade"]}</td>
                        <td>{$pedido["data"]}</td>
                        <td>{$pedido["forma_pag"]}</td>
                        <td>{$pedido["obs"]}</td>
                        <td>{$pedido["status"]}</td>
                        <td><input type='checkbox' id='{$pedido["idVenda"]}' name='pedidos[]' value='{$pedido["idVenda"]}'>
                            <label for='{$pedido["idVenda"]}'></label>
                        </td>
                    </tr>
                ";
        }
        echo "</table>";
    }
    else {
        echo "<script>alert('Nenhum pedido encontrado');</script>";
    }
    ?>
    </form>

    <h1> Historico de Pedidos </h1>

    <?php
    $pedidos = getPedidos();
    
    if(count($pedidos) != 0){
        $pdd = getPedidoFormat();

        echo "<table border='1' cellspacing='0'>
                <tr><th>ID DO PEDIDO</th><th>CLIENTE</th><th>PRODUTO</th><th>QUANTIDADE</th><th>DATA DO PEDIDO</th><th>FORMA DE PAGAMENTO</th></th><th></th><th>STATUS</th></tr>
        ";

        foreach($pdd as $pedido){
            if($pedido["status"] == "pendente") continue;
            echo "
                    <tr>
                        <td>{$pedido["id"]}</td>
                        <td>{$pedido["cliente"]}</td>
                        <td>{$pedido["produto"]}</td>
                        <td>{$pedido["quantidade"]}</td>
                        <td>{$pedido["data"]}</td>
                        <td>{$pedido["forma_pag"]}</td>
                        <td>{$pedido["obs"]}</td>
                        <td>{$pedido["status"]}</td>
                    </tr>
                ";
        }
        echo "</table>";
    }
    else {
        echo "<script>alert('Nenhum pedido encontrado');</script>";
    }
    ?>

</body>
</html>