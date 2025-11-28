<?php

require("model/funcoes.php");

session_start();

function home(){
    header("Location: ./views/home/inicio.php");
}

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

function deletarUser(){
    $userID = $_POST["usuarios"];
    deleteUser($userID);

    header("Location: ./views/home/inicio.php?pagina=usuarios");
}

//pedido

function fazerPedido(){
    $carrinho = json_decode($_POST["carrinho"], true);
    $user = $_SESSION["user"];

    pedido($carrinho, $user);

    header("Location: ./views/home/inicio.php?pagina=fazer_pedido");
}


function concluirPedido(){
    $pedidosID = $_POST["pedidos"];
    concluirPdd($pedidosID);

    echo "<form action='./views/home/inicio.php?pagina=gerenciar_pedidos' method='post' id='formUser'>
            <input type='hidden' name='user' value='{$_POST["user"]}'>
        </form>
        <script> document.getElementById('formUser').submit() </script>";

}

?>