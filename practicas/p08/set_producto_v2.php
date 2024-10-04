<?php
$nombre  = $_POST['name'];
$marca   = $_POST['brand'];
$modelo  = $_POST['model'];
$precio  = $_POST['price'];
$detalles  = $_POST['details'];
$unidades = $_POST['units'];
$imagen   = $_POST['img']; 

/** SE CREA EL OBJETO DE CONEXION */
@$link = new mysqli('localhost', 'root', 'californication', 'marketzone');	

/** comprobar la conexión */
if ($link->connect_errno) 
{
    die('Falló la conexión: '.$link->connect_error.'<br/>');
    /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
}

$check_sql = "SELECT * FROM productos WHERE nombre = '{$nombre}' AND marca = '{$marca}' AND modelo = '{$modelo}'";
$result = $link->query($check_sql);

if ($result->num_rows > 0) {
    echo 'Error: El producto ya existe en la base de datos.';
} else {
    $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) 
            VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', 0)";
    
    if ($link->query($sql)) {
        echo 'Producto insertado con éxito. <br/>';
        echo 'ID: ' . $link->insert_id . '<br/>';
        echo 'Nombre: ' . $nombre . '<br/>';
        echo 'Marca: ' . $marca . '<br/>';
        echo 'Modelo: ' . $modelo . '<br/>';
        echo 'Precio: ' . $precio . '<br/>';
        echo 'Detalles: ' . $detalles . '<br/>';
        echo 'Unidades: ' . $unidades . '<br/>';
        echo 'Imagen: ' . $imagen . '<br/>';
    } else {
        echo 'Error: El Producto no pudo ser insertado =(';
    }
}


$link->close();
?>