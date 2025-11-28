<?php

require("./model/categoriasModel.php");

function criarCat(){
    $nomeCategoria = $_POST["nomeCategoria"];
    criarCategoria($nomeCategoria);
    
    header("Location: ./views/home/inicio.php?pagina=gerenciar_produtos");
}

function deleteCat(){
    $categoriaID = $_POST["categoria"];
    deleteCategoria($categoriaID);

    header("Location: ./views/home/inicio.php?pagina=gerenciar_produtos");
}

function editCat(){
    $nomeCategoria = $_POST["nomeCategoria"];
    $categoriaID = $_POST["categoria"];
    editarCategoria($nomeCategoria, $categoriaID);

    header("Location: ./views/home/inicio.php?pagina=gerenciar_produtos");
}