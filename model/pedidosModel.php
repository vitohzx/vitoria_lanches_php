<?php 

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