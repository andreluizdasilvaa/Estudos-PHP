<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variaveis</title>
</head>
<body>
    <h1>Variaveis</h1>

    <?php
        $name = "André";
        $sobrenome = "Luiz";
        $idade = 19;
        
        echo "Nome: " . $name . " " . $sobrenome;
        echo "<br>";
        echo "Idade: $idade";
    ?>

    <br>

    <?php 
        $altura = "175cm";
    ?>

    <?= "altura: " . $altura; ?>
</body>
</html>