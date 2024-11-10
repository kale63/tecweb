<?php
include_once __DIR__.'/database.php';

$data = [];

// Verificar si se recibió un parámetro de búsqueda
if (isset($_GET['search'])) {
    $search = $conexion->real_escape_string($_GET['search']);
    // Mostrar el valor de $search para depuración
    error_log("Search parameter received: " . $search);

    $sql = "SELECT * FROM productos 
            WHERE (id = '{$search}' 
                   OR nombre LIKE '%{$search}%' 
                   OR marca LIKE '%{$search}%'
                   OR detalles LIKE '%{$search}%') 
            AND eliminado = 0";
    
    // Mostrar la consulta para depuración
    error_log("Executing SQL: " . $sql);

    $result = $conexion->query($sql);

    if ($result) {
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
    } else {
        error_log("Query Error: " . mysqli_error($conexion));
    }
    
    $conexion->close();
}

// Convertir el arreglo a JSON y devolverlo
header('Content-Type: application/json');
echo json_encode($data, JSON_PRETTY_PRINT);
?>
