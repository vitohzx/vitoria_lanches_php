<?php

function loginUser($name, $senha){

    $sql = "SELECT * FROM tb_usuarios WHERE TB_USUARIOS_USERNAME = ? AND TB_USUARIOS_PASSWORD = ?";
    $conexao = conectarBanco();
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $name, $senha);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();


    if ($result->num_rows > 0) {
        $stmt->close();
        $conexao->close();
        return true;
    } 
    else {
        $stmt->close();
        $conexao->close();
        return false;
    }
}

function cadastroUser($user, $senha, $confirm){
    if ($senha != $confirm) {
        echo "<script>alert('A confirmação da senha está incorreta'); window.location.href='./views/cadastrar/cadastrar.php'</script>";
        return;
    }
    try {
        $sql = "INSERT INTO tb_usuarios (TB_USUARIOS_USERNAME, TB_USUARIOS_PASSWORD, TB_USUARIOS_TIPO) VALUES (?, ?, 'cliente')";
        $conexao = conectarBanco();
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ss", $user, $senha);
        $stmt->execute();

        $usuario = getUser($user);        
    } 
    catch(Exception $e) {
        echo "<script>alert('Já existe um usuario com esse username'); window.location.href='./views/cadastrar/cadastrar.php'</script>";
    }


    $stmt->close();
    $conexao->close();

    header("Location: views/concluir_cadastro/cadastro.php?user=$user");
}

function concluirCadastro($nome, $tel, $endereco, $numEndereco, $user){
    $conexao = conectarBanco();
    $select = "SELECT TB_USUARIOS_ID FROM tb_usuarios WHERE TB_USUARIOS_USERNAME = ?";
    $stmtSelect = $conexao->prepare($select);
    $stmtSelect->bind_param("s", $user);
    $stmtSelect->execute();
    $result = $stmtSelect->get_result();
    $result = $result->fetch_assoc();
    $id = $result["TB_USUARIOS_ID"];

    $sql = "INSERT INTO tb_cliente (TB_CLIENTE_NOME, TB_CLIENTE_TEL, TB_CLIENTE_ENDERECO, TB_CLIENTE_ENDERECO_NUM, TB_USER_FK) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssi", $nome, $tel, $endereco, $numEndereco, $id);
    $stmt->execute();
}