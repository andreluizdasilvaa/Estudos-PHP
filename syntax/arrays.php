<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays</title>
</head>
<body>
    <?php 
        $projetos = [
            "Projeto 1",
            "Projeto 2",
            "Projeto 3"
        ]
    ?>

    <ul>
        <?php 
            foreach ($projetos as $projeto) {
                echo "<li> $projeto </li>";
            }
        ?>
    </ul>

    <hr>

    <?php
        $projetosv2 = [
            [
                "Portifólio",
                true,
                "08-06-2026"
            ],
            [
                "To do list",
                false,
                "02-06-2026"
            ]
        ]
    ?>

    <ul>
        <?php 
            foreach ($projetosv2 as $projeto) {
                echo "<li> Nome: $projeto[0] | Ativo: $projeto[1] | Data: $projeto[2]</li>";
            }
        ?>
    </ul>

</body>
</html>