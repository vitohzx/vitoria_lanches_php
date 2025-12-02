<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo</title>
    <link rel="stylesheet" href="../../styles/catalogo.css">
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Categoria</th>
            </tr>
        </thead>
        <tbody>
    <?php
    require_once(__DIR__ . "/../../model/produtosModel.php");

    $produtos = readProdutos();

    
    foreach ($produtos as $produto) {
        $preco = number_format($produto['TB_PRODUTO_PRECO_UNIT'], 2, ',', '.');
        echo "<tr>
            <td>{$produto['TB_PRODUTO_NOME']}</td>
            <td>{$produto['TB_PRODUTO_DESC']}</td>
            <td>{$preco}</td>
            <td>{$produto['TB_TIPO_PRODUTO_DESC']}</td>
        </tr>";
    }
    ?>

    </tbody>
    </table>
</body>
</html>