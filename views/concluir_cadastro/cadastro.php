<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <!-- <link rel="stylesheet" href="cadastrar.css"> -->
</head>
<body>
    <div class="container">
        <div class="menu">

        </div>
        <?php
        $usuario = $_GET['user'];
        echo "<form action='../../index.php?user=$usuario' method='post'>"
        ?>
            <input type="text" name="nome" id="" placeholder="Nome completo" required>
            <input type="text" name="tel" id="" placeholder="Telefone" required>
            <input type="text" name="endereco" id="" placeholder="Endereço" required>
            <input type="text" name="numEndereco" id="" placeholder="Numero do endereço" required>
            <input type="submit" value="Concluir Cadastro">
            <input type="hidden" name="acao" value="concluir">
        </form>
    </div>
</body>
</html>