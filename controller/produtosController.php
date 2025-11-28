<?php

require("model/produtosModel.php");

function criarProd(){
    $nomeProduto = $_POST["nomeProduto"];
    $descProduto = $_POST["descProduto"];
    $precoProduto = $_POST["precoProduto"];
    $categoriaProduto = $_POST["categoria"];
    
    $produto = new ProdutosModel($nomeProduto, $descProduto, $precoProduto, $categoriaProduto);
    $produto->criarProduto();
    
    header("Location: ./views/home/inicio.php?pagina=gerenciar_produtos");
}

function deleteProd(){
    $produtoID = $_POST["produto"];

    $produto = new ProdutosModel();
    $produto->deleteProduto($produtoID);
    
    header("Location: ./views/home/inicio.php?pagina=gerenciar_produtos");
}

function editProd(){
    $nomeProduto = $_POST["nomeProduto"];
    $descProduto = $_POST["descProduto"];
    $precoProduto = $_POST["precoProduto"];
    $produtoId = $_POST["produto"];

    $produto = new ProdutosModel($nomeProduto, $descProduto, $precoProduto);
    $produto->editarProduto($produtoId);
    
    header("Location: ./views/home/inicio.php?pagina=gerenciar_produtos");
}
