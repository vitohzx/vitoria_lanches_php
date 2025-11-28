<?php

require("model/loginModel.php");

session_start();

function logarUsuario(){
    $user = loginUser($_POST["user"], $_POST["senha"]);
    $username = $_POST["user"];

    if ($user){
        $_SESSION["user"] = $username;
        
        header("Location: ./views/home/inicio.php");
        
    } else {
        echo "<script>alert('Usuario ou senhas incorretos'); window.location.href='./views/login/login.php'</script>";;
    }
}

function cadastro(){
    cadastroUser($_POST["user"], $_POST["senha"], $_POST["senhaC"]);
}

function concluirCadastroUser(){
    concluirCadastro($_POST["nome"], $_POST["tel"], $_POST["endereco"], $_POST["numEndereco"], $_GET["user"]);
    $_SESSION["user"] = $_GET["user"];
    
    header("Location: ./views/home/inicio.php");
}