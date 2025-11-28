<?php

function readCategorias(){
    $sql = "SELECT * FROM tb_tipo_produto";       
    $conexao = conectarBanco();   
    $result = $conexao->query($sql);
    $categorias = [];

    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row;
    }
    $conexao->close();

    return $categorias;
}

function criarCategoria($nome){
    $sql = "INSERT INTO tb_tipo_produto (TB_TIPO_PRODUTO_DESC) VALUES (?)";
    $conexao = conectarBanco();
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $stmt->close();
    $conexao->close();
}

function deleteCategoria($id){
    $sql = "DELETE FROM tb_tipo_produto WHERE TB_TIPO_PRODUTO_ID = ?";
    $conexao = conectarBanco();
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $conexao->close();
}

function editarCategoria($nome, $id){
    $sql = "UPDATE tb_tipo_produto SET TB_TIPO_PRODUTO_DESC = ? WHERE TB_TIPO_PRODUTO_ID = ?";
    $conexao = conectarBanco();
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("si", $nome, $id);
    $stmt->execute();
    $stmt->close();
    $conexao->close();
}