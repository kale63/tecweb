<?php
include_once __DIR__.'/database.php';

$data = [];

if (isset($_GET['search'])) {
    $search = $conexion->real_escape_string($_GET['search']);
    $sql = "SELECT * FROM productos 
            WHERE (id = '{$search}' 
                   OR nombre LIKE '%{$search}%' 
                   OR marca LIKE '%{$search}%'
                   OR detalles LIKE '%{$search}%') 
            AND eliminado = 0";
    
    $result = $conexion->query($sql);

    if ($result) {
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
    } else {
        $data = ['error' => 'Query Error: ' . mysqli_error($conexion)];
    }
    
    $conexion->close();
}

header('Content-Type: application/json');
echo json_encode($data, JSON_PRETTY_PRINT);
?>
