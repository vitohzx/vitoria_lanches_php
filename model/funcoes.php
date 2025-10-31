<?php

// conexão com o banco

function conectarBanco() {
    $host = "127.0.0.1";
    $user = "root";
    $password = "root";
    $database = "vitoria_lanches";

    // Criação da conexão
    $conexao = new mysqli($host, $user, $password, $database);

    // Verifica se houve erro na conexão
    if ($conexao->connect_error) {
        die("Erro na conexão: " . $conexao->connect_error);
    }

    // Define o charset para evitar problemas com caracteres especiais
    $conexao->set_charset("utf8mb4");

    return $conexao;
}

// usuarios

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


// login e cadastro

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




// produtos

function getProduto($id){
    $sql = "SELECT * FROM tb_produto WHERE TB_PRODUTO_ID = ?";
    $conexao = conectarBanco();
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $result = $result->fetch_assoc();
    return $result;
}

function readProdutos(){
    $sql = "SELECT * FROM tb_produto";       
    $conexao = conectarBanco();   
    $result = $conexao->query($sql);
    $produtos = [];

    while ($row = $result->fetch_assoc()) {
        $produtos[] = $row;
    }
    $conexao->close();

    return $produtos;
}

function deleteProduto($id){
    $sql = "DELETE FROM tb_produto WHERE TB_PRODUTO_ID = ?";
    $conexao = conectarBanco();
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $conexao->close();
}


function criarProdutos($nome, $desc, $preco, $id){
    if ($id == "nulo") {
        return;
    }
    $sql = "INSERT INTO tb_produto (TB_PRODUTO_NOME, TB_PRODUTO_DESC, TB_PRODUTO_PRECO_UNIT, TB_TIPO_PRODUTO_ID) VALUES (?, ?, ?, ?)";
    $conexao = conectarBanco();
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssdi", $nome, $desc, $preco, $id);
    $stmt->execute();
    $stmt->close();
    $conexao->close();
}

function editarProduto($nome, $desc, $preco, $id){
    $sql = "UPDATE tb_produto SET TB_PRODUTO_NOME = ?, TB_PRODUTO_DESC = ?, TB_PRODUTO_PRECO_UNIT = ? WHERE TB_PRODUTO_ID = ?";
    $conexao = conectarBanco();
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssdi", $nome, $desc, $preco, $id);
    $stmt->execute();
    $stmt->close();
    $conexao->close();
}


// categorias

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

// usuarios 

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

//pedidos

function getPedidos(){
    $sql = "SELECT * FROM tb_pedido INNER JOIN tb_pedido_venda ON tb_pedido.TB_PEDIDO_VENDA_ID = tb_pedido_venda.TB_PEDIDO_VENDA_ID;";       
    $conexao = conectarBanco();   
    $result = $conexao->query($sql);
    $pedidos = [];

    while ($row = $result->fetch_assoc()) {
        $pedidos[] = $row;
    }
    $conexao->close();

    return $pedidos;
}



function getCliente($id){
    $sql = "SELECT * FROM tb_cliente WHERE TB_USER_FK = {$id}";       
    $conexao = conectarBanco();   
    $result = $conexao->query($sql);
    $result = $result->fetch_assoc();
    $conexao->close();

    return $result;
}

function pedido($carrinho, $user){
    $usuario = getUser($user);
    $idUser = $usuario["TB_USUARIOS_ID"];

    $cliente = getCliente($idUser);
    $clienteId = $cliente['TB_CLIENTE_ID'];


    $sql = "INSERT INTO TB_PEDIDO_VENDA (TB_CLIENTE_ID, TB_PEDIDO_VENDA_DATA, TB_PEDIDO_VENDA_VAL_TOTAL, TB_PEDIDO_VENDA_STATUS, TB_PEDIDO_VENDA_FORMA_PAG, TB_PEDIDO_VENDA_OBS) 
            VALUES ($clienteId, NOW(), 0, 'pendente', 'Não definido', '');";
    $conexao = conectarBanco();

    $conexao->query($sql);
    $pedidoId = $conexao->insert_id;

    $precoFinal = 0;

    foreach($carrinho as $ped){

        $produto = getProduto($ped['produto']);

        $precoTotal = $produto['TB_PRODUTO_PRECO_UNIT'] * $ped['quantidade'];
        $precoFinal += $precoTotal;
        
        $sqlPedido = "INSERT INTO tb_pedido (TB_PRODUTO_ID, TB_PEDIDO_VENDA_ID, TB_PEDIDO_PRODUTO_QTD, TB_PEDIDO_PRODUTO_PRECO_UNIT, TB_PEDIDO_PRODUTO_PRECO_TOTAL) 
                      VALUES ({$ped['produto']}, $pedidoId ,{$ped['quantidade']}, {$produto['TB_PRODUTO_PRECO_UNIT']}, {$precoTotal});";

        $conexao->query($sqlPedido);
    }

    $sqlFinalizar = "UPDATE TB_PEDIDO_VENDA SET TB_PEDIDO_VENDA_VAL_TOTAL = {$precoFinal} WHERE TB_PEDIDO_VENDA_ID = $pedidoId;";

    $conexao->query($sqlFinalizar);

    $conexao->close();
}

function getPedidoFormat(){
    $pedidos = getPedidos();
    $pdd = [];
    
    foreach($pedidos as $pedido){
        $produtoNome = getProduto($pedido["TB_PRODUTO_ID"]);
        $cliente = getClientePorId($pedido["TB_CLIENTE_ID"]);

        if(isset($pdd[$pedido["TB_PEDIDO_VENDA_ID"]])){
            $pdd[$pedido["TB_PEDIDO_VENDA_ID"]]["quantidade"] += $pedido["TB_PEDIDO_PRODUTO_QTD"];
            $pdd[$pedido["TB_PEDIDO_VENDA_ID"]]["produto"] .= ", " . $produtoNome["TB_PRODUTO_NOME"];
            continue;
        }


        $pdd[$pedido["TB_PEDIDO_VENDA_ID"]] = [
            "id" => $pedido["TB_PEDIDO_ID"],
            "idVenda" => $pedido["TB_PEDIDO_VENDA_ID"],
            "cliente" => $cliente["TB_CLIENTE_NOME"],
            "produto" => $produtoNome["TB_PRODUTO_NOME"],
            "quantidade" => $pedido["TB_PEDIDO_PRODUTO_QTD"],
            "forma_pag" => $pedido["TB_PEDIDO_VENDA_FORMA_PAG"],
            "status" => $pedido["TB_PEDIDO_VENDA_STATUS"],
            "obs" => $pedido["TB_PEDIDO_VENDA_OBS"],
            "data" => $pedido["TB_PEDIDO_VENDA_DATA"]
        ];

    }
    return $pdd;
}

function getClientePorId($id){
    $sql = "SELECT * FROM tb_cliente WHERE TB_CLIENTE_ID = {$id}";       
    $conexao = conectarBanco();   
    $result = $conexao->query($sql);
    $result = $result->fetch_assoc();
    $conexao->close();

    return $result;
}


?>