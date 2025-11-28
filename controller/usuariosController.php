<?php

require("./model/usuariosModel.php");

function deletarUser(){
    $userID = $_POST["usuarios"];
    deleteUser($userID);

    header("Location: ./views/home/inicio.php?pagina=usuarios");
}