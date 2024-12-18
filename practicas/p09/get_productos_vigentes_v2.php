<?php
    header("Content-Type: text/html; charset=utf-8");

    @$link = new mysqli('localhost', 'root', 'californication', 'marketzone');

    if ($link->connect_errno) {
        die('Falló la conexión: ' . $link->connect_error . '<br/>');
    }

    if ($result = $link->query("SELECT * FROM productos WHERE eliminado = 0")) {
        $productos = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
    }

    $link->close();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Productos</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    </head>
    <body>
        <h3>Productos Vigentes</h3>

        <br/>

        <?php if (isset($productos) && count($productos) > 0) : ?>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Unidades</th>
                        <th scope="col">Detalles</th>
                        <th scope="col">Imagen</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                    <tr>
                        <th scope="row"><?= htmlentities($producto['id']) ?></th>
                        <td><?= htmlentities($producto['nombre']) ?></td>
                        <td><?= htmlentities($producto['marca']) ?></td>
                        <td><?= htmlentities($producto['modelo']) ?></td>
                        <td><?= htmlentities($producto['precio']) ?></td>
                        <td><?= htmlentities($producto['unidades']) ?></td>
                        <td><?= utf8_encode($producto['detalles']) ?></td>
                        <td><img src="<?= htmlentities($producto['imagen']) ?>" alt="Imagen del producto" style="width: 200px;" /></td>
                        <td>
                            <form action="http://localhost/tecweb/tecweb/practicas/p09/formulario_productos_v2.php" method="GET">
                                <input type="hidden" name="id" value="<?= htmlentities($producto['id']) ?>">
                                <button type="submit" class="btn btn-primary">Modificar</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No se encontraron productos con unidades menores o iguales a <?= htmlentities($tope) ?>.</p>
        <?php endif; ?>
    </body>
</html>
