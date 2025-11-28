<?php

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