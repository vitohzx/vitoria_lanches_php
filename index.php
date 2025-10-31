<?php

require("controller/controller.php");

$acao = isset($_POST["acao"]) ? $_POST["acao"] : "home";

switch($acao){
    case "home": 
        home();
        break;
        

    case "logar": 
        logarUsuario();
        break;


    case "cadastrar": 
        cadastro();
        break;
    

    case "concluir": 
        concluirCadastroUser();
        break;
    

    case "inicio": 
        home();
        break;
    

    case "criarCategoria": 
        criarCat();
        break;
    
    case "deleteCategoria": 
        deleteCat();
        break;
    

    case "editCategoria": 
        editCat();
        break;
    

    case "criar": 
        criarProd();
        break;
    

    case "deleteProduto": 
        deleteProd();
        break;
    

    case "editProduto": 
        editProd();
        break;
    

    case "deleteUser": 
        deletarUser();
        break;
    

    //pedidos

    case "fazerPedido": 
        fazerPedido();
        break;

    case "concluirPedido":
        concluirPedido();
        break;
} 


?>