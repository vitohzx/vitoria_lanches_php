<?php

require_once("conexao.php");

class ProdutosModel {
    private $nome;
    private $desc;
    private $preco;
    private $id;

    public function __construct($nome = null, $desc = null, $preco = null, $id = null){
        $this->nome = $nome;
        $this->desc = $desc;
        $this->preco = $preco;
        $this->id = $id;
    }

    public function criarProduto(){
        if ($this->id == "nulo") {
            return;
        }
        $sql = "INSERT INTO tb_produto (TB_PRODUTO_NOME, TB_PRODUTO_DESC, TB_PRODUTO_PRECO_UNIT, TB_TIPO_PRODUTO_ID) VALUES (?, ?, ?, ?)";
        $conexao = conectarBanco();
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ssdi", $this->nome, $this->desc, $this->preco, $this->id);
        $stmt->execute();
        $stmt->close();
        $conexao->close();
    }

    public function editarProduto($id){
        $sql = "UPDATE tb_produto SET TB_PRODUTO_NOME = ?, TB_PRODUTO_DESC = ?, TB_PRODUTO_PRECO_UNIT = ? WHERE TB_PRODUTO_ID = ?";
        $conexao = conectarBanco();
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ssdi", $this->nome, $this->desc, $this->preco, $id);
        $stmt->execute();
        $stmt->close();
        $conexao->close();
    }

    public function deleteProduto($id){
        $sql = "DELETE FROM tb_produto WHERE TB_PRODUTO_ID = ?";
        $conexao = conectarBanco();
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $conexao->close();
    }

    public function readProdutos(){
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

    public function getProduto(){
        $sql = "SELECT * FROM tb_produto WHERE TB_PRODUTO_ID = ?";
        $conexao = conectarBanco();
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_assoc();
        return $result;
    }
}