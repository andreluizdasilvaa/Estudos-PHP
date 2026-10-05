<?php 


    if(isset($_GET["nome"])) {
        $nome = htmlspecialchars($_GET["nome"]);

        echo "Olá!, sejá bem vindo $nome";
    };



?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
</head>
<body>
    <h2>Fornulário</h2>
    <form action="formulario.php" method="GET">
        <label for="nome">Seu nome:</label>
        <input type="text" name="nome" id="nome">
        <button type="submit">Enviar</button>
    </form>
</body>
</html>