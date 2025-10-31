<?php

require("model/funcoes.php");

session_start();

function home(){
    header("Location: ./views/home/inicio.php");
}

function criarProd(){
    class Produto {
        private $nome;
        private $descricao;
        private $preco;
        private $categoria;

        public function __construct($name, $desc, $preco, $categoria){
            $this->nome = $name;
            $this->descricao = $desc;
            $this->preco = $preco;
            $this->categoria = $categoria;
        }

        public function getNome(){
            return $this->nome;
        }

        public function getDescricao(){
            return $this->descricao;
        }

        public function getPreco(){
            return $this->preco;
        }

        public function getCategoria(){
            return $this->categoria;
        }
    }
    $nomeProduto = $_POST["nomeProduto"];
    $descProduto = $_POST["descProduto"];
    $precoProduto = $_POST["precoProduto"];
    $categoriaProduto = $_POST["categoria"];

    $produto = new Produto($nomeProduto, $descProduto, $precoProduto, $categoriaProduto);

    criarProdutos($produto->getNome(), $produto->getDescricao(), $produto->getPreco(), $produto->getCategoria());
    
    header("Location: ./views/home/inicio.php?pagina=gerenciar_produtos");
}

function deleteProd(){
    $produtoID = $_POST["produto"];

    deleteProduto($produtoID);
    
    header("Location: ./views/home/inicio.php?pagina=gerenciar_produtos");
}

function editProd(){
    editarProduto($_POST["nomeProduto"], $_POST["descProduto"], $_POST["precoProduto"], $_POST["produto"]);
    
    header("Location: ./views/home/inicio.php?pagina=gerenciar_produtos");
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