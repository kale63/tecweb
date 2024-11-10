<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 2</title>
</head>
<body>
    <?php
    require_once __DIR__ . '/Menu.php';

    $menu = new Menu;
    $menu->cargar_opcion('https://www.twitch.tv/daarick', 'Twitch');
    $menu->cargar_opcion('https://kick.com/daarick', 'Kick');
    $menu->cargar_opcion('https://www.youtube.com/channel/UCGA6Zu0wxKCnW9W0crxoneQ', 'YouTube');
    $menu->mostrar();
    
    ?>
</body>
</html>