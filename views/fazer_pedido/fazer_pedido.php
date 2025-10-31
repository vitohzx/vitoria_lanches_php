<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fazer pedido</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    
    <link rel="stylesheet" href="../../styles/fazer_pedido.css">
</head>
<body>
    <script> 
        $(document).ready(function() {
            $('#produtos').select2();
        });
    </script>
        <?php

        require_once(__DIR__ . "/../../model/funcoes.php");


        $carrinho = [];

        if(isset($_POST["carrinho"])){
            $carrinho = json_decode($_POST["carrinho"], true);
        }

        if(isset($_POST["produto"]) && isset($_POST["quantProduto"])) {
            $carrinho[] = [
                "quantidade" => $_POST["quantProduto"],
                "produto" => $_POST["produto"]
            ];
        }

        ?>
    <form action="inicio.php?pagina=fazer_pedido" method="post">
        <h1>Fazer pedido</h1>
        <select name="produto" id="produtos">
            <option value="nulo"> Selecione um produto </option>
            <?php
        
            $produto = readProdutos();
            foreach ($produto as $prod) {
                echo "<option value='{$prod['TB_PRODUTO_ID']}'> {$prod['TB_PRODUTO_NOME']} </option>";
            }
            ?>
        </select>
        <input type="number" name="quantProduto" placeholder="Quantidade" min=1 value="1">
        <input type="hidden" name="adicionar">
        <input type="submit" value="ADICIONAR AO CARRINHO">
        <?php
        $carrinhoStr = json_encode($carrinho);

        echo "<input type='hidden' name='carrinho' value='{$carrinhoStr}'>";
        echo "<input type='hidden' name='user' value='{$_POST['user']}'>";
        ?>
    </form>
    <h3> Carrinho </h3>
    <table border="1" cellspacing="0" cellpadding="15">
        <tr style="background-color: #64B5F6"><th>PRODUTO</th><th>QUANTIDADE</th></tr>

    <?php
    foreach($carrinho as $car){
        $produto = getProduto($car["produto"]);
        echo "
                <tr>
                    <td>{$produto["TB_PRODUTO_NOME"]}</td>
                    <td>{$car["quantidade"]}</td>
                </tr>
        ";
    }
    ?>
    </table><br>
    <form action="../../index.php" method="post">
        <input type="submit" value="CONCLUIR PEDIDO">

        <?php
        echo "<input type='hidden' name='carrinho' value='{$carrinhoStr}'>";
        echo "<input type='hidden' name='user' value='{$_POST['user']}'>";
        ?>
        <input type="hidden" name="acao" value="fazerPedido">
    </form>
</body>
</html>