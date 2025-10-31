<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuarios</title>
    <link rel="stylesheet" href="../../styles/usuarios.css">
</head>
<body>
    <h1> Gerenciar Usuarios </h1>
    <form action="../../index.php" method="post">
    <table border="1" cellspacing="0" cellpadding="5">
        <tr><th>ID</th><th>USERNAME</th><th>SENHA</th><th>TIPO</th><th>EXLUIR</th></tr>
        
    <?php
    require_once(__DIR__ . "/../../model/funcoes.php");
    $users = getUsers();
    foreach($users as $user){
        echo "
                <tr>
                    <td>{$user["TB_USUARIOS_ID"]}</td>
                    <td>{$user["TB_USUARIOS_USERNAME"]}</td>
                    <td>{$user["TB_USUARIOS_PASSWORD"]}</td>
                    <td>{$user["TB_USUARIOS_TIPO"]}</td>
                    <td><input type='checkbox' id='{$user["TB_USUARIOS_ID"]}' name='usuarios[]' value='{$user["TB_USUARIOS_ID"]}'>
                        <label for='{$user["TB_USUARIOS_ID"]}'></label>
                    </td>
                </tr>
        ";
    }

    ?>
        </table>
        <br>
        <input type="submit" value="EXCLUIR USUARIOS">
        <input type="hidden" name="acao" value="deleteUser">
        
    </form>

</body>
</html>