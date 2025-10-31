<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../../styles/home.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="menu">
            <?php

            session_start();
            
            require_once(__DIR__. "/../../model/funcoes.php");

            $tipo = "visitante";
            $username = "visitante";
            $nome = "visitante";
            $foto = "../../images/user.png";

            if(isset($_SESSION["user"])) {
                $usuario = getUser($_SESSION["user"]);
                if($usuario){
                    $username = $usuario["TB_USUARIOS_USERNAME"];
                    $tipo = $usuario["TB_USUARIOS_TIPO"];
                    $foto = "../../images/conta.png";
                }
                
                if($tipo == "cliente"){  
                    $cliente = getCliente($usuario["TB_USUARIOS_ID"]);
                    $nome = $cliente["TB_CLIENTE_NOME"];
                }
                else {
                    $nome = "Administrador";
                }
            }

        
            ?>
            

            <div class='aba'>
                <div class='icon'> <img src='../../images/home.png' height='100%' width='100%'> </div>
                <a href='inicio.php'>Home</a>
            </div>
            <div class='aba'>
                <div class='icon'> <img src='../../images/prod.png' height='100%' width='100%'> </div>
                <a href='#'>Produtos</a>
            </div>
            
            <?php
            if ($tipo == "administrador") {
                echo "
                    <div class='aba'>
                        <div class='icon'> </div>
                        <a href='inicio.php?pagina=gerenciar_produtos' class='adm'>Gerenciar Produtos</a>
                    </div>
                    <div class='aba'>
                        <div class='icon'> </div>
                        <a href='inicio.php?pagina=usuarios' class='adm'>Gerenciar Usuarios</a>
                    </div>
                    <div class='aba'>       
                        <div class='icon'> </div>
                        <a href='inicio.php?pagina=gerenciar_pedidos' class='adm'>Gerenciar Pedidos</a>
                    </div>
                    <div class='aba'>
                        <div class='icon'> </div>
                        <a href='#' class='adm'>Gerar Relatorios</a>
                    </div>
                ";
            }
            else if ($tipo == "cliente") {
                echo "
                    <div class='aba'>
                        <div class='icon'> </div>
                        <a href='inicio.php?pagina=fazer_pedido'>Fazer Pedido</a>
                    </div>";
            }
            
            ?>
        </div>


        <div class="main">
            <div class="header">
                <div class="titulo">
                    <span class="text"> vitoria lanches </span>
                </div>
                <div class="conta">
                    <a href="../login/login.php"> <img src="<?=$foto?>" alt="" height="100%" width="100%"> </a>
                </div>
            </div>

            <?php
            if(isset($_GET["pagina"])){
                $pag = $_GET["pagina"];
                switch($pag) {
                    case "gerenciar_produtos": 
                        if($tipo != "administrador"){
                            echo "Você não tem permissão para acessar essa pagina";
                            break;
                        }
                        include_once "../produtos/produtos.php";
                        break;
                    
                    case "usuarios":
                        if($tipo != "administrador"){
                            echo "Você não tem permissão para acessar essa pagina";
                            break;
                        }
                        include_once "../usuarios/usuarios.php";
                        break;
                    
                    case "gerenciar_pedidos":
                        if($tipo != "administrador"){
                            echo "Você não tem permissão para acessar essa pagina";
                            break;
                        }
                        include_once "../pedidos/pedidos.php";
                        break;
                    
                    case "fazer_pedido": 
                        include_once "../fazer_pedido/fazer_pedido.php";
                        break;

                    default: 
                        echo "erro 404: pagina inexistente";
                }
            }
            else {
                echo "<div style='margin-top: 5%; font-size: 200%'> Bem vindo ao vitoria lanches <b> {$nome} </b> </div>";
            }
            
            ?>
        </div>
    </div>
</body>
</html>