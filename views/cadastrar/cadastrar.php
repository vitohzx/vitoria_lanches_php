<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../../styles/cadastrar.css">
</head>
<body>
    <div class="container">
        <div class="menu">
            <span class="titulo" style="color: white"> Bem vindo de volta </span>
            <span style="font-size: 13px; margin-top: 5%"> Acesse sua conta agora </span>
            <a href="../login/login.php"><button type="button" class="logButton"> ENTRAR </button></a>
        </div>
        <form action="../../index.php" method="post">
            <span class="titulo"> CRIE SUA CONTA </span>
            <div class="linha">
                <img src="../../images/user (3).png" alt="" style="width: 31px; height: 31px; margin-left: 5%">
                <input type="text" name="user" id="" placeholder="USERNAME" required class="textInput">
            </div>
            <div class="linha">
                <img src="../../images/lock.png" alt="" style="width: 35px; height: 35px; margin-left: 5%">
                <input type="password" name="senha" id="" placeholder="SENHA" required class="textInput">
            </div>
            <div class="linha">
                <img src="../../images/lock.png" alt="" style="width: 35px; height: 35px; margin-left: 5%">
                <input type="password" name="senhaC" id="" placeholder="CONFIRMAR SENHA" required class="textInput">
            </div>
            
            <input type="submit" value="CADASTRAR" class="cadButton">
            <input type="hidden" name="acao" value="cadastrar">
        </form>
    </div>
</body>
</html>