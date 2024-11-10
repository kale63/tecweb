<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 5</title>
</head>
<body>
    <?php
    require_once __DIR__ . '/Pagina.php';

    $pag = new Pagina('Daarick28 1M 🗣️🗣️🗣️🗣️', 'center', 'El fin de los 🦃');
    
    for ($i = 0; $i < 15; $i++) {
        $pag->insertar_cuerpo('Prueba #'.($i+1). ' que aparece en la página.');
    }

    $pag->graficar();
    ?>
</body>
</html>