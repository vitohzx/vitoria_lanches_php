<?php

function getUser($user){
    $sql = "SELECT * FROM tb_usuarios WHERE TB_USUARIOS_USERNAME = ?";
    $conexao = conectarBanco();
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    $result = $result->fetch_assoc();
    return $result;
}

function getUsers(){
    $sql = "SELECT * FROM tb_usuarios";       
    $conexao = conectarBanco();   
    $result = $conexao->query($sql);
    $users = [];

    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    $conexao->close();

    return $users;
}

function deleteUser($users){
    $sql = "DELETE FROM tb_usuarios WHERE TB_USUARIOS_ID = ?";
    $sql2 = "DELETE FROM tb_cliente WHERE TB_USER_FK = ?";
    $conexao = conectarBanco();

    $stmt2 = $conexao->prepare($sql2);
    $stmt = $conexao->prepare($sql);

    foreach ($users as $id) {
        $stmt2->bind_param("i", $id);
        $stmt->bind_param("i", $id);
        $stmt2->execute();
        $stmt->execute();
    }

    $stmt2->close();
    $stmt->close();
    $conexao->close();
}

function getCliente($id){
    $sql = "SELECT * FROM tb_cliente WHERE TB_USER_FK = {$id}";       
    $conexao = conectarBanco();   
    $result = $conexao->query($sql);
    $result = $result->fetch_assoc();
    $conexao->close();

    return $result;
}

function getClientePorId($id){
    $sql = "SELECT * FROM tb_cliente WHERE TB_CLIENTE_ID = {$id}";       
    $conexao = conectarBanco();   
    $result = $conexao->query($sql);
    $result = $result->fetch_assoc();
    $conexao->close();

    return $result;
}