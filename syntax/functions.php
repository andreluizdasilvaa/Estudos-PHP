<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funções</title>
</head>
<body>
    <?php
        $projetos = [
            [
                "Portifólio",
                "AA",
                "08-06-2026"
            ]
        ]
    ?>

    <?php
        function verificar_se_projeto_esta_finalizado($projeto) {
            $name = $projeto[0][0];
            $status = $projeto[0][1];
            if($status == "Finalizado") {
                echo "<h1> $name está finalizado</h1>";
            } else {
                echo "<h1> $name não está finalizado</h1>";
            }
        }
    ?>

    <?php verificar_se_projeto_esta_finalizado($projetos); ?>

    <?php
        function soma(float $a, float $b): float {
            return $a + $b;
        }
    ?>

    <?php
        $num1 = 2;
        $num2 = 3;

        echo "<h1>Váriavel 1: $num1 <br> Variavel 2: $num2</h1>";
        echo "<h1>A soma de $num1 + $num2 = " . soma($num1, $num2) . "</h1>";
    ?>
</body>
</html>