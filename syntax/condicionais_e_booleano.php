<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Condicionais</title>
</head>
<body>
    <?php
        $projeto = "Portifólio";
        $ativo = true;
        $name = "André Luiz";
    ?>

    <h1><?php echo $projeto; ?></h1>

    <!-- Condição -->
    <?php
        if ($ativo == true) {
            echo "Projeto ativo";
        } else {
            echo "Projeto desativado";
        }
    ?>

    <br><br>

    <!-- Uma sintax diferente de condição  -->
    <?php if($ativo == true): ?>
        <h1 style="color: green;"><?php echo "Projeto realmente ativo"; ?></h1>
    <?php else: ?>
        <h1 style="color: red;"><?php echo "Projeto realmente desativado"; ?></h1>
    <?php endif; ?>
</body>
</html>