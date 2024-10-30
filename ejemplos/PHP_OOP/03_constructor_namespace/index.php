<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 3</title>
</head>
<body>
    <?php
    /*
        use Ejemplos\PHP_OOP\Cabecera as Cabecera;
        require_once __DIR__ . '/Cabecera.php';

        $cab = new Cabecera('Daarick28', 'center');
        $cab->graficar();
    */

        use Ejemplos\PHP_OOP\Cabecera2 as Cabecera;
        require_once __DIR__ . '/Cabecera.php';

        $cab = new Cabecera('Daarick28 1M 🗣️🗣️🗣️🗣️', 'center', 'https://livecounts.io/youtube-live-subscriber-counter/UCGA6Zu0wxKCnW9W0crxoneQ');
        $cab->graficar();
    ?>
</body>
</html>