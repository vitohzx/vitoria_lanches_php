<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Produtos</title>
    <link rel='stylesheet' href='../../styles/produtos.css'>
</head>

<body>
    <script>
        $(document).ready(function() {
            $('.selectProd').select2();
        });
    </script>

    <form action='../../index.php' method='post' class='formStyle'>
        <span class='subtitulo'> CADASTRAR PRODUTOS </span>
        <div class='linha'>
            <img src='../../images/user (3).png' alt='' style='width: 31px; height: 31px; margin-left: 5%'>
            <input type='text' name='nomeProduto' id='' placeholder='NOME PRODUTO' required class='textInput'>
        </div>
        <div class='linha'>
            <img src='../../images/user (3).png' alt='' style='width: 31px; height: 31px; margin-left: 5%'>
            <input type='text' name='precoProduto' id='' placeholder='PREÇO PRODUTO' required class='textInput'>
        </div>
        <div class='linha'>
            <img src='../../images/user (3).png' alt='' style='width: 31px; height: 31px; margin-left: 5%'>
            <input type='text' name='descProduto' id='' placeholder='DESCRIÇÃO PRODUTO' class='textInput'>
        </div>
        <div class='linha2'>
            <select name='categoria' id='selectProd' class='selectProd'>
                <option value='nulo'> Selecione uma categoria </option>
                <?php

                require_once(__DIR__ . '/../../model/funcoes.php');

                $categoria = readCategorias();
                foreach ($categoria as $cat) {
                    echo "<option value='{$cat['TB_TIPO_PRODUTO_ID']}'> {$cat['TB_TIPO_PRODUTO_DESC']} </option>";
                }
                ?>
            </select>

            <input type='submit' value='CADASTRAR PRODUTO' class='cadProd'>
            
            <input type='hidden' name='acao' value='criar'>
        </div>
    </form>




    <form action='../../index.php' method='post' class='formStyle'>
        <span class='subtitulo'> CADASTRAR CATEGORIAS </span>
        <div class='linha'>
            <img src='../../images/user (3).png' alt='' style='width: 31px; height: 31px; margin-left: 5%'>
            <input type='text' name='nomeCategoria' id='' placeholder='NOME CATEGORIA' required class='textInput'>
        </div>
        <input type='submit' value='CRIAR CATEGORIA' class='cadProd' style='margin-left: 0'>
        <input type='hidden' name='acao' value='criarCategoria'>
        
    </form>


    <form action='inicio.php?pagina=gerenciar_produtos' method='post' class='formStyle'>
        <span class='subtitulo'> EDITAR PRODUTO </span>

        <div class='linha2'>
            <select name='produtos' id='' class='selectProd'>
                <option value='nulo'>Selecione um produto</option>
                <?php

                require_once(__DIR__ . '/../../model/funcoes.php');

                $produtos = readProdutos();
                foreach ($produtos as $prod) {
                    echo "<option value='{$prod['TB_PRODUTO_ID']}'> {$prod['TB_PRODUTO_NOME']} </option>";
                }
                ?>
            </select>
            <input type='submit' value='SELECIONAR' class="cadProd">
            
        </div>
    </form>

    <?php
    if (isset($_POST['produtos'])) {
        $produto = getProduto($_POST["produtos"]);
        echo "
            <form action='../index.php' method='post' class='formStyle'>
                <div class='linha'>
                    <img src='../../images/user (3).png' alt='' style='width: 31px; height: 31px; margin-left: 5%'>
                    <input type='text' name='nomeProduto' id='' placeholder='NOME PRODUTO' required class='textInput' value='{$produto["TB_PRODUTO_NOME"]}'>
                </div>

                <div class='linha'>
                    <img src='../../images/user (3).png' alt='' style='width: 31px; height: 31px; margin-left: 5%'>
                    <input type='text' name='precoProduto' id='' placeholder='PREÇO PRODUTO' required class='textInput' value='{$produto["TB_PRODUTO_PRECO_UNIT"]}'>
                </div>

                <div class='linha'>
                    <img src='../../images/user (3).png' alt='' style='width: 31px; height: 31px; margin-left: 5%'>
                    <input type='text' name='descProduto' id='' placeholder='DESCRIÇÃO PRODUTO' class='textInput' value='{$produto["TB_PRODUTO_DESC"]}'>
                </div>


                <input type='submit' value='EDITAR PRODUTO' class='cadProd' style='margin-left: 0'>
                <input type='hidden' name='acao' value='editProduto'>
                <input type='hidden' name='user' value='{$_POST['user']}'>
            </form>
        ";
    }
    ?>




    <form action='../../index.php' method='post' class='formStyle'>
        <span class='subtitulo'> EDITAR CATEGORIAS </span>

        <div class="linha2" style="height: 7vh; justify-content: space-between">
            <select name='categoria' id='selectProd' class='selectProd' style="width: 47%">
                <option value='nulo'> Selecione uma categoria </option>
                <?php

                require_once(__DIR__ . '/../../model/funcoes.php');

                $categoria = readCategorias();
                foreach ($categoria as $cat) {
                    echo "<option value='{$cat['TB_TIPO_PRODUTO_ID']}'> {$cat['TB_TIPO_PRODUTO_DESC']} </option>";
                }
                ?>
            </select>

            <div class='linha' style='height: 100%; width: 47%; margin: 0;'>
                <img src='../../images/user (3).png' alt='' style='width: 31px; height: 31px; margin-left: 5%'>
                <input type='text' name='nomeCategoria' id='' placeholder='NOME CATEGORIA' required class='textInput'>
            </div>
        </div>

        <input type='submit' value='EDITAR CATEGORIA' class='cadProd' style='margin-left: 0; margin-top: 5%'>
        <input type='hidden' name='acao' value='editCategoria'>
        
    </form>


    <form action="../../index.php" method="post" class="formStyle">
        <span class="subtitulo"> DELETAR PRODUTO </span>
        <div class="linha2" style="justify-content: space-between">
            <select name='produto' id='' class='selectProd'>
                <option value='nulo'>Selecione um produto</option>
                <?php

                require_once(__DIR__ . '/../../model/funcoes.php');

                $produtos = readProdutos();
                foreach ($produtos as $prod) {
                    echo "<option value='{$prod['TB_PRODUTO_ID']}'> {$prod['TB_PRODUTO_NOME']} </option>";
                }
                ?>
            </select>
            <input type='submit' value='DELETAR PRODUTO' class='cadProd' style='margin-left: 0;'>
        </div>
        <input type='hidden' name='acao' value='deleteProduto'>
        
    </form>


    <form action="../../index.php" method="post" class="formStyle">
        <span class="subtitulo"> DELETAR CATEGORIA </span>
        <div class="linha2" style="justify-content: space-between">
            <select name='categoria' id='selectProd' class='selectProd'>
                <option value='nulo'> Selecione uma categoria </option>
                <?php

                require_once(__DIR__ . '/../../model/funcoes.php');

                $categoria = readCategorias();
                foreach ($categoria as $cat) {
                    echo "<option value='{$cat['TB_TIPO_PRODUTO_ID']}'> {$cat['TB_TIPO_PRODUTO_DESC']} </option>";
                }
                ?>
            </select>
            <input type='submit' value='DELETAR CATEGORIA' class='cadProd' style='margin-left: 0;'>
        </div>
        <input type='hidden' name='acao' value='deleteCategoria'>
        
    </form>


</html>