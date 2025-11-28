<?php

require("./model/pedidosModel.php");

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