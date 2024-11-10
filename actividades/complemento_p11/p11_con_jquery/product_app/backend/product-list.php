<?php
include_once __DIR__.'/database.php';

// SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
$data = array();

// SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
if ($result = $conexion->query("SELECT * FROM productos WHERE eliminado = 0")) {
    // SE OBTIENEN LOS RESULTADOS
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    if (!empty($rows)) {
        // SE MAPEAN AL ARREGLO DE RESPUESTA
        foreach ($rows as $num => $row) {
            $data[$num] = $row; // No need for utf8_encode if data is already UTF-8
        }
    }
    $result->free();
} else {
    // Devolver un mensaje de error en JSON
    echo json_encode(['error' => 'Query Error: ' . $conexion->error]);
    exit; // Ensure the script stops after returning an error
}

$conexion->close();

// SE HACE LA CONVERSIÓN DE ARRAY A JSON
echo json_encode($data, JSON_PRETTY_PRINT);
?>
