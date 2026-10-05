<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laços de Reps</title>
</head>
<body>
    <?php 
        $pessoas = [
            [
                "Nome" => "André",
                "Idade" => 19,
            ],
            [
                "Nome" => "Lucas",
                "Idade" => 23,
            ],
            [
                "Nome" => "Pedro",
                "Idade" => 32,
            ],
            [
                "Nome" => "João",
                "Idade" => 18,
            ],
        ];
        
        echo "<h1>For</h1>";
        for($i = 0; $i < count($pessoas); $i++) {
            $nome = $pessoas[$i]["Nome"];
            echo "$i - $nome <br>";
        };


        $pessoas = [
            "André" => 3500,
            "Lucas" => 2000,
            "pedro" => 7000
        ];

        echo "<hr>";

        foreach($pessoas as $pessoa => $salario) {
            echo "$pessoa ganha R$$salario <br>";
        };

        
    
    ?>
</body>
</html>